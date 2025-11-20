@extends('admin.layouts.master')

@section('title', 'Mediation Cause Lists')

@section('page-title', 'Mediation Cause Lists')

{{-- 1. DATA TABLES CSS LINKS --}}
@section('styles')
    {{-- Replace with your actual asset path for DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    {{-- Optionally include Tailwind-friendly DataTables extension if available --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')

    <div class="px-4 sm:px-6 lg:px-8 py-10 bg-white min-h-[80vh]">
        <div class="mx-auto bg-white rounded-2xl shadow-lg p-4 sm:p-8 xl:p-10 max-w-[95vw] xl:max-w-[90rem]">

            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">All Mediation Cause Lists</h2>
                <a href="{{ route('admin.mediations.create') }}"
                    class="px-4 py-2 bg-[#09d8f3] !text-white font-semibold rounded-lg border border-black
            shadow-md hover:bg-[#00F5D4] hover:!text-white hover:shadow-[0_0_15px_#00F5D4]
            focus:ring-2 focus:ring-[#00F5D4] focus:ring-offset-2
            transition-all duration-300 ease-in-out">
                    + Upload New
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            {{-- 2. DATE FILTER CONTROLS --}}
            <div class="mb-4 p-4 border rounded-lg bg-gray-50 flex flex-wrap gap-4 items-center">
                <div class="flex flex-col">
                    <label for="min-date" class="text-sm font-medium text-gray-700 mb-1">From Date (Held On)</label>
                    <input type="date" id="min-date" name="min_date"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:ring-[#09d8f3] focus:border-[#09d8f3]">
                </div>
                <div class="flex flex-col">
                    <label for="max-date" class="text-sm font-medium text-gray-700 mb-1">To Date (Held On)</label>
                    <input type="date" id="max-date" name="max_date"
                        class="px-3 py-2 border border-gray-300 rounded-md focus:ring-[#09d8f3] focus:border-[#09d8f3]">
                </div>
                <div class="pt-6">
                    <button id="clear-filter"
                        class="px-4 py-2 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition">
                        Clear Filter
                    </button>
                </div>
            </div>

            <div class="overflow-x-auto w-full">
                {{-- Assign an ID to the table for DataTables initialization --}}
                <table id="causeListsTable" class="w-full divide-y divide-gray-200 display nowrap">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Date</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">To Be Held On</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Bar Enrolment No</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">PDF File</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Uploaded By</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Upload Time</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($causeLists as $list)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                {{-- Cause List Order Date (Not used for filter, but can be if needed) --}}
                                <td class="px-4 py-3 text-sm text-gray-700" data-order="{{ $list->cause_list_date }}">
                                    {{ $list->cause_list_date ? \Carbon\Carbon::parse($list->cause_list_date)->format('d M Y') : '-' }}
                                </td>

                                {{-- To be Held on Date (Used for date filtering) --}}
                                <td class="px-4 py-3 text-sm text-gray-700" data-order="{{ $list->to_be_held_on }}">
                                    {{ $list->to_be_held_on ? \Carbon\Carbon::parse($list->to_be_held_on)->format('d M Y') : '-' }}
                                </td>

                                {{-- Description --}}
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $list->description ?? '-' }}</td>

                                {{-- Bar Enrolment No --}}
                                <td class="px-4 py-3 text-sm text-gray-700">{{ $list->enrolment_no ?? '-' }}</td>

                                {{-- PDF --}}
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    @if ($list->file_path)
                                        <div class="flex flex-col gap-2">
                                            @php
                                                $pdfUrl = asset('storage/' . $list->file_path);
                                                $fileName = basename($list->file_path);
                                            @endphp

                                            {{-- 1. View Button (Opens in new tab) --}}
                                            <a href="{{ $pdfUrl }}" target="_blank"
                                                class="flex items-center gap-2 text-blue-600 hover:underline transition">
                                                {{-- Using the existing PDF icon (Ensure you have a complete SVG path or use a library) --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500"
                                                    viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                        d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6H6zM13 3.5L18.5 9H14a1 1 0 0 1-1-1V3.5z" />
                                                </svg>
                                                <span class="truncate max-w-[150px]">View File</span>
                                            </a>

                                            {{-- 2. Download Button (Explicitly downloads the file) --}}
                                            <a href="{{ $pdfUrl }}" download="{{ $fileName }}"
                                                class="text-xs font-medium text-gray-500 hover:text-gray-700 transition flex items-center gap-1">
                                                <i class="fas fa-download h-3 w-3"></i> Download
                                            </a>

                                        </div>
                                    @else
                                        <span class="text-gray-400 italic">No file</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-4 py-3 text-sm">
                                    @php
                                        // The status logic is fine, but for DataTables it helps to have the raw status in a data attribute
                                        $heldDate = \Carbon\Carbon::parse($list->to_be_held_on);
                                        $now = now();
                                        $status = 'completed';
                                        $badgeColor = 'bg-green-100 text-green-800';

                                        if ($now->lt($heldDate->copy()->setTime(11, 0, 0))) {
                                            $status = 'upcoming';
                                            $badgeColor = 'bg-yellow-100 text-yellow-800';
                                        } elseif (
                                            $now->between(
                                                $heldDate->copy()->setTime(11, 0, 0),
                                                $heldDate->copy()->setTime(18, 0, 0),
                                            )
                                        ) {
                                            $status = 'ongoing';
                                            $badgeColor = 'bg-blue-100 text-blue-800';
                                        }
                                    @endphp

                                    <span data-status="{{ $status }}"
                                        class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $badgeColor }}">
                                        {{ ucfirst($status) }}
                                    </span>
                                </td>


                                {{-- Uploaded By --}}
                                <td class="px-4 py-3 text-sm text-gray-700">
                                    {{ $list->uploader->name ?? 'Admin' }}
                                </td>

                                {{-- Upload Time --}}
                                <td class="px-4 py-3 text-sm text-gray-700" data-order="{{ $list->created_at->timestamp }}">
                                    {{ $list->created_at->format('d M Y, h:i A') }}
                                </td>

                                {{-- Actions --}}
                                <td class="px-4 py-3 text-sm flex gap-2">
                                    <a href="{{ route('admin.mediations.edit', $list->id) }}"
                                        class="flex items-center gap-1 px-3 py-1.5 text-sm bg-white border border-[#4B006E] hover:bg-white text-black rounded-md transition">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>

                                    <form action="{{ route('admin.mediations.destroy', $list->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this cause list?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="flex items-center gap-1 px-3 py-1.5 text-sm bg-[#4B006E] hover:bg-[#7205a5] text-white rounded-md transition">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            {{-- DataTables handles the "No matching records found" message during search/filter.
                                We keep the @empty block for when the list is initially empty. --}}
                            <tr class="datatable-empty-row">
                                <td colspan="9" class="px-4 py-6 text-center text-gray-400 italic">
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

{{-- 3. DATA TABLES SCRIPTS --}}
@section('scripts')
    {{-- Include jQuery (required for DataTables) and DataTables scripts --}}
    {{-- Replace with your actual asset path for DataTables JS --}}
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    {{-- Include Moment.js for date handling/parsing --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    {{-- Font Awesome (assuming you use this for the icons like fa-download, fa-edit, fa-trash) --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js" integrity="sha512-..."></script>


    <script>
        $(document).ready(function() {
            // Check if there are actual rows or just the empty row placeholder
            var isTableEmpty = $('#causeListsTable tbody tr').length === 1 && $('#causeListsTable tbody tr').hasClass('datatable-empty-row');
            
            // --- Custom Date Range Filtering for DataTables ---
            
            // Extend DataTables with a custom filter function
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    var minDate = $('#min-date').val();
                    var maxDate = $('#max-date').val();
                    
                    // Column index 1 is "To Be Held On"
                    var heldOnDate = data[1]; 
                    
                    // Convert to moment objects for comparison. DataTables data is raw cell content
                    var heldMoment = moment(heldOnDate, 'DD MMM YYYY');

                    var min = minDate ? moment(minDate) : null;
                    var max = maxDate ? moment(maxDate) : null;

                    // If both are empty, show all rows
                    if (!min && !max) {
                        return true;
                    }
                    
                    // If the date is invalid/missing, it should not be included if a filter is set
                    if (!heldMoment.isValid()) {
                        return false; 
                    }

                    // Check if the date falls within the range (inclusive)
                    if (min && max) {
                        return heldMoment.isBetween(min, max, 'day', '[]');
                    } else if (min) {
                        return heldMoment.isSameOrAfter(min, 'day');
                    } else if (max) {
                        return heldMoment.isSameOrBefore(max, 'day');
                    }

                    return false;
                }
            );

            // --- Initialize DataTables ---

            var table = $('#causeListsTable').DataTable({
                // Ensure table is destroyable/reinitializable if needed, but standard init is fine.
                responsive: true,
                order: [
                    [1, 'desc']
                ], // Default sort by 'To Be Held On' date descending
                language: {
                    emptyTable: "No mediation cause lists found.",
                    zeroRecords: "No matching records found."
                },
                // Configuration to display table normally even if initially empty
                deferRender: true,
                info: true, // Show "Showing X of Y entries"
                // Disable ordering on the last column (Actions)
                columnDefs: [
                    { 
                        targets: [4, 8], // PDF File and Actions columns
                        orderable: false,
                        searchable: false
                    }
                ],
                // Hide the DataTables controls if the table is truly empty initially
                // Note: The visibility of controls (like search and pagination) is handled by DataTables itself 
                // when it processes the empty result. However, we ensure it's functional even if empty.
            });
            
            // If the table was empty, remove the single placeholder row to let DataTables manage the display
            if(isTableEmpty) {
                 $('#causeListsTable tbody tr').remove();
            }


            // --- Date Filter Event Handlers ---

            // Redraw the table when the date inputs change
            $('#min-date, #max-date').on('change', function() {
                table.draw();
            });

            // Clear the filters and redraw the table
            $('#clear-filter').on('click', function() {
                $('#min-date').val('');
                $('#max-date').val('');
                table.draw();
            });
        });
    </script>
@endsection