<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\Authenticate;


Route::prefix('/auth')
->controller(AuthController::class)
->group(function() {
    // Without Middleware
    Route::post('/register', 'register');
    Route::post('/login', 'login');

    Route::controller(AuthController::class)
    ->middleware(Authenticate::class)
    ->group(function() {
        Route::post('/logout', 'logout');
        Route::get('/authenticate', 'authenticate');
    });
});