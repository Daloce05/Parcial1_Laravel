<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController; // 👈 IMPORTANTE
use App\Http\Controllers\CategoryController;



Route::get('books/active', [BookController::class, 'activeBooks']);
Route::get('books/category/{id}', [BookController::class, 'booksByCategory']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('books', BookController::class);
Route::apiResource('categories', CategoryController::class);



Route::get('categories/active-with-books', [CategoryController::class, 'activeWithBooks']);
