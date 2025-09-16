<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalAidController;
use App\Http\Controllers\Admin\PanelLawyerController;

Route::get('/', function () {
    return view('/homepage/home');
});

Route::get('/homepage/legalaid', [HomeController::class, 'legal'])->name('homepage.legalaid');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/register', [AdminAuthController::class, 'registerForm'])->name('admin.register');
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

//admin viewing legal aid application
Route::get('/admin/legal_aid', [LegalAidController::class, 'pageView'])->name('admin.legal_aid.index');

// Panel Lawyers
Route::get('/admin/panel_lawyers', [PanelLawyerController::class, 'index'])->name('admin.panel_lawyers.index'); // list
Route::get('/admin/panel_lawyers/create', [PanelLawyerController::class, 'create'])->name('admin.panel_lawyers.create'); // form
Route::post('/admin/panel_lawyers/store', [PanelLawyerController::class, 'store'])->name('admin.panel_lawyers.store');
Route::delete('/admin/panel_lawyers/{id}', [PanelLawyerController::class, 'destroy'])->name('admin.panel_lawyers.destroy');

//legal aid
Route::get('/legalaid', [LegalAidController::class, 'index'])->name('homepage.legalaid');
Route::post('/legalaid/store', [LegalAidController::class, 'store'])->name('homepage.legalaid.store');


require __DIR__ . '/auth.php';
