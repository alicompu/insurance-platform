<?php

namespace Tests\Feature;

use App\Enums\Type;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InsuranceControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_stores_request_data_in_session_and_redirects_to_personal_info_form()
    {
        $insuranceData = [
            Type::HOME->value => false,
            Type::AUTO->value => true,
            Type::RV->value   => false,
        ];

        $response = $this->post(route('insurance.store'), $insuranceData);

        $response->assertRedirect('personal-info-form');

        foreach ($insuranceData as $key => $value) {
            $this->assertEquals(session()->get($key), $value);
        }
    }
}
