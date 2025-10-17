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
use App\Http\Controllers\AccidentInvestigationController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;




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
// Route::redirect('/', '/login');

// Root redirect ke login
Route::get('/', function() {
    if(auth()->check()){
        return auth()->user()->role === 'admin'
            ? redirect('/admin/dashboard')
            : redirect('/user/dashboard');
    }
    return view('auth.login');
});


// Login routes
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');







// ADMIN
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
    Route::resource('/sites', SitesController::class);

    // Daftar user
    Route::get('/admin/users', [AdminDashboardController::class, 'indexUser'])
        ->name('admin.user.index');
        Route::get('/admin/dashboard/accident',[AdminDashboardController::class, 'indexAccident'] )->name('admin.accident.index');

Route::get('/admin/users/{user}/edit', [AdminDashboardController::class, 'edit'])->name('admin.user.edit');
Route::put('/admin/users/{user}', [AdminDashboardController::class, 'update'])->name('admin.user.update');
Route::get('/admin/accidents/show/{accident}', [AdminDashboardController::class, 'show'])->name('admin.accident.show');
Route::get('/admin/accident/filtered', [AdminDashboardController::class, 'filteredAccident'])->name('admin.accident.filter');
Route::get('/admin/inspection/index', [AdminDashboardController::class, 'indexInspection'])->name('admin.inspection.index');
Route::get('/admin/inspection/show/{inspection}', [AdminDashboardController::class, 'showInspection'])->name('admin.inspection.show');
Route::put('/admin/inspection/update/{inspection}', [AdminDashboardController::class, 'updateInspection'])->name('admin.inspection.update');
Route::get('/admin/investigations', [AccidentInvestigationController::class, 'index'])->name('investigations.index');
Route::get('/admin/investigations/create/{accident}', [AccidentInvestigationController::class, 'create'])->name('investigations.create');
Route::post('/admin/investigations', [AccidentInvestigationController::class, 'store'])->name('investigations.store');
Route::get('/admin/investigations/{investigation}/edit', [AccidentInvestigationController::class, 'edit'])->name('investigations.edit');
Route::put('/admin/investigations/{investigation}', [AccidentInvestigationController::class, 'update'])->name('investigations.update');
Route::delete('/admin/investigations/{investigation}', [AccidentInvestigationController::class, 'destroy'])->name('investigations.destroy');
Route::post('/update-status/{id}', [AccidentInvestigationController::class, 'updateStatus']);




});



//USER
Route::middleware(['auth', 'user'])->group(function () {
     Route::get('/user/dashboard',[UserDashboardController::class, 'index'])->name('user.dashboard');
     Route::get('sites', [SitesController::class, 'index'])->name('sites.index');
  Route::resource('accidents', AccidentController::class);
    Route::resource('inspections', InspectionsController::class);
    Route::resource('trainings', TrainingsController::class);
    Route::resource('assessments', AssessmentsController::class);
    Route::resource('safety-activities', SafetyActivitiesController::class);
    Route::resource('manpowers', ManpowerController::class);
    Route::resource('manhours', ManhoursController::class);

    
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
