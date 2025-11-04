<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AccidentController;
use App\Http\Controllers\AssessmentsController;
use App\Http\Controllers\TrainingsController;
use App\Http\Controllers\CertificationsController;
use App\Http\Controllers\InspectionsController;
use App\Http\Controllers\ManhoursController;
use App\Http\Controllers\ManpowerController;
use App\Http\Controllers\SafetyActivitiesController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\InvestigationController;
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
Route::get('/', function() {
    if (auth()->check()) {
        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login');
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// ADMIN
Route::middleware('auth', 'admin')->group(function () {
    
Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::resource('/sites', SitesController::class);

Route::get('/admin/users', [AdminDashboardController::class, 'indexUser'])->name('admin.user.index');
Route::get('/admin/users/edit/{user}', [AdminDashboardController::class, 'editUser'])->name('admin.user.edit');
Route::put('/admin/users/{user}', [AdminDashboardController::class, 'updateUser'])->name('admin.user.update');

Route::get('/admin/dashboard/accident',[AdminDashboardController::class, 'indexAccident'] )->name('admin.accident.index');
Route::get('/admin/accidents/show/{accident}', [AdminDashboardController::class, 'show'])->name('admin.accident.show');
Route::get('/admin/accident/filtered', [AdminDashboardController::class, 'filteredAccident'])->name('admin.accident.filter');
Route::post('/update-status-accident/{id}', [AdminDashboardController::class, 'updateStatus'])->name('update.status');
Route::get('/admin/accident/edit/{accident}', [AdminDashboardController::class, 'editAccident'])->name('admin.accident.edit');
Route::put('/admin/accident/update/{accident}', [AdminDashboardController::class, 'updateAccident'])->name('admin.accident.update');

Route::get('/admin/inspection/index', [AdminDashboardController::class, 'indexInspection'])->name('admin.inspection.index');
Route::post('/admin/inspection/store', [AdminDashboardController::class, 'storeInspection'])->name('admin.inspection.store');
Route::get('/admin/inspection/show/{inspection}', [AdminDashboardController::class, 'showInspection'])->name('admin.inspection.show');
Route::get('/admin/inspection/edit/{inspection}', [AdminDashboardController::class, 'editInspection'])->name('admin.inspection.edit');
Route::put('/admin/inspection/update/{inspection}', [AdminDashboardController::class, 'updateInspection'])->name('admin.inspection.update');
Route::put('/admin/inspection/{id}/notes', [AdminDashboardController::class, 'updateNotes'])->name('admin.inspection.updateNotes');
Route::post('/update-status/{id}', [AdminDashboardController::class, 'updateStatusInspection'])->name('update.status');


Route::get('/admin/investigations/{accident}', [InvestigationController::class, 'index'])->name('investigations.index');
Route::get('/admin/investigations/create/{accident}', [InvestigationController::class, 'create'])->name('investigations.create');
Route::post('/admin/investigations/{accident}', [InvestigationController::class, 'store'])->name('investigations.store');
Route::get('/admin/investigations/{investigation}/edit', [InvestigationController::class, 'edit'])->name('investigations.edit');
Route::put('/admin/investigations/{investigation}', [InvestigationController::class, 'update'])->name('investigations.update');
Route::delete('/admin/investigations/{investigation}', [InvestigationController::class, 'destroy'])->name('investigations.destroy');


Route::get('/admin/assessment/index', [AdminDashboardController::class, 'indexAssessment'])->name('admin.assessment.index');
Route::get('/admin/assessment/adit/{assessment}', [AdminDashboardController::class, 'editAssessment'])->name('admin.assessment.edit');
Route::put('/admin/assessment/{assessment}', [AdminDashboardController::class, 'updateAssessment'])->name('admin.assessment.update');
Route::get('/admin/assessment/show/{assessment}', [AdminDashboardController::class, 'showAssessment'])->name('admin.assessment.show');

Route::get('/admin/manhour/index', [AdminDashboardController::class, 'indexManhour'])->name('admin.manhour.index');
Route::get('/admin/manhour/edit/{manhour}', [AdminDashboardController::class, 'editManhour'])->name('admin.manhour.edit');
Route::put('/admin/manhour/{manhour}', [AdminDashboardController::class, 'updateManhour'])->name('admin.manhour.update');
Route::get('/admin/manhour/show/{manhour}', [AdminDashboardController::class, 'showManhour'])->name('admin.manhour.show');

Route::get('/admin/manpower/index', [AdminDashboardController::class, 'indexManpower'])->name('admin.manpower.index');
Route::get('/admin/manpower/edit/{manpower}', [AdminDashboardController::class, 'editManpower'])->name('admin.manpower.edit');
Route::put('/admin/manpower/{manpower}', [AdminDashboardController::class, 'updateManpower'])->name('admin.manpower.update');
Route::get('/admin/manpower/show/{manpower}', [AdminDashboardController::class, 'showManpower'])->name('admin.manpower.show');

Route::get('/admin/safetyActivity/index', [AdminDashboardController::class, 'indexSafetyActivity'])->name('admin.safetyActivity.index');
Route::get('/admin/safetyActivity/edit/{safetyActivity}', [AdminDashboardController::class, 'editSafetyActivity'])->name('admin.safetyActivity.edit');
Route::put('/admin/safetyActivity/{safetyActivity}', [AdminDashboardController::class, 'updateSafetyActivity'])->name('admin.safetyActivity.update');
Route::get('/admin/safetyActivity/show/{safetyActivity}', [AdminDashboardController::class, 'showSafetyActivity'])->name('admin.safetyActivity.show');

Route::get('/admin/training/index', [AdminDashboardController::class, 'indexTraining'])->name('admin.training.index');
Route::get('/admin/training/filtered', [AdminDashboardController::class, 'filteredTraining'])->name('admin.training.filter');
Route::get('/admin/training/edit/{training}', [AdminDashboardController::class, 'editTraining'])->name('admin.training.edit');
Route::put('/admin/training/{training}', [AdminDashboardController::class, 'updateTraining'])->name('admin.training.update');
Route::get('/admin/training/show/{training}', [AdminDashboardController::class, 'showTraining'])->name('admin.training.show');

Route::get('/admin/certification/index', [AdminDashboardController::class, 'indexCertification'])->name('admin.certification.index');
Route::get('/admin/certification/filtered', [AdminDashboardController::class, 'filteredCertification'])->name('admin.certification.filter');
Route::get('/admin/certification/edit/{certification}', [AdminDashboardController::class, 'editCertification'])->name('admin.certification.edit');
Route::put('/admin/certification/update/{certification}', [AdminDashboardController::class, 'updateCertification'])->name('admin.certification.update');
Route::get('/admin/certification/show/{certification}', [AdminDashboardController::class, 'showCertification'])->name('admin.certification.show');

});


// USER
Route::middleware('auth', 'user')->group(function () {

Route::get('/user/dashboard',[UserDashboardController::class, 'index'])->name('user.dashboard');
Route::get('sites', [SitesController::class, 'index'])->name('sites.index');
Route::resource('accidents', AccidentController::class);
Route::resource('inspections', InspectionsController::class);
Route::resource('trainings', TrainingsController::class);
Route::resource('certifications',CertificationsController::class);
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
