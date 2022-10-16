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

class SheduleAppointmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_available_appointments(){
        $city=City::factory(5)->create()->first();
        $speciality= Speciality::factory(5)->create()->first();
        $plan=Plan::factory(4)->create()->first();
        $doctor=Doctor::factory(20)->create()->first();
        $patient=Patient::factory(10)->create()->first();
        $appointment = Appointment::factory(200)->create()->first();

        //A set relationship
        $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
        $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>3])->first();

        $data=[
            "contrato"=>$patient->id,
            "plan"=>$patient->plan_id,
            "doctor_id"=>null,
            "speciality_id"=>1,
            "city_id"=>3  
        ];
        $response=$this->post('/api/v1/appointment-system/get-available-appointments',$data);
        $this->assertInstanceOf("Illuminate\Http\Resources\Json\AnonymousResourceCollection",$response->getOriginalContent());
        $this->assertInstanceOf("App\Http\Resources\AvailableAppointmentsResource",$response->getOriginalContent()[0]);
        $response->assertJsonStructure(['id','patient','city','doctor','speciality','date'],$response->getOriginalContent()[0]->toArray(null));
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_set_appointments()
    {
        $city=City::factory(10)->create()->first();
        $speciality= Speciality::factory(10)->create()->first();
        $plan=Plan::factory(10)->create()->first();
        $doctor=Doctor::factory(10)->create()->first();
        $patient=Patient::factory(10)->create()->first();
        Appointment::factory(100)->create();

        //A set relationship
        $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
        $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>1])->first();

        $data=[
            'contrato'=>2,
            'appointment_id'=>$appointment->id
        ];   

        $result=[
            'id'=>$appointment->id,
            'doctor_id'=>$doctor->id,
            'city_id'=>$appointment->city_id,
            'patient_id'=>2
        ];
        $response = $this->post('/api/v1/appointment-system/set-appointment/',$data);
        $this->assertDatabaseHas('appointments',$result);
        $this->assertDatabaseMissing('appointments',$appointment->toArray());
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);

    }
}
