@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Dashboard')

@section('content')
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">

        <!-- Total Notices -->
        <div
            class="bg-gradient-to-br from-orange-50 to-orange-100 border border-orange-200 rounded-2xl shadow-md p-6 flex items-center justify-between hover:scale-[1.02] transition">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Notices</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalNotices }}</p>
            </div>
            <div class="bg-orange-200 text-orange-700 p-4 rounded-full">
                <i class="fa-solid fa-bullhorn text-2xl"></i>
            </div>
        </div>

        <!-- Total No. of Panel Lawyers -->
        <div
            class="bg-gradient-to-br from-green-50 to-emerald-100 border border-emerald-200 rounded-2xl shadow-md p-6 flex items-center justify-between hover:scale-[1.02] transition">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Panel Lawyers</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalPanelLawyers }}</p>
            </div>
            <div class="bg-emerald-200 text-emerald-700 p-4 rounded-full">
                <i class="fa-solid fa-scale-balanced text-2xl"></i>
            </div>
        </div>

        <!-- Total Legal Aid Applications (Received) -->
        <div
            class="bg-gradient-to-br from-blue-50 to-blue-100 border border-blue-200 rounded-2xl shadow-md p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Total Applications</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $totalApplications }}</p>
            </div>
            <div class="bg-blue-200 text-blue-700 p-4 rounded-full">
                <i class="fa-solid fa-file-lines text-2xl"></i>
            </div>
        </div>

        <!-- Total No. of Applications Assigned Lawyers -->
        <div
            class="bg-gradient-to-br from-purple-50 to-purple-100 border border-purple-200 rounded-2xl shadow-md p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Assigned Lawyers</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $assignedApplications }}</p>
            </div>
            <div class="bg-purple-200 text-purple-700 p-4 rounded-full">
                <i class="fa-solid fa-user-tie text-2xl"></i>
            </div>
        </div>

        <!-- Total No. of Applications Pending -->
        <div
            class="bg-gradient-to-br from-yellow-50 to-yellow-100 border border-yellow-200 rounded-2xl shadow-md p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Pending Applications</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $pendingApplications }}</p>
            </div>
            <div class="bg-yellow-200 text-yellow-700 p-4 rounded-full">
                <i class="fa-solid fa-hourglass-half text-2xl"></i>
            </div>
        </div>

        <!-- Total No. of Applications Rejected -->
        <div
            class="bg-gradient-to-br from-rose-50 to-rose-100 border border-rose-200 rounded-2xl shadow-md p-6 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide">Rejected Applications</h3>
                <p class="text-3xl font-bold text-gray-800 mt-2">{{ $rejectedApplications }}</p>
            </div>
            <div class="bg-rose-200 text-rose-700 p-4 rounded-full">
                <i class="fa-solid fa-xmark-circle text-2xl"></i>
            </div>
        </div>

    </div>

@endsection
