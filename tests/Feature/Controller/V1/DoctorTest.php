<?php

namespace Tests\Feature\Controller\V1;

use Tests\TestCase;
use App\Models\Doctor;
use App\Models\Speciality;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorTest extends TestCase
{
    use RefreshDatabase;


    public function test_store()
    {
        $speciality=Speciality::factory(5)->create()->first();
        $data=[
            "name"=>'CARACAS',
            "age"=>34,
            "speciality_id"=>$speciality->id
        ];
        $response = $this->post('/api/v1/doctor/',$data);
        $this->assertDatabaseHas('doctors',$data);
        $response->assertStatus(201);
    }

    public function test_index()
    {
        $speciality=Speciality::factory(5)->create()->first();
        $doctors = Doctor::factory(10)->create();
        $response = $this->get('/api/v1/doctor/');
        $response->assertJsonStructure(['name','age'],$response->getOriginalContent()[1]);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $speciality=Speciality::factory(5)->create()->first();
        $doctor = Doctor::factory(1)->create();
        $response = $this->get('/api/v1/doctor/1');
        $response->assertJsonStructure(['name','age'],$response->getOriginalContent());
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $speciality=Speciality::factory(5)->create()->first();
        $doctor = Doctor::factory(1)->create()->first();

        $data=[
            'name'=>$doctor->name,
            'age'=>30,
            'speciality_id'=>$speciality->id
        ];
        $response = $this->put('/api/v1/doctor/1',$data);
        $response->assertJsonStructure(['name','age'],$response->getOriginalContent());
        $response->assertHeader('Content-Type','application/json');
        $this->assertDatabaseHas('doctors',$data);
        $response->assertStatus(200);
    }

    public function test_delete()
    {
        $speciality=Speciality::factory(5)->create()->first();
        $doctor = Doctor::factory(1)->create();
        $response = $this->delete('/api/v1/doctor/1');
        $this->assertDatabaseMissing('doctors',$doctor->first()->toArray());
        $response->assertStatus(204);
    }
}