<?php

namespace Tests\Feature\Controller\V2\AppointmentSystem;

use Tests\TestCase;
use App\Models\City;
use App\Models\Plan;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AvailableSpecialiesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_speciality()
    {
        $city=City::factory(5)->create()->first();
        $speciality= Speciality::factory(5)->create()->first();
        $plan=Plan::factory(4)->create()->first();
        $doctor=Doctor::factory(20)->create()->first();
        $patient=Patient::factory(10)->create()->first();
        $appointment = Appointment::factory(10)->create()->first();

        //Creacion de User y Token
        User::factory(1)->create();
        $user=User::find(1);
        $token=$user->createToken($user->email)->plainTextToken;
        
        //Attach Models
        Plan::all()->first()->specialities()->attach(Speciality::all()->first()->id);
        $data=[
            'contrato'=>1
        ];

        $response = $this->post('/api/v2/appointment-system/get-available-speciality/',$data,['Authorization'=>'Bearer '.$token]);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $this->assertInstanceOf('App\Http\Resources\AvailableSpeciality',$response->getOriginalContent()[0]);
    }
}
