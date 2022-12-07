<?php

namespace Tests\Feature\Controller\Auth;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_createToken()
    {
        User::factory(1)->create();
        $user=User::find(1);
        $data=[
            'email'=>$user->email,
            'password'=>'password',
        ];
        $response = $this->post('/api/authenticate',$data);
        $response->assertJsonStructure(['message','token']);
        $response->assertStatus(200);
    }

    public function test_bad_createToken()
    {
        User::factory(1)->create();
        $user=User::find(1);
        $data=[
            'email'=>'another@email.com',
            'password'=>$user->password,
        ];
        $response = $this->post('/api/authenticate',$data);
        $this->assertEmpty($response->getOriginalContent()['token']);
        $response->assertStatus(401);
    }
}
