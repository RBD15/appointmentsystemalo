<?php

namespace Tests\Feature\Controller\V1;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        $data=[
            "name"=>'CARACAS',
            "description"=>'Sede principal servicio de salud',
            "address"=>'Av francisco de miranda'
        ];
        $response = $this->post('/api/v1/city/',$data);
        $this->assertDatabaseHas('cities',$data);
        $response->assertStatus(201);
    }

    public function test_index()
    {
        $cities = City::factory(10)->create();
        $response = $this->get('/api/v1/city/');
        $response->assertJsonStructure(['name','description','address'],$response->getOriginalContent()[1]);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_show()
    {
        $city = City::factory(1)->create();
        $response = $this->get('/api/v1/city/1');
        $response->assertJsonStructure(['name','description','address'],$response->getOriginalContent());
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
    }

    public function test_edit()
    {
        $city = City::factory(1)->create()->first();
        $data=[
            'name'=>$city->name,
            'description'=>'My description',
            'address'=>$city->address
        ];
        $response = $this->put('/api/v1/city/1',$data);
        $response->assertJsonStructure(['name','description','address'],$response->getOriginalContent());
        $response->assertHeader('Content-Type','application/json');
        $this->assertDatabaseHas('cities',$data);
        $response->assertStatus(200);
    }

    public function test_delete()
    {
        $city = City::factory(1)->create();
        $response = $this->delete('/api/v1/city/1');
        $this->assertDatabaseMissing('cities',$city->first()->toArray());
        $response->assertStatus(204);
    }
}
