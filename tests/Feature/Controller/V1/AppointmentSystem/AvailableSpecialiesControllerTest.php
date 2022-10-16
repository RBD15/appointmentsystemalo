<?php

namespace Tests\Feature\Controller\V1\AppointmentSystem;

use Tests\TestCase;
use App\Models\City;
use App\Models\Plan;
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

        //Attach Models
        Plan::all()->first()->specialities()->attach(Speciality::all()->first()->id);
        $data=[
            'contrato'=>1
        ];

        $response = $this->post('/api/v1/appointment-system/get-available-speciality/',$data);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $this->assertInstanceOf('App\Models\Speciality',$response->getOriginalContent()[0]);
    }
}
