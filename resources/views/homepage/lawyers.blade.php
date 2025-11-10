<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Panel Lawyers | HCLSC</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- DataTables Dependencies --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.min.css">

    <style>
        /* Max width for large screens */
        .max-w-8xl {
            max-width: 1800px;
        }

        /* Ensures the DataTables wrapper is fluid */
        #panelLawyersTable_wrapper {
            width: 100% !important;
        }

        /* Style for striped rows (Zebra Striping) */
        #panelLawyersTable tbody tr:nth-child(even) {
            background-color: #f7f7f7;
        }

        /* Hover effect adjustment */
        #panelLawyersTable tbody tr:hover {
            background-color: #e0f2fe;
        }

        /* Styling the search input (fluid on small screens, limited on large) */
        .dataTables_wrapper input[type="search"] {
            border-radius: 0.25rem;
            border-color: #ccc;
            padding: 0.5rem 1rem;
            width: 100%;
            box-sizing: border-box;
        }

        /* Table header styling (Deep Blue) */
        #panelLawyersTable thead th {
            background-color: #1e3a8a;
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            white-space: nowrap;
        }

        /* Apply borders to cells for structured look */
        #panelLawyersTable {
            border-collapse: collapse !important;
            min-width: 100%;
        }

        #panelLawyersTable th,
        #panelLawyersTable td {
            border: 1px solid #ddd;
            padding-left: 1rem;
            padding-right: 1rem;
        }

        /* Adjust padding for DataTables controls */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 0.75rem 0;
        }

        /* Ensure table cells don't have excessive padding on small screens */
        @media (max-width: 640px) {
            #panelLawyersTable th,
            #panelLawyersTable td {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }
        }

        /* 🛑 FINAL FIX: Force DataTables controls to stack and use full width on all small screens (up to 1024px) */
        @media (max-width: 1024px) {
            /* Top row (Entries dropdown and Search) */
            .dataTables_wrapper .dataTables_length,
            .dataTables_wrapper .dataTables_filter {
                float: none !important;
                width: 100%;
                display: block;
                text-align: left;
                margin-bottom: 0.5rem;
            }

            /* Make search input fully fluid in its container */
            .dataTables_wrapper .dataTables_filter input[type="search"] {
                max-width: 100%;
            }

            /* Bottom row (Info text and Pagination) */
            .dataTables_wrapper .dataTables_info,
            .dataTables_wrapper .dataTables_paginate {
                float: none !important;
                width: 100%;
                display: block;
                text-align: center;
            }

            /* Ensure pagination uses full width and is centered */
            .dataTables_wrapper .dataTables_paginate {
                margin-top: 0.5rem;
                text-align: center;
            }

            /* Specific fix for search input wrapper to ensure proper spacing */
            .dataTables_wrapper .dataTables_filter label {
                width: 100%;
                display: block;
            }
        }
    </style>
</head>

<body class="bg-gradient-to-b from-[#f5f7fa] to-[#e6ebff] text-gray-800 font-sans antialiased flex flex-col min-h-screen">
    @include('homepage.layouts.header')

    <section class="flex-grow w-full max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1e3a8a] mb-4">
                Our <span class="text-[#2563eb]">Panel Lawyers</span>
            </h1>
            <p class="text-gray-600 text-sm sm:text-base md:text-lg max-w-2xl mx-auto">
                Meet our dedicated panel of lawyers committed to providing access to justice without barriers.
            </p>
        </div>

        <div class="p-4 sm:p-6 bg-white shadow-2xl rounded-lg border border-gray-200">
            {{-- Automatic Detection: Scrollbar visible on screens smaller than 'md' (768px), invisible/expanded on 'md' and above. --}}
            <div class="overflow-x-auto md:overflow-x-visible">
                <table id="panelLawyersTable" class="min-w-full text-sm sm:text-base text-left text-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 sm:px-6 py-4" style="width: 5%;">#</th>
                            <th class="px-4 sm:px-6 py-4" style="width: 10%;">Photo</th>
                            <th class="px-4 sm:px-6 py-4" style="width: 23%;">Name</th>
                            <th class="px-4 sm:px-6 py-4" style="width: 15%;">Designation</th>
                            <th class="px-4 sm:px-6 py-4" style="width: 22%;">Email</th>
                            <th class="px-4 sm:px-6 py-4" style="width: 25%;">Address</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @forelse ($panelLawyers as $index => $lawyer)
                            <tr>
                                <td class="px-4 sm:px-6 py-4 font-medium whitespace-nowrap">{{ $index + 1 }}</td>

                                <td class="px-4 sm:px-6 py-4">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full border border-gray-300 shadow-sm mx-auto cursor-pointer"
                                        data-photo-url="{{ $lawyer->photo ? asset('storage/' . $lawyer->photo) : '' }}"
                                        data-lawyer-name="{{ $lawyer->first_name }} {{ $lawyer->last_name }}">
                                        @if ($lawyer->photo)
                                            <img class="h-full w-full object-cover open-modal"
                                                src="{{ asset('storage/' . $lawyer->photo) }}"
                                                alt="{{ $lawyer->first_name }} Photo">
                                        @else
                                            <div class="h-full w-full bg-[#1e3a8a] flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-normal">
                                    <div class="font-semibold text-gray-900 tracking-wide">
                                        {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                    </div>
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-normal">{{ $lawyer->designation ?? '-' }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-normal text-xs sm:text-sm break-all">{{ $lawyer->email ?? '-' }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-normal">{{ $lawyer->address ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-4 sm:px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fa-solid fa-scale-balanced text-4xl text-gray-400"></i>
                                        <p>No panel lawyers available at the moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($panelLawyers instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-8 flex justify-center hidden">
                {{ $panelLawyers->links('pagination::tailwind') }}
            </div>
        @endif
    </section>

    @include('homepage.layouts.footer')

    {{-- Photo Modal/Lightbox (Unchanged) --}}
    <div id="photoModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80 transition-opacity duration-300" onclick="closeModal(event)">
        <div class="relative bg-white/20 p-4 rounded-xl max-w-4xl max-h-[90vh]" onclick="event.stopPropagation()">
            <button class="absolute top-4 right-4 text-white text-3xl font-bold p-2 transition hover:text-red-400" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="Lawyer Photo" class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
            <p id="modalCaption" class="text-center text-white text-lg font-semibold mt-4"></p>
        </div>
    </div>

    {{-- DataTables JS (Unchanged) --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js"></script>

    <script>
        $(document).ready(function() {
            // --- 1. DataTables Initialization ---
            $('#panelLawyersTable').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                ordering: true,
                searching: true,
                order: [
                    [0, 'asc']
                ],
                scrollX: false,
                language: {
                    search: "Search Lawyers:",
                    lengthMenu: "Show _MENU_ entries",
                    emptyTable: "No panel lawyers available at the moment.",
                }
            });

            // --- 2. Photo Modal Logic (Unchanged) ---
            const modal = $('#photoModal');
            const modalImage = $('#modalImage');
            const modalCaption = $('#modalCaption');

            function openModal(photoUrl, lawyerName) {
                modalImage.attr('src', photoUrl);
                modalCaption.text(lawyerName);
                modal.removeClass('hidden').addClass('flex');
            }

            window.closeModal = function(event) {
                if (!event || event.target.id === 'photoModal') {
                    modal.removeClass('flex').addClass('hidden');
                    modalImage.attr('src', '');
                    modalCaption.text('');
                }
            }

            $('#panelLawyersTable').on('click', 'tbody td:nth-child(2) div[data-photo-url]', function() {
                const photoUrl = $(this).data('photo-url');
                const lawyerName = $(this).data('lawyer-name');

                if (photoUrl) {
                    openModal(photoUrl, lawyerName);
                }
            });

            $(document).on('keydown', function(e) {
                if (e.key === 'Escape' && modal.hasClass('flex')) {
                    closeModal();
                }
            });
        });
    </script>
</body>

</html>
