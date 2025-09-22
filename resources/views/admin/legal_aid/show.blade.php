{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

{{-- AdminLTE CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

{{-- Your Laravel compiled assets --}}
@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')

<div class="bg-white shadow-md rounded-lg p-4 mx-auto max-w-6xl">
    <h2 class="text-2xl font-bold mb-4">Applicant Details</h2>

        <table class="table-auto w-full border border-gray-200 text-sm text-left text-gray-700">
            <tbody class="divide-y divide-gray-100">
                <tr>
                    <th class="px-3 py-2 border-b">Photo</th>
                    <td class="px-3 py-2 border-b">
                        @if($applicant->photo)
                        <img src="{{ asset('storage/' . $applicant->photo) }}" alt="photo"
                            class="w-24 h-24 rounded-full object-cover">
                        @else
                        <span class="text-gray-400 italic">N/A</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Applicant Name</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->name }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Father Name</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->father_name }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Mother Name</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->mother_name }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Spouse Name</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->spouse_name }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Gender</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->gender?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Phone</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->number }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Email</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->email }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Religion</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->religion?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Caste</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->caste?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Certificate No</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->certificate_no }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Occupation</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->occupation?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Employment Details</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->employment_details }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Annual Income</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->income?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Eligibility</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->eligibilityCategory?->name ?? 'N/A' }}</td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Documents</th>
                    <td class="px-3 py-2 border-b">
                        @if($applicant->documents->count())
                        <ul class="space-y-1">
                            @foreach($applicant->documents as $doc)
                            <li class="flex items-center gap-2 bg-gray-50 border border-gray-200 rounded-md px-2 py-1">
                                <span class="text-gray-800 font-medium text-sm">{{ $doc->uploadDocument?->name ?? 'Document' }}</span>
                                <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                    class="text-blue-600 hover:text-blue-800 underline text-sm">View</a>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <span class="text-gray-400 italic text-sm">No docs</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="px-3 py-2 border-b">Created At</th>
                    <td class="px-3 py-2 border-b">{{ $applicant->created_at->format('d-m-Y') }}</td>
                </tr>
            </tbody>
        </table>

        <div class="mt-4">
            <a href="{{ route('admin.legal_aid.index') }}"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">Back to List</a>
        </div>
    </div>