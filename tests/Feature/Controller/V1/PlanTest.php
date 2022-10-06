<?php

namespace Tests\Feature\Controller\V1;

use Tests\TestCase;
use App\Models\Plan;
use App\Models\Speciality;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_store()
    {
        $data= [
            'name' => "Individual",
        ];

        $response = $this->post('/api/v1/plan/',$data);
        $this->assertDatabaseHas('plans',$data);
        $response->assertStatus(201);
    }

    public function test_speciality_attach()
    {
        $speciality=Speciality::factory(1)->create()->first();
        $data= [
            'name' => "Individual",
            'speciality_id'=>$speciality->id
        ];

        $response = $this->post('/api/v1/plan/',$data);
        $this->assertDatabaseHas('plans',['name'=>$data['name']]);
        $this->assertDatabaseHas('plan_speciality',[
            'plan_id'=>$response->getOriginalContent()->first()->id,
            'speciality_id'=>$response->getOriginalContent()->first()->specialities->first()->id
        ]);
        $response->assertStatus(201);
    }

    public function test_index()
    {
        $plans = Plan::factory(10)->create();
        $response = $this->get('/api/v1/plan/');
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['name'],$response->getOriginalContent()[1]);
        
    }

    public function test_show()
    {
        $plan = Plan::factory(1)->create();
        $response = $this->get('/api/v1/plan/1');
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['name'],$response->getOriginalContent());

    }

    public function test_edit()
    {
        $plan = Plan::factory(1)->create()->first();

        $data= [
            'name' => "Individual"
        ];
        $response = $this->put('/api/v1/plan/1',$data);
        $response->assertHeader('Content-Type','application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure(['name'],$response->getOriginalContent());
        $this->assertDatabaseHas('plans',$data);
    }

    public function test_delete()
    {
        $plan = Plan::factory(1)->create();
        $response = $this->delete('/api/v1/plan/1');
        $response->assertStatus(204);
        $this->assertDatabaseMissing('plans',$plan->first()->toArray());
    }
    public function test_speciality_detach()
    {
        $this->test_speciality_attach();
        $plan = Plan::find(1);
        $speciality=Speciality::find(1);
        $plan_id=$plan->id;
        $speciality_id=$speciality->id;
        $data= [
            'speciality_id'=>$speciality_id
        ];
        $response = $this->delete('/api/v1/plan/1',$data);
        $response->assertStatus(204);
        $this->assertDatabaseMissing('plans',$plan->toArray());
        $this->assertDatabaseMissing('plan_speciality',[
            'plan_id'=>$plan_id,
            'speciality_id'=>$speciality_id
        ]);
    }
}
