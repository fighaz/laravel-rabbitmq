<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/products', App\Http\Controllers\ProductController::class);
Route::get('/user', [UserController::class, 'random']);
