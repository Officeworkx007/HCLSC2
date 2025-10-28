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
                        @endphp
                        <tr class="hover:bg-gray-50 transition">
                            <td></td>
                            <td class="text-sm text-gray-700">{{ $list->description }}</td>
                            <td class="text-sm text-gray-700">
                                {{ \Carbon\Carbon::parse($list->to_be_held_on)->format('d-m-Y') }}
                            </td>
                            <td class="text-sm">
                                @if ($list->file_path)
                                    <div class="flex gap-3">
                                        <!-- View Button -->
                                        <button
                                            onclick="openPdfModal('{{ route('homepage.mediation.view.pdf', $list->id) }}')"
                                            class="text-blue-600 hover:underline flex items-center gap-1">
                                            <i class="fa-solid fa-eye"></i> View
                                        </button>

                                        <!-- Download Button -->
                                        <a href="{{ asset('storage/' . $list->file_path) }}" download
                                            class="text-green-600 hover:underline flex items-center gap-1">
                                            <i class="fa-solid fa-download"></i> Download
                                        </a>
                                    </div>
                                @else
                                    <span class="text-gray-400">No File</span>
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

    <!-- PDF Viewer Modal -->
    <div id="pdfModal"
        class="fixed inset-0 bg-black bg-opacity-70 hidden z-50 flex items-center justify-center backdrop-blur-sm">
        <div class="bg-white w-11/12 h-[90vh] rounded-lg relative shadow-lg flex flex-col">
            <button onclick="closePdfModal()"
                class="absolute top-3 right-4 text-3xl font-bold text-red-600 hover:text-red-800">&times;</button>

            <canvas id="pdfCanvas" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- PDF.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js"></script>

    <script>
        // DataTables setup
        $(document).ready(function() {
            var table = $('#mediationTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                pageLength: 10,
                autoWidth: false,
                order: [
                    [2, "desc"]
                ],
                columnDefs: [{
                        orderable: false,
                        targets: [3, 4]
                    },
                    {
                        width: "60px",
                        targets: 0
                    },
                    {
                        width: "40%",
                        targets: 1
                    },
                    {
                        width: "120px",
                        targets: 2
                    }
                ],
                language: {
                    emptyTable: "No mediation cause list found."
                }
            });

            // Auto numbering
            table.on('order.dt search.dt draw.dt page.dt', function() {
                let rows = table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes();
                rows.each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });

        // PDF.js setup
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc =
            'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.worker.min.js';

        let pdfDoc = null;
        const canvas = document.getElementById('pdfCanvas');
        const ctx = canvas.getContext('2d');

        function openPdfModal(url) {
            document.getElementById('pdfModal').classList.remove('hidden');
            pdfjsLib.getDocument(url).promise.then(function(pdf) {
                pdfDoc = pdf;
                renderPage(1);
            }).catch(err => {
                alert("Error loading PDF file.");
                console.error(err);
            });
        }

        function closePdfModal() {
            document.getElementById('pdfModal').classList.add('hidden');
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            pdfDoc = null;
        }

        function renderPage(num) {
            pdfDoc.getPage(num).then(function(page) {
                const viewport = page.getViewport({
                    scale: 1.2
                });
                canvas.height = viewport.height;
                canvas.width = viewport.width;

                const renderContext = {
                    canvasContext: ctx,
                    viewport: viewport
                };
                page.render(renderContext);
            });
        }
    </script>
</body>

</html>
