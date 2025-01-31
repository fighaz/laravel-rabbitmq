<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/products/{id}/like', [App\Http\Controllers\ProductController::class, 'like']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
