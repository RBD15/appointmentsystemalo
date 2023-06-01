<?php

namespace Tests\Feature\Controller\BackOffice\V1;

use Tests\TestCase;
use App\Models\Plan;
use App\Models\Speciality;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpecialityTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        $data= [
            'name' => "MEDICINA GENERAL",
            'description' =>  "Todo lo general de medicina"
        ];

        $response = $this->post('/api/v1/speciality/',$data);
        $this->assertDatabaseHas('specialities',$data);
        $response->assertStatus(201);
    }

    public function test_plan_attach()
    {
        $plan=Plan::factory(1)->create()->first();
        $data= [
            'name' => "Individual",
            'description' =>  "Todo lo general",
            'plan_id'=>$plan->id
        ];

        $response = $this->post('/api/v1/speciality/',$data);
        $this->assertDatabaseHas('specialities',['name'=>$data['name'],'description'=>$data['description']]);
        $this->assertDatabaseHas('plan_speciality',[
            'speciality_id'=>$response->getOriginalContent()->first()->id,
            'plan_id'=>$response->getOriginalContent()->first()->plans->first()->id
        ]);
        $response->assertStatus(201);
    }

    public function test_index()
    {
        $specialities = Speciality::factory(10)->create();
        $response = $this->get('/api/v1/speciality/');
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['name','description'],$response->getOriginalContent()[1]);

    }

    public function test_show()
    {
        $speciality = Speciality::factory(1)->create();
        $response = $this->get('/api/v1/speciality/1');
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['name','description'],$response->getOriginalContent());

    }

    public function test_edit()
    {
        $speciality = Speciality::factory(1)->create()->first();

        $data= [
            'name' => "MEDICINA GENERAL",
            'description' =>  "Todo lo general de medicina"
        ];
        $response = $this->put('/api/v1/speciality/1',$data);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['name','description'],$response->getOriginalContent());
        $this->assertDatabaseHas('specialities',$data);
    }

    public function test_delete()
    {
        $speciality = Speciality::factory(1)->create();
        $response = $this->delete('/api/v1/speciality/1');
        $response->assertStatus(204);
        $this->assertDatabaseMissing('specialities',$speciality->first()->toArray());
    }

    public function test_speciality_detach()
    {
        $this->test_plan_attach();
        $plan = Plan::find(1);
        $speciality=Speciality::find(1);
        $plan_id=$plan->id;
        $speciality_id=$speciality->id;
        $data= [
            'plan_id'=>$plan_id
        ];
        $response = $this->delete('/api/v1/speciality/1',$data);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('specialities',$speciality->toArray());
        $this->assertDatabaseMissing('plan_speciality',[
            'plan_id'=>$plan_id,
            'speciality_id'=>$speciality_id
        ]);
    }
}
