<?php

namespace Tests\Feature;

use App\Enums\Type;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AddressInfoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        // Create necessary data
        $this->personalInfoId = $this->faker->uuid;

        Session::put('personal_info_id', $this->personalInfoId);
        Session::put(Type::HOME->value, true);
        Session::put(Type::AUTO->value, false);
        Session::put(Type::RV->value, true);
    }

    /** @test */
    public function it_stores_address_and_creates_order_items()
    {
        $addressData = [
            'street_address' => '123 Test St',
            'apt'            => 'Testville',
            'city'           => 'TS',
            'state'          => '12345',
            'zip'            => 'Testland',
        ];

        $response = $this->post(route('address.store'), $addressData);

        $response->assertRedirect('/');
        $response->assertSessionHas('success', 'Address saved successfully!');

        $this->assertDatabaseHas('addresses', $addressData);
        $this->assertDatabaseHas('orders', ['personal_info_id' => $this->personalInfoId]);
        $order = Order::first();
        $this->assertCount(2, $order->orderItems);
        $this->assertDatabaseHas('order_items', ['type' => Type::HOME->value]);
        $this->assertDatabaseHas('order_items', ['type' => Type::RV->value]);
    }

    /** @test */
    public function it_handles_transaction_failure()
    {
        DB::shouldReceive('transaction')->once()->andThrow(new \Exception('Transaction failed'));

        $addressData = [
            'street_address' => '123 Test St',
            'apt'            => 'Testville',
            'city'           => 'TS',
            'state'          => '12345',
            'zip'            => 'Testland',
        ];

        $response = $this->post(route('address.store'), $addressData);

        $response->assertRedirect('address-info-form');
        $response->assertSessionHas('error', 'Transaction failed');
    }
}
