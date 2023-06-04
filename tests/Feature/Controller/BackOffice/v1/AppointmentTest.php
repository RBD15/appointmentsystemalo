<?php

namespace Tests\Feature\Controller\BackOffice\V1;

use App\Models\Appointment;
use Tests\TestCase;
use App\Models\City;
use App\Models\Plan;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Speciality;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();

        $data= [
            'patient_id'=>$patient->id,
            'city_id'=>$city->id,
            'doctor_id'=>$doctor->id,
            'date'=>'2022-10-08'
        ];

        $response = $this->post('/api/v1/appointment/',$data);
        $this->assertDatabaseHas('appointments',$data);
        $response->assertStatus(201);
    }

    public function test_index()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();

        $appointment = Appointment::factory(10)->create();
        $response = $this->get('/api/v1/appointment/');
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['patient_id','city_id','doctor_id','date'],$response->getOriginalContent()[1]);

    }

    public function test_show()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();

        $appointment = Appointment::factory(1)->create();
        $response = $this->get('/api/v1/appointment/1');
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['patient_id','city_id','doctor_id','date'],$response->getOriginalContent());

    }

    public function test_edit()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();

        $appointment = Appointment::factory(1)->create()->first();

        $data= [
            'patient_id'=>$patient->id,
            'city_id'=>$city->id,
            'doctor_id'=>$doctor->id,
            'date'=>'2022-10-09'
        ];

        $response = $this->put('/api/v1/appointment/1',$data);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['patient_id','city_id','doctor_id','date'],$response->getOriginalContent());
        $this->assertDatabaseHas('appointments',$data);
    }

    public function test_delete()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();

        $appointment = Appointment::factory(1)->create();
        $response = $this->delete('/api/v1/appointment/1');
        $response->assertStatus(204);
        $this->assertDatabaseMissing('appointments',$appointment->first()->toArray());
    }

}
