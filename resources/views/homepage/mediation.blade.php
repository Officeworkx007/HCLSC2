<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mediation Cause List</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">

    <!-- jQuery + DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>

    <style>
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

        #mediationTable th,
        #mediationTable td {
            padding: 0.9rem 1rem !important;
            vertical-align: middle;
            text-align: left;
        }

        #mediationTable tbody tr:nth-child(even) {
            background-color: #F9FAFB;
        }

        #mediationTable tbody tr:hover {
            background-color: #EEF2FF;
        }

        .status-badge {
            display: inline-block;
            padding: 0.35rem 0.8rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
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

        .table-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
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
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col">

    @include('homepage.layouts.header')

    <div class="notice-container mt-10 p-4 sm:p-6 bg-white shadow-lg rounded-xl">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 text-center">Mediation Cause List</h1>

        <div class="table-wrapper">
            <table id="mediationTable" class="display w-full text-gray-700">
                <thead>
                    <tr>
                        <th>Sl. No</th>
                        <th>Description</th>
                        <th>To be held on</th>
                        <th>Actions</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($causeLists as $list)
                        @php
                            $status = $list->dynamic_status ?? 'upcoming';
                            $fileName = basename($list->file_path ?? '');
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td></td>
                            <td class="text-sm text-gray-700">{{ $list->description }}</td>
                            <td class="text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($list->to_be_held_on)->format('d-m-Y') }}
                            </td>
                            <td class="text-sm space-x-2">
                                @if (!empty($fileName))
                                    <a href="{{ route('homepage.mediation.view', ['filename' => urlencode($fileName)]) }}"
                                        target="_blank"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded-md shadow hover:bg-blue-700 transition">
                                        <i class="fa-solid fa-eye mr-1"></i> View
                                    </a>

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
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-6 italic">
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
        $(document).ready(function() {
            var table = $('#mediationTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10,
                autoWidth: false,
                order: [[2, "desc"]],
                columnDefs: [
                    { orderable: false, targets: [3, 4] },
                    { width: "60px", targets: 0 },
                    { width: "40%", targets: 1 },
                    { width: "120px", targets: 2 }
                ],
                language: { emptyTable: "No mediation cause list found." }
            });

            table.on('order.dt search.dt draw.dt page.dt', function() {
                let rows = table.column(0, { search: 'applied', order: 'applied' }).nodes();
                rows.each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
</body>

</html>
