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

class ScheduleAppointmentsTest extends TestCase
{
    use RefreshDatabase;

    public function test_getAvailableAppointments(){

        $city=City::factory(5)->create()->first();
        $speciality= Speciality::factory(5)->create()->first();
        $plan=Plan::factory(4)->create()->first();
        $doctor=Doctor::factory(20)->create()->first();
        $patient=Patient::factory(10)->create()->first();
        $appointment = Appointment::factory(10)->create()->first();

        $data=[
            "contrato"=>$patient->id,
            "plan"=>$patient->plan_id,
            "doctor_id"=>null,
            "speciality_id"=>null,
            "city_id"=>3  
        ];
        $response=$this->post('/api/v1/appointment-system/get-available-appointmets',$data);
        $this->assertInstanceOf("Illuminate\Http\Resources\Json\AnonymousResourceCollection",$response->getOriginalContent());
        $this->assertInstanceOf("App\Http\Resources\AvailableAppointmentsResource",$response->getOriginalContent()[0]);
        $response->assertJsonStructure(['id','patient','city','doctor','speciality','date'],$response->getOriginalContent()[0]->toArray(null));
        // $this->assertInstanceOf("App\Http\Appointment",$response->getOriginalContent()[0]);

        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

}
