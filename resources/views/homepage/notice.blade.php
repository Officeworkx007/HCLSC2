<!doctype html>
<html lang="en">

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
        /* Container width is fluid but constrained */
        .notice-container {
            max-width: 1400px;
            width: 95%;
            margin: auto;
        }

        /* General table sizing & font */
        #noticesTable {
            font-size: 1rem;
            width: 100% !important;
            border-collapse: collapse;
        }

        #noticesTable th,
        #noticesTable td {
            padding: 0.75rem 1rem !important;
            vertical-align: middle;
            text-align: left;
            box-sizing: border-box;
        }

        /* Allow text wrapping */
        #noticesTable td:nth-child(2) {
            white-space: normal;
            word-break: break-word;
        }

        /* Space between DataTables search box and table */
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        /* Make DataTables controls align nicely */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
            justify-content: flex-start;
        }

        /* Keep header text spacing consistent */
        #noticesTable thead th .th-text {
            display: inline-block;
            margin-right: 1.25rem;
        }

        /* PDF/status compact columns */
        #noticesTable td:nth-child(5),
        #noticesTable td:nth-child(6) {
            white-space: nowrap;
        }

        /* Blinking active badge */
        @keyframes blink {
            0%, 50%, 100% { opacity: 1; }
            25%, 75% { opacity: 0; }
        }

        .blinking {
            animation: blink 1s infinite;
        }

        /* ✅ MOBILE OPTIMIZATION BELOW */

        /* Make table horizontally scrollable on small screens */
        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* Adjust DataTables inputs for mobile */
        .dataTables_wrapper select,
        .dataTables_wrapper input {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 0.3rem 0.5rem;
        }

        /* Prevent zoom issues on mobile */
        input,
        select {
            font-size: 16px;
        }

        /* Tighten margins on very small devices */
        @media (max-width: 640px) {
            .notice-container {
                width: 100%;
                padding: 1rem;
            }

            h1 {
                font-size: 1.75rem !important;
            }

            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            #noticesTable th,
            #noticesTable td {
                padding: 0.5rem !important;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">

    @include('homepage.layouts.header')

    <div class="bg-[#FDFBD4] py-12 text-center text-black shadow">
        <h1 class="text-4xl md:text-5xl font-bold tracking-wide flex flex-wrap justify-center items-center gap-3 px-4">
            <i class="fas fa-clipboard-list text-yellow-500"></i>
            Notice Board
        </h1>
        <p class="mt-2 text-base md:text-lg">Stay updated with the latest notices</p>
    </div>

    <div class="notice-container mt-10 p-4 sm:p-6 bg-white shadow-lg rounded-xl">
        <div class="table-wrapper">
            <table id="noticesTable" class="display w-full text-gray-700">
                <thead class="bg-blue-700 text-white uppercase text-sm sm:text-base">
                    <tr>
                        <th><span class="th-text">Sl. No</span></th>
                        <th><span class="th-text">Description</span></th>
                        <th><span class="th-text">Order No.</span></th>
                        <th><span class="th-text">Date</span></th>
                        <th><span class="th-text">PDF</span></th>
                        <th><span class="th-text">Status</span></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @php $activeNotices = $notices->where('status', 1)->values(); @endphp

                    @forelse ($activeNotices as $index => $notice)
                        <tr class="hover:bg-gray-50">
                            <td></td>
                            <td class="text-sm text-gray-700">{{ $notice->description }}</td>
                            <td class="text-sm text-gray-700">{{ $notice->order_no }}</td>
                            <td class="text-sm text-gray-700 w-40">
                                {{ \Carbon\Carbon::parse($notice->notice_date)->format('d-m-Y') }}
                            </td>
                            <td class="text-sm">
                                @if ($notice->pdf_path)
                                    <a href="{{ asset('storage/' . $notice->pdf_path) }}" target="_blank"
                                        class="text-indigo-600 hover:underline flex items-center gap-1">
                                        <i class="fas fa-file-pdf"></i> View PDF
                                    </a>
                                @else
                                    <span class="text-gray-400">No File</span>
                                @endif
                            </td>
                            <td>
                                <span
                                    class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700 blinking">
                                    Active
                                </span>
                            </td>
                        </tr>
                    @empty
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
                autoWidth: false,
                order: [[3, "desc"]],
                columnDefs: [
                    { orderable: false, targets: [4, 5] },
                    { width: "60px", targets: 0 },
                    { width: "40%", targets: 1 },
                    { width: "100px", targets: 3 }
                ],
                language: { emptyTable: "No active notices found." }
            });

            // Dynamic numbering
            table.on('order.dt search.dt draw.dt page.dt', function() {
                var rows = table.column(0, { search: 'applied', order: 'applied' }).nodes();
                if (rows.length > 0) {
                    rows.each(function(cell, i) {
                        cell.innerHTML = i + 1;
                    });
                }
            }).draw();
        });
    </script>
</body>
</html>
