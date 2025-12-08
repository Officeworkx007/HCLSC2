@extends('admin.layouts.master')

@section('title', 'Mediation Cause Lists')
@section('page-title', 'Mediation Cause Lists')

@section('styles')
    {{-- No DataTables CSS here — loaded globally from master --}}
@endsection

@section('content')

<div class="px-4 sm:px-6 lg:px-8 py-10 bg-white min-h-[80vh]">
    <div class="mx-auto bg-white rounded-2xl shadow-lg p-4 sm:p-8 xl:p-10 max-w-[95vw] xl:max-w-[90rem]">

        {{-- Page Header --}}
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">All Mediation Cause Lists</h2>
            <a href="{{ route('admin.mediations.create') }}"
                class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 transition transform hover:scale-[1.01]">
                + Upload New
            </a>
        </div>

        {{-- SUCCESS POPUP --}}
        @if (session('success'))
            <div id="success-popup"
                class="relative mx-auto w-fit mb-6 z-50 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-3
                       opacity-0 translate-y-[-20px] transition duration-500 ease-in-out">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.707a1 1 0 00-1.414-1.414L9 10.586
                        7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const popup = document.getElementById('success-popup');

                    setTimeout(() => {
                        popup.style.opacity = '1';
                        popup.style.transform = 'translateY(0)';
                    }, 100);

                    setTimeout(() => {
                        popup.style.opacity = '0';
                        popup.style.transform = 'translateY(-20px)';
                    }, 5500);

                    setTimeout(() => popup.remove(), 6000);
                });
            </script>
        @endif

        {{-- DATE FILTER --}}
        <div class="mb-4 p-4 border rounded-lg bg-gray-50 flex flex-wrap gap-4 items-center">
            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700 mb-1">From Date (Held On)</label>
                <input type="date" id="min-date"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:ring-[#09d8f3] focus:border-[#09d8f3]">
            </div>

            <div class="flex flex-col">
                <label class="text-sm font-medium text-gray-700 mb-1">To Date (Held On)</label>
                <input type="date" id="max-date"
                    class="px-3 py-2 border border-gray-300 rounded-md focus:ring-[#09d8f3] focus:border-[#09d8f3]">
            </div>

            <div class="pt-6">
                <button id="clear-filter"
                    class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300">
                    Clear Filter
                </button>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="overflow-x-auto w-full table-wrapper">
            <table id="causeListsTable" class="display nowrap w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th>Date</th>
                        <th>To Be Held On</th>
                        <th>Description</th>
                        <th>PDF File</th>
                        <th>Status</th>
                        <th>Uploaded By</th>
                        <th>Upload Time</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($causeLists as $list)
                        <tr>
                            <td data-order="{{ $list->cause_list_date }}">
                                {{ $list->cause_list_date ? \Carbon\Carbon::parse($list->cause_list_date)->format('d M Y') : '-' }}
                            </td>

                            <td data-order="{{ $list->to_be_held_on }}">
                                {{ $list->to_be_held_on ? \Carbon\Carbon::parse($list->to_be_held_on)->format('d M Y') : '-' }}
                            </td>

                            <td>{{ $list->description ?? '-' }}</td>

                            <td>
                                @if ($list->file_path)
                                    @php
                                        $pdfUrl = asset('storage/' . $list->file_path);
                                        $fileName = basename($list->file_path);
                                    @endphp

                                    <a href="{{ $pdfUrl }}" target="_blank" class="text-blue-600 hover:underline">
                                        View File
                                    </a>
                                    <br>
                                    <a href="{{ $pdfUrl }}" download="{{ $fileName }}"
                                        class="text-xs text-gray-500 hover:text-gray-700">
                                        Download
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">No file</span>
                                @endif
                            </td>

                            {{-- STATUS --}}
                            <td>
                                @php
                                    $heldDate = \Carbon\Carbon::parse($list->to_be_held_on);
                                    $now = now();

                                    if ($now->lt($heldDate->copy()->setTime(11,0))) {
                                        $status = 'upcoming';
                                        $badge = 'bg-yellow-100 text-yellow-800';
                                    } elseif ($now->between(
                                        $heldDate->copy()->setTime(11,0),
                                        $heldDate->copy()->setTime(18,0)
                                    )) {
                                        $status = 'ongoing';
                                        $badge = 'bg-blue-100 text-blue-800';
                                    } else {
                                        $status = 'completed';
                                        $badge = 'bg-green-100 text-green-800';
                                    }
                                @endphp
                                <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $badge }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>

                            <td>{{ $list->uploader->name ?? 'Admin' }}</td>

                            <td data-order="{{ $list->created_at->timestamp }}">
                                {{ $list->created_at->format('d M Y, h:i A') }}
                            </td>

                            <td class="flex gap-2">
                                <a href="{{ route('admin.mediations.edit', $list->id) }}"
                                    class="px-3 py-1.5 text-sm bg-white border border-purple-700 rounded-md hover:bg-gray-100">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <form action="{{ route('admin.mediations.destroy', $list->id) }}" method="POST"
                                      onsubmit="return confirm('Delete this cause list?');">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1.5 text-sm bg-purple-700 text-white rounded-md hover:bg-purple-800">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection

@section('scripts')

<script>
$(document).ready(function() {

    // Date Filter
    $.fn.dataTable.ext.search.push(function(settings, data) {
        let min = $('#min-date').val() ? moment($('#min-date').val()) : null;
        let max = $('#max-date').val() ? moment($('#max-date').val()) : null;

        let heldOn = moment(data[1], "DD MMM YYYY");

        if (!min && !max) return true;
        if (!heldOn.isValid()) return false;
        if (min && max) return heldOn.isBetween(min, max, 'day', '[]');
        if (min) return heldOn.isSameOrAfter(min, 'day');
        if (max) return heldOn.isSameOrBefore(max, 'day');

        return true;
    });

    // DataTables Init (matching your gallery settings)
    let table = $('#causeListsTable').DataTable({
        responsive: true,
        deferRender: true,
        order: [[1, 'desc']],
        language: {
            search: "Search:",
            emptyTable: "No mediation cause lists found."
        },
        columnDefs: [
            { targets: [3, 7], orderable: false },
        ]
    });

    $('#min-date, #max-date').on('change', () => table.draw());
    $('#clear-filter').on('click', function() {
        $('#min-date').val('');
        $('#max-date').val('');
        table.draw();
    });
});
</script>

@endsection
