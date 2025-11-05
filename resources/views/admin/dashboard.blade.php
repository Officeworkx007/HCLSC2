@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mt-6">

    <div
        class="bg-white border border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-[1.02] p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-blue-600 uppercase tracking-wider">Total Notices</h3>
            {{-- Big, bold number is a modern dashboard trend --}}
            <p class="text-4xl font-extrabold text-gray-900 mt-2">{{ $totalNotices }}</p>
        </div>
        {{-- Icon with a subtle, NIC-style blue circle background --}}
        <div class="bg-blue-50 text-blue-600 p-4 rounded-full">
            <i class="fa-solid fa-bullhorn text-2xl"></i>
        </div>
    </div>

    <div
        class="bg-white border border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-[1.02] p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-emerald-600 uppercase tracking-wider">Panel Lawyers</h3>
            <p class="text-4xl font-extrabold text-gray-900 mt-2">{{ $totalPanelLawyers }}</p>
        </div>
        <div class="bg-emerald-50 text-emerald-600 p-4 rounded-full">
            <i class="fa-solid fa-scale-balanced text-2xl"></i>
        </div>
    </div>

    <div
        class="bg-white border border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-[1.02] p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Applications</h3>
            <p class="text-4xl font-extrabold text-gray-900 mt-2">{{ $totalApplications }}</p>
        </div>
        <div class="bg-indigo-50 text-indigo-600 p-4 rounded-full">
            <i class="fa-solid fa-file-lines text-2xl"></i>
        </div>
    </div>

    <div
        class="bg-white border border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-[1.02] p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-purple-600 uppercase tracking-wider">Assigned Applications</h3>
            <p class="text-4xl font-extrabold text-gray-900 mt-2">{{ $assignedApplications }}</p>
        </div>
        <div class="bg-purple-50 text-purple-600 p-4 rounded-full">
            <i class="fa-solid fa-user-tie text-2xl"></i>
        </div>
    </div>

    <div
        class="bg-white border border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-[1.02] p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-yellow-600 uppercase tracking-wider">Pending Applications</h3>
            <p class="text-4xl font-extrabold text-gray-900 mt-2">{{ $pendingApplications }}</p>
        </div>
        <div class="bg-yellow-50 text-yellow-600 p-4 rounded-full">
            <i class="fa-solid fa-hourglass-half text-2xl"></i>
        </div>
    </div>

    <div
        class="bg-white border border-gray-100 rounded-xl shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:scale-[1.02] p-6 flex items-center justify-between">
        <div>
            <h3 class="text-sm font-medium text-rose-600 uppercase tracking-wider">Rejected Applications</h3>
            <p class="text-4xl font-extrabold text-gray-900 mt-2">{{ $rejectedApplications }}</p>
        </div>
        <div class="bg-rose-50 text-rose-600 p-4 rounded-full">
            <i class="fa-solid fa-circle-xmark text-2xl"></i>
        </div>
    </div>

</div>
@endsection
