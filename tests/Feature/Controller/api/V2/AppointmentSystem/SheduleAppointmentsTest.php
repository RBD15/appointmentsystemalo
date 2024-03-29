<?php

namespace Tests\Feature\Controller\api\V2\AppointmentSystem;

use Carbon\Carbon;
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

    // public function test_get_available_appointments(){
    //     $offset=3;
    //     $currentDate=date('Y-m-d H:s:i',Carbon::now()->addHours($offset)->getTimestamp());
    //     $city=City::factory(5)->create()->first();
    //     $speciality= Speciality::factory(5)->create()->first();
    //     $plan=Plan::factory(4)->create()->first();
    //     $doctor=Doctor::factory(20)->create()->first();
    //     $patient=Patient::factory(10)->create()->first();
    //     $appointment = Appointment::factory(200)->create()->first();

    //     //A set relationship
    //     $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
    //     $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>3,'patient_id'=>1,'date'=>$currentDate])->first();
    //     $appointment2 = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>3,'patient_id'=>1,'date'=>$currentDate])->first();

    //     $data=[
    //         "contrato"=>$patient->id,
    //         "doctor_id"=>$doctor->id,
    //         "speciality_id"=>1,
    //         "city_id"=>3
    //     ];
    //     $response=$this->post('/api/v1/appointment-system/get-available-appointments',$data);
    //     $this->assertInstanceOf("Illuminate\Http\Resources\Json\AnonymousResourceCollection",$response->getOriginalContent());
    //     $this->assertInstanceOf("App\Http\Resources\AvailableAppointmentsResource",$response->getOriginalContent()[0]);
    //     $response->assertJsonStructure(['id','patient','city','doctor','speciality','date'],$response->getOriginalContent()[0]->toArray(null));
    //     $response->assertHeader('Content-Type','application/json');
    //     $response->assertStatus(200);
    // }

    // public function test_bad_get_available_appointments_request(){
    //     $data=[
    //         "contrato"=>null,
    //         "doctor_id"=>null,
    //         "speciality_id"=>1,
    //         "city_id"=>3
    //     ];
    //     $response=$this->post('/api/v1/appointment-system/get-available-appointments',$data,["Accept"=>"application/json"]);
    //     $response->assertJsonStructure(['message','errors'=>["contrato"]],$response->getOriginalContent());
    //     $response->assertHeader('Content-Type','application/json');
    //     $response->assertStatus(422);
    // }
    // public function test_set_appointments()
    // {
    //     $city=City::factory(10)->create()->first();
    //     $speciality= Speciality::factory(10)->create()->first();
    //     $plan=Plan::factory(10)->create()->first();
    //     $doctor=Doctor::factory(10)->create()->first();
    //     $patient=Patient::factory(10)->create()->first();
    //     Appointment::factory(100)->create();

    //     //A set relationship
    //     $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
    //     $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>1,'patient_id'=>1])->first();

    //     $data=[
    //         'contrato'=>2,
    //         'appointment_id'=>$appointment->id
    //     ];

    //     $result=[
    //         'id'=>$appointment->id,
    //         'doctor_id'=>$doctor->id,
    //         'city_id'=>$appointment->city_id,
    //         'patient_id'=>2
    //     ];
    //     $response = $this->post('/api/v1/appointment-system/set-appointment/',$data);
    //     $this->assertDatabaseHas('appointments',$result);
    //     $this->assertDatabaseMissing('appointments',$appointment->toArray());
    //     $response->assertHeader('Content-Type','application/json');
    //     $response->assertStatus(200);

    // }

    // public function test_create_appointments(){
    //     $city=City::factory(5)->create()->first();
    //     $speciality= Speciality::factory(5)->create()->first();
    //     $plan=Plan::factory(4)->create()->first();
    //     $doctor=Doctor::factory(20)->create()->first();
    //     $patient=Patient::factory(10)->create()->first();

    //     $appointments = Appointment::factory(20)->create(['patient_id'=>1]);

    //     $response=$this->post('/api/v1/appointment-system/generate-available-appointments',['admin'=>1234]);
    //     $this->assertInstanceOf("Illuminate\Database\Eloquent\Collection",$response->getOriginalContent());
    //     $this->assertInstanceOf("App\Models\Appointment",$response->getOriginalContent()[0]);
    //     $this->assertTrue($response->getOriginalContent()[0]->patient_id==1);
    //     $response->assertHeader('Content-Type','application/json');
    //     $response->assertStatus(200);
    // }


    // public function test_patients_appoitnments(){
    //     $offset=3;
    //     $currentDate=date('Y-m-d H:s:i',Carbon::now()->addHours($offset)->getTimestamp());
    //     $city=City::factory(10)->create()->first();
    //     $speciality= Speciality::factory(10)->create()->first();
    //     $plan=Plan::factory(10)->create()->first();
    //     $doctor=Doctor::factory(10)->create()->first();
    //     $patient=Patient::factory(10)->create()->first();

    //     //set Patient's appointments
    //     $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
    //     $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>1,'patient_id'=>2,'date'=>$currentDate])->first();
    //     $appointment = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>2,'patient_id'=>2,'date'=>$currentDate])->first();

    //     $data=[
    //         'patient_id'=>2,
    //     ];

    //     $response=$this->post('/api/v1/appointment-system/get-patient-appointments',$data);
    //     $this->assertInstanceOf("Illuminate\Http\Resources\Json\AnonymousResourceCollection",$response->getOriginalContent());
    //     $response->assertJsonStructure(['id','patient','city','doctor','speciality','date'],$response->getOriginalContent()[0]->toArray(null));
    //     $this->assertInstanceOf("App\Http\Resources\ScheduledAppointments",$response->getOriginalContent()[0]);
    //     $response->assertHeader('Content-Type','application/json');
    //     $response->assertStatus(200);
    //     }

    // public function test_delete_patient_appoitnment(){
    //     $offset=3;
    //     $currentDate=date('Y-m-d H:s:i',Carbon::now()->addHours($offset)->getTimestamp());
    //     $city=City::factory(10)->create()->first();
    //     $speciality= Speciality::factory(10)->create()->first();
    //     $plan=Plan::factory(10)->create()->first();
    //     $doctor=Doctor::factory(10)->create()->first();
    //     $patient=Patient::factory(10)->create()->first();

    //     //set Patient's appointments
    //     $doctor=Doctor::factory(1)->create(['speciality_id'=>1])->first();
    //     $appointment1 = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>1,'patient_id'=>2,'date'=>$currentDate])->first();
    //     $appointment2 = Appointment::factory(1)->create(['doctor_id'=>$doctor->id,'city_id'=>2,'patient_id'=>2,'date'=>$currentDate])->first();

    //     $data=[
    //         'patient_id'=>$appointment2->patient_id,
    //         'appointment_id'=>$appointment2->id
    //     ];

    //     $response=$this->post('/api/v1/appointment-system/delete-patient-appointments',$data);
    //     $this->assertInstanceOf("App\Models\Appointment",$response->getOriginalContent());
    //     $this->assertDatabaseMissing('appointments',$appointment2->toArray());
    //     $response->assertHeader('Content-Type','application/json');
    //     $response->assertStatus(200);
    // }


}
