<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mediation Cause List</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <style>
        /* General styling for container and table appearance */
        .notice-container {
            max-width: 1400px;
            width: 95%;
            margin: auto;
        }

        #mediationTable {
            font-size: 1rem;
            width: 100% !important;
            border-collapse: collapse;
        }

        #mediationTable thead {
            background-color: #1E3A8A;
            color: white;
        }

        /* --- Updated padding and alignment --- */
        #mediationTable th {
            padding: 1rem 1.25rem !important;
            vertical-align: middle;
            text-align: left;
            display: table-cell;
        }

        #mediationTable td {
            padding: 0.9rem 1.25rem !important;
            vertical-align: middle;
            text-align: left;
        }

        /* Ensure Sl. No column is centered */
        #mediationTable tbody tr td:first-child {
            text-align: center;
        }

        /* --- End Updated padding and alignment --- */


        #mediationTable tbody tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        #mediationTable tbody tr:hover {
            background-color: #EEF2FF;
        }

        /* Status badges */
        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.8rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            white-space: nowrap;
        }

        .status-upcoming {
            background-color: #FEF3C7;
            color: #92400E;
        }

        .status-ongoing {
            background-color: #DBEAFE;
            color: #1E40AF;
        }

        .status-completed {
            background-color: #DCFCE7;
            color: #166534;
        }

        /* Essential for mobile/iPad responsiveness: enables horizontal scrolling */
        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* --- Custom CSS for DataTables Layout/Gaps and Mobile Responsiveness --- */

        /* Add margin below the search/length controls (DataTables 'l' and 'f' elements) */
        .dataTables_filter,
        .dataTables_length {
            margin-bottom: 1rem;
        }

        /* Ensure search and length controls stack nicely on small screens */
        .dataTables_wrapper .row:first-child>div {
            margin-bottom: 0.5rem;
            /* Add slight separation between top elements */
        }

        /* Add margin above pagination/info (DataTables 'i' and 'p' elements) */
        .dataTables_info,
        .dataTables_paginate {
            margin-top: 1rem;
        }

        @media (max-width: 640px) {
            .notice-container {
                width: 100%;
                padding: 1rem;
            }

            h1 {
                font-size: 1.75rem !important;
            }

            #mediationTable th,
            #mediationTable td {
                padding: 0.5rem !important;
                font-size: 0.9rem;
            }

            /* Force search and length to full width/stacked layout on mobile */
            .dataTables_length,
            .dataTables_filter {
                width: 100% !important;
                text-align: left !important;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">

    @include('homepage.layouts.header')

    <div class="notice-container mt-10 p-4 sm:p-6 bg-white shadow-lg rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mediation Cause List</h1>

        <div
            class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50 flex flex-col sm:flex-row gap-4 justify-start items-stretch sm:items-center">
            <div class="flex flex-col flex-1">
                <label for="min-date" class="text-sm font-medium text-gray-700 mb-1">From Date</label>
                <input type="date" id="min-date"
                    class="border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
            <div class="flex flex-col flex-1">
                <label for="max-date" class="text-sm font-medium text-gray-700 mb-1">To Date</label>
                <input type="date" id="max-date"
                    class="border border-gray-300 p-2 rounded-md focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="table-wrapper">
            <table id="mediationTable" class="display w-full text-gray-700">
                <thead>
                    <tr>
                        <th class="whitespace-nowrap">Sl. No</th>
                        <th class="whitespace-nowrap">Description</th>
                        <th class="whitespace-nowrap">Mediation Date</th>
                        <th class="whitespace-nowrap">Actions</th>
                        <th class="whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($causeLists as $list)
                        @php
                            $status = $list->dynamic_status ?? 'upcoming';
                            $fileName = basename($list->file_path ?? '');
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            {{-- FIX: Use $loop->iteration to guarantee serial number visibility on load --}}
                            <td class="text-sm">
                                {{ $loop->iteration }} </td>

                            <td class="text-sm text-gray-700">{{ $list->description }}</td>
                            <td class="text-sm text-gray-700 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($list->to_be_held_on)->format('d-m-Y') }}
                            </td>
                            <td class="text-sm space-x-2 whitespace-nowrap">
                                @if (!empty($fileName))
                                    <a href="{{ asset('storage/causelists/' . $fileName) }}" download
                                        class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded-md shadow hover:bg-green-700 transition">
                                        <i class="fa-solid fa-download mr-1"></i> Download
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">No file</span>
                                @endif
                            </td>
                            <td>
                                <span class="status-badge status-{{ $status }}">
                                    {{ ucfirst($status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        {{-- 💡 Blade Fallback: This row will be displayed if no results are present AND JavaScript is disabled.
                        It will be removed by the JS below if DataTables runs. --}}
                        <tr>
                            <td colspan="5" class="dataTables_empty text-center text-gray-400 py-6 italic">
                                No mediation cause list found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('homepage.layouts.footer')

    <script>
        // Helper function to convert 'd-m-Y' string (from PHP) to a comparable Date object's milliseconds
        function dateToMs(dateString) {
            if (!dateString) return null;
            let parts = dateString.split('-');
            // Date(year, monthIndex, day) - Month is 0-indexed in JS
            return new Date(parts[2], parts[1] - 1, parts[0]).getTime();
        }

        $(document).ready(function() {
            // 🛑 FIX: Cleanup the Blade empty state row if it exists before DataTables initialization.
            const $tbody = $('#mediationTable tbody');
            // Check if there is exactly 1 row and that row contains a td with the colspan attribute (the empty message)
            if ($tbody.find('tr').length === 1 && $tbody.find('td[colspan]').length > 0) {
                $tbody.empty();
            }
            // End FIX

            var table = $('#mediationTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10,
                autoWidth: false,
                order: [
                    [2, "desc"] // Order by Mediation Date (column 2) descending
                ],
                columnDefs: [
                    // FIX: Remove DataTables serial number setup since we use PHP
                    {
                        orderable: false,
                        targets: [0, 3, 4] // Sl. No, Actions, Status
                    },
                    {
                        width: "35%",
                        targets: 1 // Description column width
                    },
                    {
                        width: "150px", // Mediation Date
                        targets: 2
                    },
                ],
                dom: 'lfrtip',
                language: {
                    // DataTables will display this message automatically after parsing the empty DOM
                    emptyTable: "No mediation cause list found."
                }
            });


            // 1. DataTables Custom Date Range Filtering Logic
            $.fn.dataTable.ext.search.push(
                function(settings, data, dataIndex) {
                    if (settings.nTable.id !== 'mediationTable') {
                        return true;
                    }

                    const minDateVal = $('#min-date').val();
                    const maxDateVal = $('#max-date').val();
                    const heldOnDateStr = data[2] || '';

                    if (heldOnDateStr.length < 8) return true;

                    const heldOnMs = dateToMs(heldOnDateStr);
                    const minMs = minDateVal ? new Date(minDateVal).getTime() : null;
                    const maxMs = maxDateVal ? new Date(maxDateVal).getTime() : null;

                    if (minMs && heldOnMs < minMs) {
                        return false;
                    }
                    if (maxMs && heldOnMs > maxMs) {
                        return false;
                    }

                    return true;
                }
            );

            // 2. Trigger table redraw when date inputs change
            $('#min-date, #max-date').change(function() {
                table.draw();
            });

        });
    </script>
</body>

</html>
