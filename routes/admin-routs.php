<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\JobCoachController;
use App\Http\Controllers\AbsenceController;
use App\Http\Controllers\TechnologyController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AcademyController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\CohortController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TechnoToCohortController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\SubmittedAssignmentsController;
use App\Http\Controllers\AbsenceRuleController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TraineeController\DashboardController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->middleware(['auth:web,job-coach,manager'])->name('admin.')->group(function () {
    // Absence Rules CRUD Routes
    Route::get('absence-rules', [AbsenceRuleController::class, 'index'])->name('absence_rules.index'); // List absence rules
    Route::get('absence-rules/create', [AbsenceRuleController::class, 'create'])->name('absence_rules.create'); // Show create form
    Route::post('absence-rules', [AbsenceRuleController::class, 'store'])->name('absence_rules.store'); // Store new absence rule
    Route::get('absence-rules/{id}/edit', [AbsenceRuleController::class, 'edit'])->name('absence_rules.edit'); // Show edit form
    Route::put('absence-rules/{id}', [AbsenceRuleController::class, 'update'])->name('absence_rules.update'); // Update absence rule
    Route::delete('absence-rules/{id}', [AbsenceRuleController::class, 'destroy'])->name('absence_rules.destroy'); // Delete absence rule
});

Route::middleware(['auth:web,manager,job-coach,trainer'])->group(function () {

   

    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});



Route::middleware(['auth:web'])->group(function () {

// Managers CRUD
Route::get('/admin/managers', [ManagerController::class, 'managers'])->name('admin.managers');
Route::post('/admin/managers/store', [ManagerController::class,'storeManager'])->name('managers.store');
Route::get('/admin/managers/edit/{id}',[ManagerController::class, 'editManager'])->name('managers.edit');
Route::put('/admin/managers/update/{id}',[ManagerController::class, 'updateManager'])->name('managers.update');
Route::delete('/admin/managers/delete/{id}',[ManagerController::class, 'destroyManager'])->name('managers.destroy');
Route::post('/managers/{manager}/toggle-active', [ManagerController::class, 'toggleActive'])->name('managers.toggle-active');

// Academies CRUD
Route::get('/admin/academies/create', [AcademyController::class, 'createAcademy'])->name('academies.create'); // Show Create Form
Route::post('/admin/academies', [AcademyController::class, 'storeAcademy'])->name('academies.store'); // Store Academy
Route::get('/admin/academies/{id}/edit', [AcademyController::class, 'editAcademy'])->name('academies.edit'); // Show Edit Form
Route::put('/admin/academies/{id}', [AcademyController::class, 'updateAcademy'])->name('academies.update'); // Update Academy
Route::delete('/admin/academies/{id}', [AcademyController::class, 'deleteAcademy'])->name('academies.destroy'); // Delete Academy
Route::get('/admin/academies', [AcademyController::class, 'academies'])->name('admin.academies');

});




Route::prefix('admin')->middleware(['auth:web,trainer,job-coach,manager'])->group(function () {
    Route::resource('absences', AbsenceController::class);
    Route::post('absences/{absence}/approve', [AbsenceController::class, 'approve'])->name('absences.approve');
    Route::post('absences/{absence}/reject', [AbsenceController::class, 'reject'])->name('absences.reject');
    Route::put('/absences/{id}', [AbsenceController::class, 'update'])->name('absences.update');

    Route::resource('announcements', AnnouncementController::class);
    Route::post('announcements/{id}/toggle-active', [AnnouncementController::class, 'toggleActive'])->name('announcements.toggleActive');
    
});

Route::middleware(['auth:web,trainer,manager'])->group(function () {
    Route::get('submitted-assignments', [SubmittedAssignmentsController::class, 'index'])
        ->name('admin.submitted-assignments.index');
    Route::get('submitted-assignments/data', [SubmittedAssignmentsController::class, 'getSubmittedAssignments'])
        ->name('admin.submitted-assignments.data');
    Route::get('submitted-assignments/{id}', [SubmittedAssignmentsController::class, 'show'])
        ->name('admin.submitted-assignments.show');
});
// Cohorts CRUD
Route::prefix('admin')->name('admin.')->middleware(['auth:web,manager'])->group(function () {
    

    Route::get('cohorts', [CohortController::class, 'cohorts'])->name('cohorts');
    Route::get('cohorts/create', [CohortController::class, 'createCohort'])->name('cohorts.create');
    Route::post('cohorts/store', [CohortController::class, 'storeCohort'])->name('cohorts.store');
    Route::get('cohorts/{id}/edit', [CohortController::class, 'editCohort'])->name('cohorts.edit');
    Route::post('cohorts/{id}/update', [CohortController::class, 'updateCohort'])->name('cohorts.update');
    Route::delete('cohorts/{id}/delete', [CohortController::class, 'deleteCohort'])->name('cohorts.delete');
    Route::post('cohorts/{cohort}/toggle-active', [CohortController::class, 'toggleCohortActive'])->name('cohorts.toggle-active');
});



Route::prefix('admin')->middleware(['auth:web,manager'])->group(function () {
    Route::resource('jobCoaches', JobCoachController::class);
    Route::post('jobCoaches/{id}', [JobCoachController::class, 'update'])->name('jobCoaches.update');
    Route::post('jobCoaches/{id}/toggle-active', [JobCoachController::class, 'toggleActive'])->name('jobCoaches.toggle-active');
    

});
Route::prefix('admin')->middleware(['auth:web,trainer,manager'])->group(function () {
    // Display and assign technologies to cohorts
    Route::get('/techno_to_cohort', [TechnoToCohortController::class, 'index'])->name('techno_to_cohort.index');
    Route::post('/techno_to_cohort', [TechnoToCohortController::class, 'store'])->name('techno_to_cohort.store');
    
    // Update route for updating start and end dates
    Route::put('/techno_to_cohort/update/{id}', [TechnoToCohortController::class, 'update'])->name('techno_to_cohort.update');
    
    // AJAX route for fetching cohorts
    Route::get('/get-cohorts/{academy}', [TechnoToCohortController::class, 'getCohorts']);

    // Other resource routes
    Route::resource('assignments', AssignmentController::class);
    Route::resource('technologies', TechnologyController::class);


Route::resource('items', ItemController::class);
Route::post('items/{item}/toggle-active', [ItemController::class, 'toggleActive'])->name('items.toggle-active');

});





// Trainers CRUD
Route::prefix('admin')->name('admin.')->middleware(['auth:web,manager,manager'])->group(function () {
    Route::get('trainers', [TrainerController::class, 'trainers'])->name('trainers');
    Route::get('trainers/create', [TrainerController::class, 'createTrainer'])->name('trainers.create');
    Route::post('trainers/store', [TrainerController::class, 'storeTrainer'])->name('trainers.store');
    Route::get('trainers/{id}/edit', [TrainerController::class, 'editTrainer'])->name('trainers.edit');
    Route::post('trainers/{id}', [TrainerController::class, 'updateTrainer'])->name('trainers.update');
    Route::delete('trainers/{id}', [TrainerController::class, 'deleteTrainer'])->name('trainers.destroy');
    Route::post('trainers/{trainer}/toggle-active', [TrainerController::class, 'toggleTrainerActive'])->name('trainers.toggle-active');
});

// Trainees CRUD Routes
Route::prefix('admin')->name('admin.')->middleware(['auth:web,trainer,manager'])->group(function () {
    Route::get('trainees', [TraineeController::class, 'trainees'])->name('trainees'); // List all trainees
    Route::post('trainees/store', [TraineeController::class, 'storeTrainee'])->name('trainees.store'); // Add a new trainee
    Route::get('trainees/edit/{id}', [TraineeController::class, 'editTrainee'])->name('trainees.edit'); // Edit trainee
    Route::put('trainees/update/{id}', [TraineeController::class, 'updateTrainee'])->name('trainees.update'); // Update trainee
    Route::post('trainees/{trainee}/toggle-active', [TraineeController::class, 'toggleTraineeActive'])->name('trainees.toggle-active'); // Toggle active/inactive
    Route::delete('trainees/delete/{id}', [TraineeController::class, 'deleteTrainee'])->name('trainees.destroy'); // Mark as deleted
});
    


// Profile Routes
Route::middleware('auth:web,trainer,manager,job-coach')->group(function () {
    Route::controller(ProfileController::class)->group(function () {
        Route::get('/profile', 'index')->name('profile.index'); 
        // Route::get('/profile', 'edit')->name('profile.edit');
        Route::patch('/profile', 'update')->name('profile.update');
        Route::delete('/profile', 'destroy')->name('profile.destroy');
        Route::post('/profile/image', 'updateImage')->name('profile.image.update');
        Route::patch('/profile/password', 'updatePassword')->name('profile.password.update');
    });
});
Route::middleware('auth:trainee')->group(function () {
    Route::controller(StudentProfileController::class)->group(function () {
        Route::get('/profile/trainee', 'index')->name('studentProfile.index'); 
     
        Route::patch('/profile/trainee', 'update')->name('studentprofile.update');
        Route::delete('/profile/trainee', 'destroy')->name('studentprofile.destroy');
        Route::post('/profile/image/trainee', 'updateImage')->name('studentprofile.image.update');
        Route::patch('/profile/password/trainee', 'updatePassword')->name('studentprofile.password.update');
    });
});

// Include auth:webentication routes



