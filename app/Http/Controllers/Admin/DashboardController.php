<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\PanelLawyer;
use App\Models\Notice;

class DashboardController extends Controller
{

    public function index()
    {
        // Total number of applications received
        $totalApplications = Applicant::count();

        // Applications assigned to lawyers
        $assignedApplications = Applicant::where('status', 'Assigned')->count();

        // Applications pending (no lawyer assigned yet)
        $pendingApplications = Applicant::where('status', 'Pending')->count();

        // Applications rejected
        $rejectedApplications = Applicant::where('status', 'Rejected')->count();

        // Panel lawyers
        $totalPanelLawyers = PanelLawyer::count();

        // Notices
        $totalNotices = Notice::count();

        // Pass data to view
        return view('admin.dashboard', compact(
            'totalApplications',
            'assignedApplications',
            'pendingApplications',
            'rejectedApplications',
            'totalPanelLawyers',
            'totalNotices'
        ));
    }
}
