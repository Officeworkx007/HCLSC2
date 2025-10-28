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

    <!-- ✅ PDF.js CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf_viewer.min.js"></script>

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

        /* Modal */
        .modal {
            position: fixed;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 50;
        }

        .modal.active {
            display: flex;
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
                                    <div class="flex items-center gap-5">
                                        <!-- View Button -->
                                        <button onclick="openPdfViewer('{{ asset('storage/' . $list->file_path) }}')"
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

    <!-- PDF Modal -->
    <div id="pdfModal" class="modal">
        <div class="bg-white rounded-lg shadow-xl max-w-6xl w-[90%] h-[90vh] flex flex-col relative">
            <button onclick="closePdfModal()"
                class="absolute top-3 right-3 bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600">
                ✕
            </button>
            <div id="pdf-viewer" class="flex-1 overflow-auto p-4 bg-gray-100 rounded-lg"></div>
        </div>
    </div>

    @include('homepage.layouts.footer')

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

            // Auto numbering for Sl. No
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

        // ===== PDF.js Viewer =====
        async function openPdfViewer(pdfUrl) {
            document.getElementById('pdfModal').classList.add('active');
            const viewer = document.getElementById('pdf-viewer');
            viewer.innerHTML = "<p class='text-center text-gray-500 mt-4'>Loading PDF...</p>";

            try {
                const loadingTask = pdfjsLib.getDocument(pdfUrl);
                const pdf = await loadingTask.promise;
                viewer.innerHTML = ''; // clear loader

                for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
                    const page = await pdf.getPage(pageNum);
                    const scale = 1.2;
                    const viewport = page.getViewport({
                        scale
                    });
                    const canvas = document.createElement('canvas');
                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;
                    canvas.classList.add("mb-4", "shadow-md", "bg-white");
                    viewer.appendChild(canvas);
                    await page.render({
                        canvasContext: context,
                        viewport
                    }).promise;
                }
            } catch (error) {
                viewer.innerHTML =
                    `<p class='text-center text-red-500 mt-4'>Failed to load PDF: ${error.message}</p>`;
            }
        }

        function closePdfModal() {
            document.getElementById('pdfModal').classList.remove('active');
            document.getElementById('pdf-viewer').innerHTML = '';
        }
    </script>
</body>

</html>
