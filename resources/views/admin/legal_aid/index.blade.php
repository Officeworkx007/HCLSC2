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
                        <th class="px-4 py-3 border-b">Father Name</th>
                        <th class="px-4 py-3 border-b">Mother Name</th>
                        <th class="px-4 py-3 border-b">Spouse Name</th>
                        <th class="px-4 py-3 border-b">Gender</th>
                        <th class="px-4 py-3 border-b">Phone</th>
                        <th class="px-4 py-3 border-b">Email</th>
                        <th class="px-4 py-3 border-b">Religion</th>
                        <th class="px-4 py-3 border-b">Caste</th>
                        <th class="px-4 py-3 border-b">Certificate No</th>
                        <th class="px-4 py-3 border-b">Occupation</th>
                        <th class="px-4 py-3 border-b">Employment</th>
                        <th class="px-4 py-3 border-b">Annual Income</th>
                        <th class="px-4 py-3 border-b">Eligibility</th>
                        <th class="px-4 py-3 border-b">Documents</th>
                        <th class="px-4 py-3 border-b">Created At</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
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
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $applicant->name }}</td>
                            <td class="px-4 py-3">{{ $applicant->father_name }}</td>
                            <td class="px-4 py-3">{{ $applicant->mother_name }}</td>
                            <td class="px-4 py-3">{{ $applicant->spouse_name }}</td>
                            <td class="px-4 py-3">{{ $applicant->gender?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $applicant->number }}</td>
                            <td class="px-4 py-3">{{ $applicant->email }}</td>
                            <td class="px-4 py-3">{{ $applicant->religion?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $applicant->caste?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $applicant->certificate_no }}</td>
                            <td class="px-4 py-3">{{ $applicant->occupation?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $applicant->employment_details }}</td>
                            <td class="px-4 py-3">{{ $applicant->income?->range ?? 'N/A' }}</td>
                            <td class="px-4 py-3">{{ $applicant->eligibilityCategory?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3">
                                @if($applicant->documents->count())
                                    <ul class="list-disc list-inside text-blue-600">
                                        @foreach($applicant->documents as $doc)
                                            <li>
                                                {{ $doc->uploadDocument?->name ?? 'Document' }}
                                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                                   class="underline hover:text-blue-800">View</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-400 italic">No docs</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $applicant->created_at->format('d-m-Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="18" class="px-4 py-6 text-center text-gray-500">No applications found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
