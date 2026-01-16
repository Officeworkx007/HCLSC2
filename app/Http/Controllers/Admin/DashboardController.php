<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\PanelLawyer;
use App\Models\Notice;
use App\Models\CalendarYear;
use App\Models\GalleryAlbum;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ===== Existing counts =====
        $totalApplications    = Applicant::count();
        $assignedApplications = Applicant::where('status', 'Assigned')->count();
        $pendingApplications  = Applicant::where('status', 'Pending')->count();
        $rejectedApplications = Applicant::where('status', 'Rejected')->count();

        $totalPanelLawyers = PanelLawyer::count();
        $totalNotices      = Notice::count();

        // ===== New: Recent Activity =====
        $recentApplications = Applicant::latest()->take(5)->get();
        $latestNotices      = Notice::latest()->take(3)->get();

        // ===== New: Calendar (Today & Upcoming) =====
        $todayEvents = CalendarYear::whereDate('event_date', Carbon::today())->get();

        $upcomingEvents = CalendarYear::whereDate('event_date', '>', Carbon::today())
            ->orderBy('event_date')
            ->take(5)
            ->get();

        // ===== New: Gallery Preview =====
        $recentAlbums = GalleryAlbum::with(['photos' => function ($q) {
                $q->where('is_cover', true);
            }])
            ->latest('event_date')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'totalApplications',
            'assignedApplications',
            'pendingApplications',
            'rejectedApplications',
            'totalPanelLawyers',
            'totalNotices',
            'recentApplications',
            'latestNotices',
            'todayEvents',
            'upcomingEvents',
            'recentAlbums'
        ));
    }
}
