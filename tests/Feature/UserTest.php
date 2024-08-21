<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    protected $baseUri = "http://127.0.0.1/api";
  
    public function test_create_user(): void
    {
       
        $user = User::factory()->create();
    
        $user->delete();
        
        $this->assertModelMissing($user);
    }

    public function test_basic_get_api(): void
    {
        $response = $this->get($this->baseUri . "/teste-api");
        $response->assertStatus(200);
    }

    public function test_register_user(): void
    {
        $uri = $this->baseUri . "/register";
        $response = $this->postJson($uri, [
            'email' => 'teste@eusei12.com',
            'password' => 'eutenhoumasenha',
            'name' => 'meu nome não é jhonny'
        ]);
        $response->assertJsonStructure([
            'token'            
        ]);
    }
    public function test_register_user_fail(): void
    {
        $uri = $this->baseUri . "/register";
        $response = $this->postJson($uri, [
            'email' => 'teste@eusei12.com',
            'password' => '1',
            'name' => 'meu nome não é jhonny'
        ]);
        // $response->dump();
        $response->assertJsonStructure([
            'errors'            
        ]);
    }

}
