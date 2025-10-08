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
                            <option value="">-- None / Pending --</option> <!-- This is the key -->
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

                <form action="{{ route('admin.legal_aid.rejectApplicant', $applicant->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to reject this applicant? This action can be reversed by admin later.')">
                    @csrf

                    <div class="space-y-3">
                        <label for="remark" class="block text-sm font-medium text-gray-700">Remark</label>
                        <textarea name="remark" id="remark" rows="3" required
                            class="w-full rounded-lg border-gray-300 focus:ring-red-500 focus:border-red-500 text-sm"></textarea>
                    </div>

                    <button type="submit"
                        class="mt-4 w-full px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg shadow hover:bg-red-700 transition">
                        <i class="bi bi-x-lg"></i> Reject
                    </button>
                </form>
            </div>

            <!-- Revert Case Button -->
            <form action="{{ route('admin.legal_aid.revertApplicant', $applicant->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to revert this applicant status?')">
                @csrf
                <button type="submit"
                    class="mt-3 w-full px-4 py-2 bg-yellow-500 text-white text-sm font-medium rounded-lg shadow hover:bg-yellow-600 transition">
                    <i class="bi bi-arrow-counterclockwise"></i> Revert Case
                </button>
            </form>

            <!-- Previously Uploaded Orders & Documents (compact, fits inside the card) -->
            @if ($applicant->caseDocs->count() > 0)
                <div class="mb-6">
                    <h4 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                        <i class="bi bi-archive text-indigo-600"></i>
                        Uploaded Orders
                    </h4>

                    <!-- fixed-height scroll area so long lists don't stretch the card -->
                    <div class="max-h-56 overflow-y-auto space-y-3 pr-1">
                        @foreach ($applicant->caseDocs as $doc)
                            <div
                                class="flex items-start justify-between bg-gray-50 p-3 rounded-lg border border-gray-100">
                                <!-- left: icon + details (use min-w-0 so truncation works) -->
                                <div class="flex items-start gap-3 min-w-0">
                                    @php
                                        $ext = pathinfo($doc->original_name, PATHINFO_EXTENSION);
                                        $icon = 'bi-file-earmark';
                                        if (in_array(strtolower($ext), ['pdf'])) {
                                            $icon = 'bi-file-earmark-pdf text-red-500';
                                        } elseif (in_array(strtolower($ext), ['doc', 'docx'])) {
                                            $icon = 'bi-file-earmark-word text-blue-500';
                                        } elseif (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
                                            $icon = 'bi-file-earmark-image text-green-500';
                                        }
                                    @endphp

                                    <i class="bi {{ $icon }} text-2xl flex-shrink-0 mt-0.5"></i>

                                    <div class="min-w-0">
                                        <p class="text-xs text-gray-500">Order No</p>
                                        <p class="text-sm font-medium text-gray-700 break-words">{{ $doc->order_no }}
                                        </p>

                                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                                            class="text-indigo-600 hover:text-indigo-800 text-sm truncate block mt-1"
                                            title="{{ $doc->original_name }}">
                                            <i class="bi bi-box-arrow-up-right mr-1"></i>
                                            {{ $doc->original_name }}
                                        </a>
                                    </div>
                                </div>

                                <!-- right: small meta (date + id) -->
                                <div class="text-right flex-shrink-0 ml-3">
                                    <p class="text-xs text-gray-400">{{ $doc->created_at->format('d M, Y') }}</p>
                                    <p class="text-xs text-gray-400">#{{ $doc->id }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Order & Documents Form -->
            <div class="mt-5">
                <h3 class="text-lg font-bold text-black mb-4 flex items-center gap-2">
                    <i class="bi bi-folder2-open text-indigo-600"></i> Upload New Order & Documents
                </h3>
                <form action="{{ route('admin.legal_aid.storeOrderDocs', $applicant->id) }}" method="POST"
                    enctype="multipart/form-data">
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
