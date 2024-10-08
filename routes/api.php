<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, "register"]);
Route::post('/login', [AuthController::class, "login"]);

Route::get('/teste-api', function () {
    return ["mensagem" => 'API RODANDO, CARA!!'] ;
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'books' => BookController::class,
        'notes' => NoteController::class,
    ]);
});