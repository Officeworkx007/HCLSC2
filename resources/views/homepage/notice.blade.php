<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Notice Board</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- jQuery then DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <style>
        .notice-container {
            max-width: 1400px;
            /* increase as needed */
            width: 95%;
        }

        /* General table sizing & font */
        #noticesTable {
            font-size: 1rem;
            width: 100% !important;
            border-collapse: collapse;
        }

        /* Make header/body cells use same padding so they're aligned */
        #noticesTable th,
        #noticesTable td {
            padding: 0.75rem 1rem !important;
            /* matches px-4 py-3 */
            vertical-align: middle;
            text-align: left;
            box-sizing: border-box;
        }

        /* Allow description column to wrap */
        #noticesTable td:nth-child(2) {
            white-space: normal;
            word-break: break-word;
        }

        /* Space between DataTables search box and table */
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        /* Make DataTables controls align nicely with Tailwind */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            gap: 0.75rem;
            align-items: center;
        }

        /* Add a right margin on header text (keeps sorting arrows away) */
        /* We wrap header text in .th-text so this always works regardless of DataTables' pseudo elements */
        #noticesTable thead th .th-text {
            display: inline-block;
            margin-right: 1.25rem;
            /* increase to push arrows further */
        }

        /* Optional: small tweak to make PDF/status column compact */
        #noticesTable td:nth-child(5),
        #noticesTable td:nth-child(6) {
            white-space: nowrap;
        }

        @keyframes blink {

            0%,
            50%,
            100% {
                opacity: 1;
            }

            25%,
            75% {
                opacity: 0;
            }
        }

        .blinking {
            animation: blink 1s infinite;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">
    @include('homepage.layouts.header')

    <div class="bg-[#FDFBD4] py-12 text-center text-black shadow">
        <h1 class="text-4xl md:text-5xl font-bold tracking-wide flex justify-center items-center gap-3">
            <i class="fas fa-clipboard-list text-yellow-500"></i> Notice Board
        </h1>
        <p class="mt-2 text-lg">Stay updated with the latest notices</p>
    </div>

    <div class="mx-auto mt-10 p-6 bg-white shadow-lg rounded-xl notice-container">
        <div class="overflow-x-auto">
            <table id="noticesTable" class="display w-full text-gray-700">
                <thead class="bg-blue-700 text-white uppercase">
                    <tr>
                        <th class="sl-no-col">
                            <span class="th-text">Sl. No</span>
                        </th>
                        <th>
                            <span class="th-text">Description</span>
                        </th>
                        <th>
                            <span class="th-text">Order No.</span>
                        </th>
                        <th>
                            <span class="th-text">Date</span>
                        </th>
                        <th>
                            <span class="th-text">PDF</span>
                        </th>
                        <th>
                            <span class="th-text">Status</span>
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php
                        $activeNotices = $notices->where('status', 1)->values();
                    @endphp

                    @forelse ($activeNotices as $index => $notice)
                        <tr class="hover:bg-gray-50">
                            {{-- First column left blank — DataTables will fill numbering client-side so it updates on search/sort/pagination --}}
                            <td class="px-4 py-3"></td>

                            <td class="px-4 py-3 text-sm text-gray-700">{{ $notice->description }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700">{{ $notice->order_no }}</td>
                            <td class="px-4 py-3 text-sm text-gray-700 w-40">
                                {{ \Carbon\Carbon::parse($notice->notice_date)->format('d-m-Y') }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                @if ($notice->pdf_path)
                                    <a href="{{ asset('storage/' . $notice->pdf_path) }}" target="_blank"
                                        class="text-indigo-600 hover:underline flex items-center gap-1">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                @else
                                    <span class="text-gray-400">No File</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700 blinking">
                                    Active
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-500">No active notices found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('homepage.layouts.footer')

    <script>
        $(document).ready(function() {
            var table = $('#noticesTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10,
                autoWidth: false, // don't let DataTables set widths automatically (keeps header/body aligned)
                order: [
                    [3, "asc"]
                ], // default sort by Date column (index 3)
                columnDefs: [{
                        orderable: false,
                        targets: [4, 5]
                    }, // PDF & Status not sortable
                    {
                        width: "60px",
                        targets: 0
                    }, // Sl no small
                    {
                        width: "40%",
                        targets: 1
                    }, // Description wider
                    {
                        width: "100px",
                        targets: 3
                    } // Date
                ],
                // redraw once after init so numbering runs
                drawCallback: function(settings) {
                    // optional: can use this for styling after draw
                }
            });

            // Dynamic Sl. No numbering that updates with search/sort/pagination
            table.on('order.dt search.dt draw.dt page.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
</body>

</html>
