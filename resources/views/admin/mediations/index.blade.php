@extends('admin.layouts.master')

@section('title', 'Mediation Cause Lists')

@section('page-title', 'Mediation Cause Lists')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-10 bg-gray-50 min-h-[80vh]">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg p-6 sm:p-10">

        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">All Mediation Cause Lists</h2>
            <a href="{{ route('admin.mediations.create') }}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-lg shadow-md transition duration-200">
                + Upload New
            </a>
        </div>

        @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">PDF File</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Uploaded By</th>
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Upload Time</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($causeLists as $list)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        {{-- Date --}}
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $list->cause_list_date->format('d M Y') }}</td>

                        {{-- Description --}}
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $list->description ?? '-' }}</td>

                        {{-- PDF --}}
                        <td class="px-4 py-3 text-sm text-gray-700 flex items-center gap-2">
                            @if($list->file_path)
                            <a href="{{ asset('storage/' . $list->file_path) }}" target="_blank" class="flex items-center gap-2 hover:text-blue-600 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zM13 3.5L18.5 9H14a1 1 0 0 1-1-1V3.5z" />
                                </svg>
                                <span class="truncate max-w-[150px]">{{ basename($list->file_path) }}</span>
                            </a>
                            @else
                            <span class="text-gray-400 italic">No file</span>
                            @endif
                        </td>

                        {{-- Status --}}
                        <td class="px-4 py-3 text-sm">
                            @if($list->status === 'upcoming')
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Upcoming</span>
                            @else
                            <span class="inline-block px-3 py-1 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Completed</span>
                            @endif
                        </td>

                        {{-- Uploaded By --}}
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $list->uploader->name ?? 'Admin' }}
                        </td>

                        {{-- Upload Time --}}
                        <td class="px-4 py-3 text-sm text-gray-700">
                            {{ $list->created_at->format('d M Y, h:i A') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">
                            No mediation cause lists found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection