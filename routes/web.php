<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalAidController;
use App\Http\Controllers\Admin\PanelLawyerController;
use App\Http\Controllers\Admin\NoticeController;


Route::get('/', [HomeController::class, 'home'])->name('homepage.home');

// Public Notice Board
Route::get('/homepage/notice', [HomeController::class, 'circular'])->name('homepage.notice');
Route::get('/homepage/contact', [HomeController::class, 'contact'])->name('homepage.contactus');

//legal aid
Route::get('/homepage', [LegalAidController::class, 'index'])->name('homepage.legalaid');
Route::post('/homepage/store', [LegalAidController::class, 'store'])->name('homepage.legalaid.store');
Route::get('/homepage/track', [LegalAidController::class, 'trackPage'])->name('homepage.track');

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
Route::get('/admin/legal_aid/{applicant}', [LegalAidController::class, 'show'])->name('admin.legal_aid.show');
Route::post('/admin/legal_aid/{id}/assign-lawyer', [LegalAidController::class, 'assignLawyer'])->name('admin.legal_aid.assignLawyer');
// Upload order documents after lawyer assignment
Route::post('/admin/legal_aid/{id}/store-order-docs', [LegalAidController::class, 'storeOrderAndDocs'])
    ->name('admin.legal_aid.storeOrderDocs');


// Panel Lawyers
Route::get('/admin/panel_lawyers', [PanelLawyerController::class, 'index'])->name('admin.panel_lawyers.index'); // list
Route::get('/admin/panel_lawyers/create', [PanelLawyerController::class, 'create'])->name('admin.panel_lawyers.create'); // form
Route::post('/admin/panel_lawyers/store', [PanelLawyerController::class, 'store'])->name('admin.panel_lawyers.store');
Route::delete('/admin/panel_lawyers/{id}', [PanelLawyerController::class, 'destroy'])->name('admin.panel_lawyers.destroy');

//Admin creating Notices
Route::get('notices', [NoticeController::class, 'index'])->name('admin.notices.index');
Route::get('notices/create', [NoticeController::class, 'create'])->name('admin.notices.create');
Route::post('notices/store', [NoticeController::class, 'store'])->name('admin.notices.store');

// Toggle status
Route::get('notices/{notice}/toggle-status', [NoticeController::class, 'toggleStatus'])->name('admin.notices.toggle-status');

require __DIR__ . '/auth.php';
