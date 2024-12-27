<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
Route::get('/', function () {
    return view('welcome');
});



// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('login/{userType}', [LoginController::class, 'showLoginForm'])
        ->name('login.show');
    Route::get('/about', [DashboardController::class, 'showAbout'])
        ->name('about.show');
    Route::get('admin/login', [DashboardController::class, 'loginButtons'])
        ->name('admin-login.show');
    Route::post('login/{userType}', [LoginController::class, 'login'])
        ->name('login.attempt');
    });


    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
// Dashboard Routes
    Route::middleware('auth:manager')->group(function () {
    Route::get('/manager/dashboard', [DashboardController::class, 'manager'])
        ->name('manager.dashboard');
    });

    Route::middleware('auth:trainer')->group(function () {
    Route::get('/trainer/dashboard', [DashboardController::class, 'trainer'])
        ->name('trainer.dashboard');
    });

    Route::middleware('auth:trainee')->group(function () {

        
    Route::get('/trainee/dashboard', [App\Http\Controllers\TraineeController\DashboardController::class, 'index'])
        ->name('trainee.dashboard');

    Route::get('/trainee/cohort', [App\Http\Controllers\TraineeController\DashboardController::class, 'cohort'])
    ->name('trainee.cohort');

    Route::get('/trainee/technology', [App\Http\Controllers\TraineeController\DashboardController::class, 'technology'])
    ->name('trainee.technology');

    Route::get('/trainee/assignment', [App\Http\Controllers\TraineeController\DashboardController::class, 'assignment'])
    ->name('trainee.assignment');

    Route::get('/trainee/announcements', [App\Http\Controllers\TraineeController\DashboardController::class, 'Announcements'])
    ->name('trainee.announcements');


    Route::post('/trainee/submit-assignment', [App\Http\Controllers\TraineeController\DashboardController::class, 'submit'])
    ->name('trainee.submitassignment');
    });
    Route::get('/trainee/{technology_id}/items/{user_id}', [App\Http\Controllers\TraineeController\DashboardController::class, 'items'])->name('technology.items');


    Route::middleware('auth:job-coach')->group(function () {
    Route::get('/job-coach/dashboard', [DashboardController::class, 'jobCoach'])
        ->name('job-coach.dashboard');  
    });


require __DIR__.'/admin-routs.php';
