<?php

namespace Tests\Feature\Controller\V1;

use Tests\TestCase;
use App\Models\Plan;
use App\Models\Patient;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PatientTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_store()
    {
        $plan=Plan::factory(5)->create()->first();
        $data=[
            "name"=>'Raul',
            'document'=>9999999,
            "age"=>34,
            "address"=>'Calle 35',
            'phone_number'=>3210000000,
            "plan_id"=>$plan->id
        ];
        $response = $this->post('/api/v1/patient/',$data);
        $this->assertDatabaseHas('patients',$data);
        $response->assertStatus(201);
    }

    public function test_index()
    {
        $plans=Plan::factory(5)->create()->first();
        $patients = Patient::factory(10)->create();
        $response = $this->get('/api/v1/patient/');
        $response->assertJsonStructure(['name','document','age','address','phone_number','plan_id'],$response->getOriginalContent()[1]);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $plans=Plan::factory(5)->create()->first();
        $patient = Patient::factory(1)->create();
        $response = $this->get('/api/v1/patient/1');
        $response->assertJsonStructure(['name','document','age','address','phone_number','plan_id'],$response->getOriginalContent());
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $plans=Plan::factory(5)->create()->first();
        $patient = Patient::factory(1)->create()->first();

        $data=[
            'name'=>$patient->name,
            'document'=>9999998,
            'age'=>30,
            "address"=>'Calle 35',
            'phone_number'=>3210000000,
            "plan_id"=>$plans->id
        ];
        $response = $this->put('/api/v1/patient/1',$data);
        $response->assertJsonStructure(['name','document','age','address','phone_number','plan_id'],$response->getOriginalContent());
        $response->assertHeader('Content-Type','application/json');
        $this->assertDatabaseHas('patients',$data);
        $response->assertStatus(200);
    }

    public function test_delete()
    {
        $plans=Plan::factory(5)->create()->first();
        $patient = Patient::factory(1)->create();
        $response = $this->delete('/api/v1/patient/1');
        $this->assertDatabaseMissing('patients',$patient->first()->toArray());
        $response->assertStatus(204);
    }

}
