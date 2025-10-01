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

    <!-- Main content split: right applicant info / right assignment and others -->
    <div class="flex gap-6">

        <!-- Left side - Applicant Details -->
        <div class="flex-1">

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
                                            <li
                                                class="flex items-center justify-between bg-gray-50 border rounded-md px-3 py-2">
                                                <span
                                                    class="text-gray-800 font-medium text-sm">{{ $doc->uploadDocument?->name ?? 'Document' }}</span>
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
        </div>

        <!-- Right Side - Actions-->
        <div class="w-80 bg-white shadow-lg rounded-xl p-6 border border-gray-100">

            <!-- Assign Lawyer -->
            <div>
                <h3 class="text-lg font-bold text-black mb-4 flex items-center gap-2">
                    <i class="bi bi-person-workspace text-indigo-600"></i> Assign Lawyer
                </h3>

                <form action="{{ route('admin.legal_aid.assignLawyer', $applicant->id) }}" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <label for="panel_lawyer_id" class="block text-sm font-medium text-gray-700">Select
                            Lawyer</label>
                        <select name="panel_lawyer_id" id="panel_lawyer_id"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                            <option value="">-- Choose Lawyer --</option>
                            @foreach ($panelLawyers as $lawyer)
                                <option value="{{ $lawyer->id }}"
                                    {{ $applicant->panel_lawyer_id == $lawyer->id ? 'selected' : '' }}>
                                    {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                        <i class="bi bi-check2-circle"></i> Assign
                    </button>
                </form>
            </div>

            <!-- Reject Case -->
            <div class="mt-5">
                <h3 class="text-lg font-bold text-black mb-4 flex items-center gap-2">
                    <i class="bi bi-x-circle text-red-600"></i> Reject Case
                </h3>

                <form action="#" method="POST">
                    @csrf
                    <div class="space-y-3">
                        <label for="remark" class="block text-sm font-medium text-gray-700">Remark</label>
                        <textarea name="remark" id="remark" rows="3"
                            class="w-full rounded-lg border-gray-300 focus:ring-red-500 focus:border-red-500 text-sm"></textarea>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition">
                        <i class="bi bi-x-lg"></i>Reject
                    </button>
                </form>
            </div>

            <!-- Order & Documents -->
            <div class="mt-5">
                <h3 class="text-lg font-bold text-black mb-4 flex items-center gap-2">
                    <i class="bi bi-folder2-open text-indigo-600"></i> Order & Documents
                </h3>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-3">
                        <label for="order_no" class="block text-sm font-medium text-gray-700">Order No</label>
                        <input type="text" name="order_no" id="order_no"
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">

                        <label for="docs" class="block text-sm font-medium text-gray-700">Upload Documents</label>
                        <input type="file" name="docs[]" id="docs" multiple
                            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 text-sm">
                    </div>

                    <button type="submit"
                        class="mt-4 w-full px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow hover:bg-indigo-700 transition">
                        <i class="bi bi-upload"></i> Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
