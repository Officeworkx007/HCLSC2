@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Legal Aid Applications')

@section('content')
    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 py-6">
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
                        <th class="px-4 py-3 border-b">Status</th>
                        <th class="px-4 py-3 border-b">Remark</th>
                        <th class="px-4 py-3 border-b">Assigned Panel Lawyer</th>
                        <th class="px-4 py-3 border-b">View Details</th>
                        <th class="px-4 py-3 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($applicants as $index => $applicant)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3">{{ $index + 1 }}</td>
                            <td class="px-4 py-3">
                                @if ($applicant->photo)
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

                            {{-- Status Badge --}}
                            <td class="px-4 py-3">
                                @php
                                    $status = ucfirst($applicant->status);
                                    $badgeClasses = match ($status) {
                                        'Pending' => 'text-yellow-800 bg-yellow-100',
                                        'Rejected' => 'text-red-800 bg-red-100',
                                        'Assigned' => 'text-teal-800 bg-teal-100',
                                    };
                                @endphp

                                <span class="inline-block px-3 py-1 rounded-md font-semibold shadow-sm {{ $badgeClasses }}">
                                    {{ $status }}
                                </span>
                            </td>

                            {{-- Remark --}}
                            <td class="px-4 py-3 text-sm text-gray-600 italic">
                                @if ($applicant->rejection)
                                    {{ $applicant->rejection->remark }}
                                @else
                                    -
                                @endif
                            </td>

                            {{-- Assigned Panel Lawyer --}}
                            <td class="px-4 py-3">
                                @if ($applicant->panelLawyer)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded">
                                        {{ $applicant->panelLawyer->first_name }} {{ $applicant->panelLawyer->last_name }}
                                    </span>
                                @else
                                    <span class="italic text-gray-500 text-xs">Not assigned yet</span>
                                @endif
                            </td>

                            {{-- View Details Button --}}
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.legal_aid.show', $applicant->id) }}"
                                    class="inline-flex items-center px-3 py-1.5 bg-purple-500 text-white text-xs font-medium rounded-full shadow-sm
                                    hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-400 transition">
                                    Show
                                </a>
                            </td>

                            {{-- Quick Actions --}}
                            <td class="px-4 py-3 space-x-3">
                                <form action="" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this application?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white text-xs font-medium rounded-full shadow-sm
                                        hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400 transition">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-4 py-6 text-center text-gray-500">No applications found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
