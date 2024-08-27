<?php

namespace Tests\Feature\Http\Controllers;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NoteControllerTest extends TestCase
{
    use RefreshDatabase;
  
    protected $baseUri = "http://127.0.0.1/api";
    public function initializeTestData():void {
       $db = new DatabaseSeeder();
       $db->run();
    }

    /**
     * Get index api
     */
    public function test_get_true(): void
    {
        $this->initializeTestData();
        $uri = $this->baseUri . "/notes";
        $response = $this->getJson($uri);

        $response->assertStatus(200);
    }

      /**
     * Get index api 404
     */
    public function test_get_404(): void
    {
        $this->initializeTestData();
        $uri = $this->baseUri . "/notes-1";
        $response = $this->getJson($uri);

        $response->assertStatus(404);
    }
}
