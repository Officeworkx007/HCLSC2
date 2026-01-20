<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LegalAidController;
use App\Http\Controllers\Admin\PanelLawyerController;
use App\Http\Controllers\Admin\NoticeController;
use App\Http\Controllers\Admin\MediationController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\CalendarYearController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\HomeController;


// =========================================================================
// PUBLIC ROUTES
// =========================================================================

Route::get('/', [HomeController::class, 'home'])->name('homepage.home');

// Public Notice Board
Route::get('/homepage/notice', [HomeController::class, 'circular'])->name('homepage.notice');

Route::get('/homepage/contact', [HomeController::class, 'contact'])->name('homepage.contactus');
Route::post('/homepage/contact/store', [ContactUsController::class, 'store'])->name('homepage.contactus.store');
Route::get('/homepage/intro', [HomeController::class, 'hclscintro'])->name('homepage.intro');
Route::get('/homepage/lawyers', [HomeController::class, 'lawyers'])->name('homepage.lawyers');

// Legal Aid
Route::get('/homepage', [LegalAidController::class, 'index'])->name('homepage.legalaid');
Route::post('/homepage/store', [LegalAidController::class, 'store'])->name('homepage.legalaid.store');
Route::get('/homepage/track', [LegalAidController::class, 'showTrackForm'])->name('homepage.track');
Route::post('/homepage/track-status', [LegalAidController::class, 'trackApplication'])->name('homepage.track.status');

// Public Mediation Cause List
Route::get('/homepage/mediation', [HomeController::class, 'mediations'])->name('homepage.mediation');
// View Public Mediation Cause List PDF
Route::get('/homepage/mediation/view/{filename}', [HomeController::class, 'viewPdf'])->name('homepage.mediation.view');

Route::get('/homepage/gallery', [HomeController::class, 'gallery'])->name('homepage.gallery');

Route::get('/calendar/events', [HomeController::class, 'publicCalendarEvents'])->name('homepage.calendar.events');
Route::get('/calendar/month', [HomeController::class, 'publicCalendarMonth'])->name('homepage.calendar.month');

// Admin Auth Routes (The forms are public, logic is protected or redirects)
Route::get('/admin/register', [AdminAuthController::class, 'registerForm'])->name('admin.register');
Route::get('/admin/login', [AdminAuthController::class, 'loginForm'])->name('admin.login');
Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');

Route::get('/mediations/serve-pdf/{filename}', [MediationController::class, 'servePdfContent'])->name('admin.mediations.servePdfContent');


// =========================================================================
// ADMIN PANEL (PROTECTED)
// =========================================================================
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // --- ROLES & PERMISSIONS MANAGEMENT (NEW) ---
   Route::get('/admin/roles', [RoleController::class, 'index'])->name('admin.roles.index');
   Route::get('/admin/roles/create', [RoleController::class, 'create'])->name('admin.roles.create');
   Route::post('/admin/roles', [RoleController::class, 'store'])->name('admin.roles.store');

    // Legal Aid
    Route::get('/legal_aid', [LegalAidController::class, 'pageView'])->name('admin.legal_aid.index');
    Route::get('/legal_aid/{applicant}', [LegalAidController::class, 'show'])->name('admin.legal_aid.show');
    Route::delete('/legal_aid/{id}', [LegalAidController::class, 'destroy'])->name('admin.legal_aid.destroy');
    Route::post('/legal_aid/{id}/assign-lawyer', [LegalAidController::class, 'assignLawyer'])->name('admin.legal_aid.assignLawyer');
    Route::post('/legal_aid/{id}/store-order-docs', [LegalAidController::class, 'storeOrderAndDocs'])->name('admin.legal_aid.storeOrderDocs');
    Route::post('/legal-aid/{id}/reject', [LegalAidController::class, 'rejectApplicant'])->name('admin.legal_aid.rejectApplicant');
    Route::post('/legal-aid/{id}/revert', [LegalAidController::class, 'revertApplicant'])->name('admin.legal_aid.revertApplicant');
    Route::delete('/legal-aid/case-doc/{docId}', [LegalAidController::class, 'deleteCaseDoc'])->name('admin.legal_aid.deleteCaseDoc');

    // Panel Lawyers
    Route::get('/panel_lawyers', [PanelLawyerController::class, 'index'])->name('admin.panel_lawyers.index');
    Route::get('/panel_lawyers/create', [PanelLawyerController::class, 'create'])->name('admin.panel_lawyers.create');
    Route::post('/panel_lawyers/store', [PanelLawyerController::class, 'store'])->name('admin.panel_lawyers.store');
    Route::delete('/panel_lawyers/{id}', [PanelLawyerController::class, 'destroy'])->name('admin.panel_lawyers.destroy');
    Route::get('/panel_lawyers/{id}/edit', [PanelLawyerController::class, 'edit'])->name('admin.panel_lawyers.edit');
    Route::put('/panel_lawyers/{id}/update', [PanelLawyerController::class, 'update'])->name('admin.panel_lawyers.update');

    // Notices
    Route::get('notices', [NoticeController::class, 'index'])->name('admin.notices.index');
    Route::get('notices/create', [NoticeController::class, 'create'])->name('admin.notices.create');
    Route::post('notices/store', [NoticeController::class, 'store'])->name('admin.notices.store');
    Route::get('notices/{notice}/toggle-status', [NoticeController::class, 'toggleStatus'])->name('admin.notices.toggle-status');

    // Mediation Cause Lists
    Route::get('/mediations', [MediationController::class, 'index'])->name('admin.mediations.index');
    Route::get('/mediations/create', [MediationController::class, 'create'])->name('admin.mediations.create');
    Route::post('/mediations/store', [MediationController::class, 'store'])->name('admin.mediations.store');
    Route::get('/mediations/{id}/edit', [MediationController::class, 'edit'])->name('admin.mediations.edit');
    Route::delete('/mediations/{id}', [MediationController::class, 'destroy'])->name('admin.mediations.destroy');
    Route::put('/mediations/{id}/update', [MediationController::class, 'update'])->name('admin.mediations.update');

    // PDF VIEWER ROUTE
    Route::get('/mediations/view-pdf/{filename}', [MediationController::class, 'viewPdf'])
        ->name('admin.mediations.viewPdf');

    // Photo Gallery
    Route::get('/photo_gallery', [GalleryController::class, 'index'])->name('admin.photo_gallery.index');
    Route::get('/photo_gallery/create', [GalleryController::class, 'create'])->name('admin.photo_gallery.create');
    Route::post('/photo_gallery/store', [GalleryController::class, 'store'])->name('admin.photo_gallery.store');
    Route::get('/photo_gallery/{album}', [GalleryController::class, 'show'])->name('admin.photo_gallery.show');
    Route::delete('/photo_gallery/{album}', [GalleryController::class, 'destroy'])->name('admin.photo_gallery.destroy');
    Route::delete('/photo_gallery/{album}/photo/{photo}', [GalleryController::class, 'destroyPhoto'])->name('admin.photo_gallery.destroyPhoto');

    //Calendar
    Route::get('calendar', [CalendarYearController::class, 'index'])->name('admin.calendar.index');
    Route::get('calendar/create', [CalendarYearController::class, 'create'])->name('admin.calendar.create');
    Route::post('calendar/store', [CalendarYearController::class, 'store'])->name('admin.calendar.store');
    Route::get('calendar/{id}/edit', [CalendarYearController::class, 'edit'])->name('admin.calendar.edit');
    Route::post('calendar/{id}/update', [CalendarYearController::class, 'update'])->name('admin.calendar.update');
    Route::delete('calendar/{id}', [CalendarYearController::class, 'destroy'])->name('admin.calendar.destroy');

    // AJAX endpoint
    Route::get('calendar/get-events', [CalendarYearController::class, 'getEventsByDate'])
        ->name('admin.calendar.getEvents');

    // FullCalendar JSON feed route
    Route::get('calendar/events-json', function () {
        return \App\Models\CalendarYear::select(
            'id',
            'title',
            'event_date as start'
        )->get();
    })->name('admin.calendar.getEvents.json');
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
