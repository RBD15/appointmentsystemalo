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

class AvailableDoctorsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_doctors()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();
        Appointment::factory(100)->create();

      //A set relationship
      $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
      $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>1,'patient_id'=>1])->first();

        $data=[
            'contrato'=>1,
            'speciality_id'=>1,
            'city_id'=>1
        ];   
        $response = $this->post('/api/v1/appointment-system/get-available-doctor/',$data); 
        // dd($response);       
        $this->assertInstanceOf('Illuminate\Http\Resources\Json\AnonymousResourceCollection',$response->getOriginalContent());
        $this->assertInstanceOf('App\Http\Resources\AvailableDoctor',$response->getOriginalContent()[0]);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);

    }
}
