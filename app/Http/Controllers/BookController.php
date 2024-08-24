<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books =  Book::all();
        return BookResource::collection($books);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBookRequest $request)
    {
        $book = Book::create($request->validated());
        return response(new BookResource($book), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {   
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBookRequest $request, Book $book)
    {
        $data = $request->validated(); 

        $book->fill($data)->save(); 

        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        // $jsonMessage = ["message" => "Book ".$id." Deletado"]; 
        // return response($jsonMessage, 200);
        return response()->noContent();
    }
}
