<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
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
use App\Http\Controllers\AbsenceRuleController;
use App\Http\Controllers\AnnouncementController;

// use App\Http\Controllers\TraineeController\DashboardController;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\LoginController;


// Route::post('/trainee/login', [LoginController::class, 'loginTrainee'])->name('login.trainee');
// Route::post('/trainee/logout', [LoginController::class, 'logoutTrainee'])->name('logout.trainee');

Route::get('/trainee/dashboard', [ App\Http\Controllers\TraineeController\DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('trainee.dashboard');

Route::get('/trainee/cohort', [ App\Http\Controllers\TraineeController\DashboardController::class, 'cohort'])
    ->middleware(['auth'])
    ->name('trainee.cohort');

Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // Absence Rules CRUD Routes
    Route::get('absence-rules', [AbsenceRuleController::class, 'index'])->name('absence_rules.index'); // List absence rules
    Route::get('absence-rules/create', [AbsenceRuleController::class, 'create'])->name('absence_rules.create'); // Show create form
    Route::post('absence-rules', [AbsenceRuleController::class, 'store'])->name('absence_rules.store'); // Store new absence rule
    Route::get('absence-rules/{id}/edit', [AbsenceRuleController::class, 'edit'])->name('absence_rules.edit'); // Show edit form
    Route::put('absence-rules/{id}', [AbsenceRuleController::class, 'update'])->name('absence_rules.update'); // Update absence rule
    Route::delete('absence-rules/{id}', [AbsenceRuleController::class, 'destroy'])->name('absence_rules.destroy'); // Delete absence rule
});


Route::get('/techno_to_cohort', [TechnoToCohortController::class, 'index'])->name('techno_to_cohort.index');
Route::post('/techno_to_cohort', [TechnoToCohortController::class, 'store'])->name('techno_to_cohort.store');
Route::get('/get-cohorts/{academy}', [TechnoToCohortController::class, 'getCohorts']);

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    
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




Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('absences', AbsenceController::class);
    Route::post('absences/{absence}/approve', [AbsenceController::class, 'approve'])->name('absences.approve');
    Route::post('absences/{absence}/reject', [AbsenceController::class, 'reject'])->name('absences.reject');
    
    Route::resource('announcements', AnnouncementController::class);
});

// Cohorts CRUD
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    

    Route::get('cohorts', [CohortController::class, 'cohorts'])->name('cohorts');
    Route::get('cohorts/create', [CohortController::class, 'createCohort'])->name('cohorts.create');
    Route::post('cohorts/store', [CohortController::class, 'storeCohort'])->name('cohorts.store');
    Route::get('cohorts/{id}/edit', [CohortController::class, 'editCohort'])->name('cohorts.edit');
    Route::post('cohorts/{id}/update', [CohortController::class, 'updateCohort'])->name('cohorts.update');
    Route::delete('cohorts/{id}/delete', [CohortController::class, 'deleteCohort'])->name('cohorts.delete');
    Route::post('cohorts/{cohorts}/toggle-active', [CohortController::class, 'toggleCohortActive'])->name('cohorts.toggle-active');
});


// Classrooms Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // Display classrooms list
    Route::get('classrooms', [ClassroomController::class, 'index'])->name('classrooms');

    // Store classroom (creating a new classroom)
    Route::post('classrooms/store', [ClassroomController::class, 'store'])->name('classrooms.store');
    Route::put('classrooms/{classroom}/update', [ClassroomController::class, 'update'])->name('classrooms.update');

    // Toggle active/inactive status

    Route::post('classrooms/{classroom}/toggle-active', [ClassroomController::class, 'toggleActive'])->name('classrooms.toggle-active');

    // Mark classroom as deleted
    Route::post('classrooms/{classroom}/delete', [ClassroomController::class, 'delete'])->name('classrooms.delete');

    // Restore a deleted classroom
    Route::post('classrooms/{classroom}/restore', [ClassroomController::class, 'restore'])->name('classrooms.restore');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('jobCoaches', JobCoachController::class);
    Route::post('jobCoaches/{id}/toggle-active', [JobCoachController::class, 'toggleActive'])->name('jobCoaches.toggle-active');

    Route::resource('assignments', AssignmentController::class);
    Route::resource('technologies', TechnologyController::class);
  
 


});




// Trainers CRUD
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('trainers', [TrainerController::class, 'trainers'])->name('trainers');
    Route::get('trainers/create', [TrainerController::class, 'createTrainer'])->name('trainers.create');
    Route::post('trainers/store', [TrainerController::class, 'storeTrainer'])->name('trainers.store');
    Route::get('trainers/{id}/edit', [TrainerController::class, 'editTrainer'])->name('trainers.edit');
    Route::put('trainers/{id}', [TrainerController::class, 'updateTrainer'])->name('trainers.update');
    Route::delete('trainers/{id}', [TrainerController::class, 'deleteTrainer'])->name('trainers.destroy');
    Route::post('trainers/{trainer}/toggle-active', [TrainerController::class, 'toggleTrainerActive'])->name('trainers.toggle-active');
});

// Trainees CRUD Routes
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::get('trainees', [TraineeController::class, 'trainees'])->name('trainees'); // List all trainees
    Route::post('trainees/store', [TraineeController::class, 'storeTrainee'])->name('trainees.store'); // Add a new trainee
    Route::get('trainees/edit/{id}', [TraineeController::class, 'editTrainee'])->name('trainees.edit'); // Edit trainee
    Route::put('trainees/update/{id}', [TraineeController::class, 'updateTrainee'])->name('trainees.update'); // Update trainee
    Route::post('trainees/{trainee}/toggle-active', [TraineeController::class, 'toggleTraineeActive'])->name('trainees.toggle-active'); // Toggle active/inactive
    Route::delete('trainees/delete/{id}', [TraineeController::class, 'deleteTrainee'])->name('trainees.destroy'); // Mark as deleted
});

// General
Route::get('/', function () {
    return view('/auth/login');
});
Route::get('/trainee/login', function () {
    return view('trainee.login');
});

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include authentication routes
require __DIR__.'/auth.php';


require __DIR__.'/trainee-auth.php';
