\{{-- Font Awesome --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
{{-- AdminLTE CSS --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@stack('styles')

<div class="bg-white shadow-lg rounded-xl p-6 mx-auto max-w-6xl border border-gray-100">

    <!-- Header -->
    <div class="flex items-center justify-between border-b pb-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
            <i class="bi bi-person-badge text-indigo-600"></i> Applicant Details
        </h2>
        <a href="{{ route('admin.legal_aid.index') }}"
            class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    {{-- Applicant Info --}}
    <div class="overflow-hidden border rounded-lg mb-8">
        <table class="table-auto w-full text-sm text-left text-gray-700">
            <tbody class="divide-y divide-gray-100">
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3 font-medium text-gray-600 w-40">Photo</th>
                    <td class="px-4 py-3">
                        @if ($applicant->photo)
                            <img src="{{ asset('storage/' . $applicant->photo) }}" alt="photo"
                                class="w-24 h-24 rounded-full object-cover border shadow-sm">
                        @else
                            <span class="text-gray-400 italic">N/A</span>
                        @endif
                    </td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Applicant Name</th>
                    <td class="px-4 py-3 font-semibold">{{ $applicant->name }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Father Name</th>
                    <td class="px-4 py-3">{{ $applicant->father_name }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Mother Name</th>
                    <td class="px-4 py-3">{{ $applicant->mother_name }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Spouse Name</th>
                    <td class="px-4 py-3">{{ $applicant->spouse_name }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Gender</th>
                    <td class="px-4 py-3">{{ $applicant->gender?->name ?? 'N/A' }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Phone</th>
                    <td class="px-4 py-3">{{ $applicant->number }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Email</th>
                    <td class="px-4 py-3">{{ $applicant->email }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Religion</th>
                    <td class="px-4 py-3">{{ $applicant->religion?->name ?? 'N/A' }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Caste</th>
                    <td class="px-4 py-3">{{ $applicant->caste?->name ?? 'N/A' }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Certificate No</th>
                    <td class="px-4 py-3">{{ $applicant->certificate_no }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Occupation</th>
                    <td class="px-4 py-3">{{ $applicant->occupation?->name ?? 'N/A' }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Employment Details</th>
                    <td class="px-4 py-3">{{ $applicant->employment_details }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Annual Income</th>
                    <td class="px-4 py-3">{{ $applicant->income?->name ?? 'N/A' }}</td>
                </tr>
                <tr class="hover:bg-gray-50">
                    <th class="px-4 py-3">Eligibility</th>
                    <td class="px-4 py-3">{{ $applicant->eligibilityCategory?->name ?? 'N/A' }}</td>
                </tr>
                <tr class="hover:bg-gray-50 align-top">
                    <th class="px-4 py-3">Documents</th>
                    <td class="px-4 py-3">
                        @if ($applicant->documents->count())
                            <ul class="space-y-2">
                                @foreach ($applicant->documents as $doc)
                                    <li class="flex items-center justify-between bg-gray-50 border rounded-md px-3 py-2">
                                        <span class="text-gray-800 font-medium text-sm">{{ $doc->uploadDocument?->name ?? 'Document' }}</span>
                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm flex items-center gap-1">
                                            <i class="bi bi-box-arrow-up-right"></i> View
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-400 italic text-sm">No docs</span>
                        @endif
                    </td>
                </tr>
                <tr>
                    <th class="px-4 py-3">Created At</th>
                    <td class="px-4 py-3">{{ $applicant->created_at->format('d-m-Y') }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Assign Lawyer --}}
    <div class="bg-gradient-to-br from-indigo-50 to-white border rounded-lg p-5 shadow-sm mb-6">
        <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-indigo-700">
            <i class="bi bi-person-workspace"></i> Assign Lawyer
        </h3>
        @if ($applicant->lawyer)
            <p class="mb-3 text-sm text-gray-700">Currently Assigned:
                <strong>{{ $applicant->lawyer->first_name }} {{ $applicant->lawyer->last_name }}</strong>
            </p>
        @endif
        <form action="{{ route('admin.legal_aid.assignLawyer', $applicant->id) }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <select name="lawyer_id" class="border rounded-lg px-3 py-2 w-full sm:w-auto focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">Select Lawyer</option>
                @foreach ($panelLawyers as $lawyer)
                    <option value="{{ $lawyer->id }}" @if ($applicant->lawyer_id == $lawyer->id) selected @endif>
                        {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                    </option>
                @endforeach
            </select>
            <button type="submit"
                class="px-5 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                <i class="bi bi-check-circle"></i> Assign
            </button>
        </form>
    </div>

    {{-- Upload Order --}}
    <div class="bg-gradient-to-br from-green-50 to-white border rounded-lg p-5 shadow-sm mb-6">
        <h3 class="text-lg font-semibold mb-3 flex items-center gap-2 text-green-700">
            <i class="bi bi-file-earmark-arrow-up"></i> Upload Order Document
        </h3>
        @if ($applicant->order_file)
            <p class="mb-3 text-sm">Uploaded Order:
                <a href="{{ asset('storage/' . $applicant->order_file) }}" target="_blank"
                    class="text-green-700 font-medium underline hover:text-green-900">View Document</a>
            </p>
        @endif
        <form action="{{ route('admin.legal_aid.uploadOrder', $applicant->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <input type="file" name="order_file"
                class="border rounded-lg px-3 py-2 focus:ring-green-500 focus:border-green-500" required>
            <button type="submit"
                class="px-5 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                <i class="bi bi-upload"></i> Upload
            </button>
        </form>
    </div>

    {{-- Ready / Reject --}}
    <div class="bg-gradient-to-br from-gray-50 to-white border rounded-lg p-5 shadow-sm flex flex-wrap gap-3">
        <h3 class="text-lg font-semibold w-full mb-2 flex items-center gap-2 text-gray-700">
            <i class="bi bi-clipboard-check"></i> Application Status
        </h3>
        @if ($applicant->order_file)
            <form action="{{ route('admin.legal_aid.markReady', $applicant->id) }}" method="POST">
                @csrf
                <button type="submit"
                    class="px-5 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    <i class="bi bi-check2-circle"></i> Mark Ready
                </button>
            </form>
        @endif
        <form action="{{ route('admin.legal_aid.reject', $applicant->id) }}" method="POST">
            @csrf
            <button type="submit"
                class="px-5 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                <i class="bi bi-x-circle"></i> Reject
            </button>
        </form>
    </div>
</div>
