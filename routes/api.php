<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('auth/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('products', ProductController::class);
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'showCart']);
        Route::delete('/', [CartController::class, 'clearCart']);

        Route::post('/items', [CartController::class, 'addProduct']);
        Route::put('/items/{id}', [CartController::class, 'updateProduct']);
        Route::delete('/items/{id}', [CartController::class, 'removeProduct']);
    });

    Route::prefix('orders')->group(function () {
        Route::post('/', [OrderController::class, 'store']);
    });
});

