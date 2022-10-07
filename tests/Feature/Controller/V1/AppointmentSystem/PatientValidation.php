<?php

namespace Tests\Feature\Controller\V1\AppointmentSystem;

use Tests\TestCase;
use App\Models\Plan;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientValidation extends TestCase
{

    use RefreshDatabase;

    public function test_validationUser(){

        $plan=Plan::factory(5)->create()->first();
        $patient=Patient::factory(5)->create()->first();

        $data=[
            "document"=>$patient->document,
            "phone_number"=>$patient->phone_number
        ];
        $response=$this->post('/api/v1/appointment/validate-patient',$data);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

}
