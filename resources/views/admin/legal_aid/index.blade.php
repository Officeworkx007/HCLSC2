@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Legal Aid Applications')

@section('content')
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
    <h2 class="text-2xl font-bold mb-4">Applications List</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200">
            <thead class="bg-gray-50 text-xs uppercase font-semibold text-gray-600">
                <tr>
                    <th class="px-4 py-3 border-b">#</th>
                    <th class="px-4 py-3 border-b">Photo</th>
                    <th class="px-4 py-3 border-b">Applicant Name</th>
                    <th class="px-4 py-3 border-b">Phone</th>
                    <th class="px-4 py-3 border-b">Email</th>
                    <th class="px-4 py-3 border-b">Created At</th>
                    <th class="px-4 py-3 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applicants as $index => $applicant)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3">{{ $index + 1 }}</td>
                    <td class="px-4 py-3">
                        @if($applicant->photo)
                        <img src="{{ asset('storage/' . $applicant->photo) }}" alt="photo"
                            class="w-12 h-12 rounded-full object-cover">
                        @else
                        <span class="text-gray-400 italic">N/A</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 font-medium">{{ $applicant->name }}</td>
                    <td class="px-4 py-3">{{ $applicant->number }}</td>
                    <td class="px-4 py-3">{{ $applicant->email }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $applicant->created_at->format('d-m-Y') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('admin.legal_aid.show', $applicant->id) }}"
                            class="inline-flex items-center px-3 py-1.5 bg-blue-500 text-white text-xs font-medium rounded-full shadow-sm 
          hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 transition">
                            Show Details
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-500">No applications found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection