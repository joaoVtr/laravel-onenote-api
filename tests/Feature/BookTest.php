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
    protected $userId;
    protected $insertBookArr = [
        'users' => '',
        'title' => '',
        'description' => ''
    ]; 

    public function initializeTestData():void {
        $this->userId = User::factory(1)->create()->first()->id;
        $this->insertBookArr = [
                'users' => $this->userId,
                'title' => 'umtitulo',
                'description' => 'descricao'];
    }

    public function test_get_index_true(): void
    {
        $this->initializeTestData();
        Book::factory(1)->create()->first()->id;

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

    public  function test_register_book_true(): void
    {
        $this->initializeTestData();
        $insertDataOk = $this->insertBookArr; 

        $uri = $this->baseUri . "/books";
        $response = $this->postJson($uri, $insertDataOk);
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(201);
    }

    public function test_register_book_false(): void
    {
        $uri = $this->baseUri . "/books";
        $insertDataNotOk = $this->insertBookArr; 

        $response = $this->postJson($uri, $insertDataNotOk);
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(422);
    }
    public function test_get_one_book_true(): void
    {
        $uri = $this->baseUri . "/books";
        $this->initializeTestData();
        
        $bookId = Book::factory(1)->create()->first()->id;
        
        $response = $this->getJson($uri."/".$bookId);
        // dump($response->json());
        // dump($response->status());
        $response->assertStatus(200);
    }

    public function test_get_one_book_false(): void
    {
        $uri = $this->baseUri . "/books";
        
        $response = $this->getJson($uri."/-1");
        $response->assertStatus(404);
    }

    public function test_update_one_book_true(): void
    {
        $uri = $this->baseUri . "/books";
        $this->initializeTestData();
        
        $bookId = Book::factory(1)->create()->first()->id;
        
        $response = $this->putJson($uri."/".$bookId, [
            "description" => "Nova Descição",
            "title" => "novo Título"
        ]);
        $response->assertStatus(200);
    }

    public function test_update_one_book_error_data(): void
    {
        $uri = $this->baseUri . "/books";
        $this->initializeTestData();
        
        $bookId = Book::factory(1)->create()->first()->id;
        
        $response = $this->putJson($uri."/".$bookId, [
            "description" => "",
            "title" => ""
        ]);
        $response->assertStatus(422);
    }

    public function test_delete_one_book_true(): void
    {
        $uri = $this->baseUri . "/books";
        $this->initializeTestData();
        
        $bookId = Book::factory(1)->create()->first()->id;
        
        $response = $this->deleteJson($uri."/".$bookId);
        $response->assertStatus(204);
    }

    public function test_delete_one_book_false(): void
    {
        $uri = $this->baseUri . "/books";
        $this->initializeTestData();
        
        Book::factory(1)->create()->first()->id;
        
        $response = $this->deleteJson($uri."/-1");
        $response->assertStatus(404);
    }
}
