<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNoteRequest;
use App\Http\Requests\UpdateNoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes =  Note::all();
        return NoteResource::collection($notes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreNoteRequest $request)
    {
        return 1;
    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        return 1;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNoteRequest $request, Note $note)
    {
        return 1;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        return 1;
    }
}
