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

    {{-- APPLICATION STATUS OVERVIEW --}}
    <div class="bg-white rounded-xl shadow border border-gray-100 p-6 mt-8">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Application Status Overview</h3>

        @php
            $total = max($totalApplications, 1);
        @endphp

        <div class="space-y-4">
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-purple-700 font-medium">Assigned</span>
                    <span>{{ $assignedApplications }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full"
                        style="width: {{ ($assignedApplications / $total) * 100 }}%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-yellow-700 font-medium">Pending</span>
                    <span>{{ $pendingApplications }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ ($pendingApplications / $total) * 100 }}%">
                    </div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span class="text-rose-700 font-medium">Rejected</span>
                    <span>{{ $rejectedApplications }}</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-rose-500 h-2 rounded-full" style="width: {{ ($rejectedApplications / $total) * 100 }}%">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8">

        {{-- RECENT ACTIVITY --}}
        <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Activity</h3>

            <ul class="space-y-4">
                @foreach ($recentApplications as $app)
                    <li class="flex items-start gap-3">
                        <div class="bg-indigo-100 text-indigo-600 p-2 rounded-full">
                            <i class="fa-solid fa-file-lines"></i>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-800">
                                New application received
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ $app->created_at->diffForHumans() }}
                            </p>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- CALENDAR PREVIEW --}}
        <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Today & Upcoming Events</h3>

            @forelse ($todayEvents as $event)
                <div class="mb-3 p-3 bg-blue-50 rounded-lg">
                    <p class="text-sm font-semibold text-blue-700">
                        {{ $event->title }}
                    </p>
                    <p class="text-xs text-gray-600">Today</p>
                </div>
            @empty
                <p class="text-sm text-gray-500 mb-3">No events today.</p>
            @endforelse

            <hr class="my-3">

            <ul class="space-y-2">
                @foreach ($upcomingEvents as $event)
                    <li class="text-sm text-gray-700 flex justify-between">
                        <span>{{ $event->title }}</span>
                        <span class="text-xs text-gray-500">
                            {{ $event->event_date->format('d M') }}
                        </span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mt-8 mb-5">

        {{-- LATEST NOTICES --}}
        <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Latest Notices</h3>

            <ul class="space-y-3">
                @foreach ($latestNotices as $notice)
                    <li class="border-b pb-2 last:border-none">
                        <p class="text-sm font-medium text-gray-800">
                            {{ $notice->description }}
                        </p>
                        <p class="text-xs text-gray-500">
                            {{ $notice->created_at->format('d M Y') }}
                        </p>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- GALLERY PREVIEW --}}
        <div class="bg-white rounded-xl shadow border border-gray-100 p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Gallery</h3>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                @forelse ($recentAlbums as $album)
                    <div class="rounded-lg overflow-hidden border bg-gray-50">
                        @if ($album->photos->first())
                            <img src="{{ asset('storage/' . $album->photos->first()->file_path) }}"
                                alt="{{ $album->title }}" class="w-full h-24 object-cover hover:scale-105 transition">
                        @else
                            <div class="h-24 flex items-center justify-center text-gray-400 text-sm">
                                No Cover Image
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No albums found.</p>
                @endforelse
            </div>
        </div>
    </div>

@endsection
