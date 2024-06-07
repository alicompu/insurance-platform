<?php

namespace Tests\Feature;

use App\Models\PersonalInfo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PersonalInfoControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function it_stores_personal_info_and_redirects_to_address_info_form()
    {
        $personalInfoData = [
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john.doe@example.com',
            'phone'      => '123-456-7890',
        ];

        $response = $this->post(route('personal-info.store'), $personalInfoData);

        $response->assertRedirect('address-info-form');
        $response->assertSessionHas('success', 'Personal information saved successfully!');

        $this->assertDatabaseHas('personal_infos', $personalInfoData);

        $personalInfo = PersonalInfo::first();
        $this->assertEquals(session()->get('personal_info_id'), $personalInfo->id);
    }

    /** @test */
    public function it_handles_transaction_failure()
    {
        DB::shouldReceive('transaction')->once()->andThrow(new \Exception('Transaction failed'));

        $personalInfoData = [
            'first_name' => 'John',
            'last_name'  => 'Doe',
            'email'      => 'john.doe@example.com',
            'phone'      => '123-456-7890',
        ];

        $response = $this->post(route('personal-info.store'), $personalInfoData);

        $response->assertRedirect('personal-info-form');
        $response->assertSessionHas('error', 'Transaction failed');
    }
}
