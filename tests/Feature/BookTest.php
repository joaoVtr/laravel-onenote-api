<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookTest extends TestCase
{
    use RefreshDatabase;
    protected $baseUri = "http://127.0.0.1/api";
    
    public function test_get_index_true(): void
    {
        $response = $this->getJson($this->baseUri . "/books");
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(200);
    }
    
    public function test_get_index_false(): void
    {
        $response = $this->getJson($this->baseUri . "/booksHIII");
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(404);
    }
    
    // public function test_get_user(): void
    // {
    //     User::factory(1)->create();
    //     $r = User::all()->random(); 
    //     // dump($r);
    // }
    
    // public function test_get_book(): void
    // {
    //     User::factory(10)->create();
    //     Book::factory(10)->create();
    //     $r = Book::all()->random(); 
    //     dump($r);
    // }

    public function test_register_book_true(): void
    {
        User::factory(1)->create();
        $userId = User::all()->random()->id; 
        $uri = $this->baseUri . "/books";
        $response = $this->postJson($uri, [
            'users' => $userId,
            'title' => 'umtitulo',
            'description' => 'descricao'
        ]);
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(201);
    }

    public function test_register_book_false(): void
    {
        User::factory(1)->create();
        $uri = $this->baseUri . "/books";
        $response = $this->postJson($uri, [
            'users' => '',
            'title' => '',
            'description' => ''
        ]);
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(422);
    }
}
