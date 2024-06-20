<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login'])->middleware(['guest']);

Route::apiResource('/products', ProductController::class);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/cart', CartController::class);
    Route::apiResource('/cart-items', CartItemController::class)->only(['store', 'destroy']);

});


