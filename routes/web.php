<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalAidController;
use App\Http\Controllers\Admin\PanelLawyerController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\MediationController;


// =========================================================================
// PUBLIC ROUTES
// =========================================================================

Route::get('/', [HomeController::class, 'home'])->name('homepage.home');

// Public Notice Board
Route::get('/homepage/notice', [HomeController::class, 'circular'])->name('homepage.notice');

Route::get('/homepage/contact', [HomeController::class, 'contact'])->name('homepage.contactus');
Route::get('/homepage/intro', [HomeController::class, 'hclscintro'])->name('homepage.intro');
Route::get('/homepage/lawyers', [HomeController::class, 'lawyers'])->name('homepage.lawyers');

// Legal Aid
Route::get('/homepage', [LegalAidController::class, 'index'])->name('homepage.legalaid');
Route::post('/homepage/store', [LegalAidController::class, 'store'])->name('homepage.legalaid.store');
Route::get('/homepage/track', [LegalAidController::class, 'trackPage'])->name('homepage.track');

// Public Mediation Cause List
Route::get('/homepage/mediation', [HomeController::class, 'mediations'])->name('homepage.mediation');
// View Public Mediation Cause List PDF
Route::get('/homepage/mediation/view/{filename}', [HomeController::class, 'viewPdf'])->name('homepage.mediation.view');

// -------------------------------------------------------------------------
// AUTHENTICATION ROUTES (Forms are public, logic usually inside)
// -------------------------------------------------------------------------

// Admin Auth Routes (The forms are public, logic is protected or redirects)
Route::get('/admin/register', [AdminAuthController::class, 'registerForm'])->name('admin.register');
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');


// =========================================================================
// PDF CONTENT SERVER (UNPROTECTED) - FIX FOR ADOBE API 🛠️
// =========================================================================
// This route MUST be outside the 'auth' middleware group so the Adobe viewer 
// (which is unauthenticated) can successfully fetch the raw PDF bytes.
Route::get('/mediations/serve-pdf/{filename}', [MediationController::class, 'servePdfContent'])->name('admin.mediations.servePdfContent');


// =========================================================================
// ADMIN PANEL (PROTECTED)
// =========================================================================
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () { 

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Legal Aid (Protected)
    Route::get('/legal_aid', [LegalAidController::class, 'pageView'])->name('admin.legal_aid.index');
    Route::get('/legal_aid/{applicant}', [LegalAidController::class, 'show'])->name('admin.legal_aid.show');
    Route::post('/legal_aid/{id}/assign-lawyer', [LegalAidController::class, 'assignLawyer'])->name('admin.legal_aid.assignLawyer');
    Route::post('/legal_aid/{id}/store-order-docs', [LegalAidController::class, 'storeOrderAndDocs'])->name('admin.legal_aid.storeOrderDocs');
    Route::post('/legal-aid/{id}/reject', [LegalAidController::class, 'rejectApplicant'])->name('admin.legal_aid.rejectApplicant');
    Route::post('/legal-aid/{id}/revert', [LegalAidController::class, 'revertApplicant'])->name('admin.legal_aid.revertApplicant');

    // Panel Lawyers (Protected)
    Route::get('/panel_lawyers', [PanelLawyerController::class, 'index'])->name('admin.panel_lawyers.index');
    Route::get('/panel_lawyers/create', [PanelLawyerController::class, 'create'])->name('admin.panel_lawyers.create');
    Route::post('/panel_lawyers/store', [PanelLawyerController::class, 'store'])->name('admin.panel_lawyers.store');
    Route::delete('/panel_lawyers/{id}', [PanelLawyerController::class, 'destroy'])->name('admin.panel_lawyers.destroy');

    // Notices (Protected)
    Route::get('notices', [NoticeController::class, 'index'])->name('admin.notices.index');
    Route::get('notices/create', [NoticeController::class, 'create'])->name('admin.notices.create');
    Route::post('notices/store', [NoticeController::class, 'store'])->name('admin.notices.store');
    Route::get('notices/{notice}/toggle-status', [NoticeController::class, 'toggleStatus'])->name('admin.notices.toggle-status');

    // Mediation Cause Lists (Protected)
    Route::get('/mediations', [MediationController::class, 'index'])->name('admin.mediations.index');
    Route::get('/mediations/create', [MediationController::class, 'create'])->name('admin.mediations.create');
    Route::post('/mediations/store', [MediationController::class, 'store'])->name('admin.mediations.store');
    Route::get('/mediations/{id}/edit', [MediationController::class, 'edit'])->name('admin.mediations.edit');
    Route::delete('/mediations/{id}', [MediationController::class, 'destroy'])->name('admin.mediations.destroy');
    Route::put('/mediations/{id}/update', [MediationController::class, 'update'])->name('admin.mediations.update');

    // PDF VIEWER ROUTE (Protected to ensure only admins can load the viewer HTML)
    Route::get('/mediations/view-pdf/{filename}', [MediationController::class, 'viewPdf'])
        ->name('admin.mediations.viewPdf');
});


// -------------------------------------------------------------------------
// User Profile Routes (Protected by standard 'auth' middleware)
// -------------------------------------------------------------------------
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';