<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccidentController;
use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\InspectionsController;
use App\Http\Controllers\ManhoursController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\SafetyActivitiesController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


/// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
     Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/sites', SitesController::class);

});




//USER
Route::middleware(['auth', 'user'])->group(function () {
     Route::get('/user/dashboard',[UserDashboardController::class, 'index'])->name('user.dashboard');
    Route::resource('/accidents', AccidentController::class);
    Route::resource('/inspections', InspectionsController::class);
    Route::resource('/trainings', TrainingsController::class);
    Route::resource('/assessments', AssessmentsController::class);
    Route::resource('/safety-activities', SafetyActivitiesController::class);
    Route::resource('/manpowers', ManpowerController::class);
    Route::resource('/manhours', ManhoursController::class);

    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
