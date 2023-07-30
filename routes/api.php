<?php

use App\Http\Controllers\API\V1\BookController;
use App\Http\Controllers\API\V1\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('user')->group(function () {
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout']);
});

Route::middleware('auth:api')->group(function () {
    Route::apiResource('books', BookController::class);
});