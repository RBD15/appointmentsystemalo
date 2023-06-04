<?php

namespace Tests\Feature\Controller\api\V2\AppointmentSystem;

use Tests\TestCase;
use App\Models\Plan;
use App\Models\User;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientValidation extends TestCase
{
    use RefreshDatabase;

    public function test_validationUser(){

        $plan=Plan::factory(5)->create()->first();
        $patient=Patient::factory(5)->create()->first();

        //Creacion de User y Token
        User::factory(1)->create();
        $user=User::find(1);
        $token=$user->createToken($user->email)->plainTextToken;

        $data=[
            "document"=>$patient->document,
            "phone_number"=>$patient->phone_number
        ];
        $response=$this->post('/api/v2/appointment-system/validate-patient',$data,['Authorization'=>'Bearer '.$token]);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);

        $this->assertTrue(true);
    }

}
