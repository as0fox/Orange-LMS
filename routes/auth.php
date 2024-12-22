<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login/{userType}', [LoginController::class, 'showLoginForm'])
        ->name('login.show');
    Route::post('login/{userType}', [LoginController::class, 'login'])
        ->name('login.attempt');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])
        ->name('logout');
});