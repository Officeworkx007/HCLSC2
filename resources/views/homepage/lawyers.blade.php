<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Panel Lawyers | HCLSC</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- DataTables Dependencies --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.min.css">

    <style>
        /* 🛑 NEW: Custom utility for max width (slightly wider than 7xl) */
        .max-w-8xl {
            max-width: 1440px;
        }

        /* Ensures the DataTables wrapper is fluid */
        #panelLawyersTable_wrapper {
            width: 100% !important;
        }

        /* Style for striped rows (Zebra Striping) */
        #panelLawyersTable tbody tr:nth-child(even) {
            background-color: #f7f7f7;
            /* Light gray for even rows */
        }

        /* Hover effect adjustment */
        #panelLawyersTable tbody tr:hover {
            background-color: #e0f2fe;
            /* Light blue on hover */
        }

        /* Styling the search input */
        .dataTables_wrapper input[type="search"] {
            border-radius: 0.25rem;
            border-color: #ccc;
            padding: 0.5rem 1rem;
            width: 100%;
            max-width: 18rem;
        }

        /* Table header styling (Deep Blue) */
        #panelLawyersTable thead th {
            background-color: #1e3a8a;
            /* Deep blue background */
            color: #ffffff;
            /* White text */
            font-weight: 700;
            text-transform: uppercase;
        }

        /* Apply borders to cells for structured look */
        #panelLawyersTable {
            border-collapse: collapse !important;
            /* 🛑 NEW: Base font size for table (text-base / 1.0rem) */
            font-size: 1.0rem;
        }

        #panelLawyersTable th,
        #panelLawyersTable td {
            border: 1px solid #ddd;
            /* Subtle border */
        }

        /* Adjust padding for DataTables controls */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_paginate {
            padding: 0.75rem 0;
        }
    </style>
</head>

<body
    class="bg-gradient-to-b from-[#f5f7fa] to-[#e6ebff] text-gray-800 font-sans antialiased flex flex-col min-h-screen">
    @include('homepage.layouts.header')

    {{-- 🛑 FIX: Using the custom max-w-8xl class to set the width to 1440px --}}
    <section class="flex-grow w-full max-w-8xl mx-auto px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1e3a8a] mb-4">
                Panel Lawyers <span class="text-[#2563eb]">of The High Court Legal Services Commitee</span>
            </h1>
            <p class="text-gray-600 text-sm sm:text-base md:text-lg max-w-2xl mx-auto">
                Meet our dedicated panel of lawyers committed to providing access to justice without barriers.
            </p>
        </div>

        <div class="p-6 bg-white shadow-2xl rounded-lg border border-gray-200">
            <div class="w-full">
                {{-- 🛑 FIX: Changed base text size to text-base for medium size --}}
                <table id="panelLawyersTable" class="min-w-full text-base text-left text-gray-700 w-full">
                    <thead>
                        <tr>
                            <th class="px-4 sm:px-6 py-4 w-10">#</th>
                            <th class="px-4 sm:px-6 py-4 w-16">Photo</th>
                            <th class="px-4 sm:px-6 py-4">Name</th>
                            <th class="px-4 sm:px-6 py-4">Designation</th>
                            <th class="px-4 sm:px-6 py-4">Bar Enrolment No</th>
                            <th class="px-4 sm:px-6 py-4">Email</th>
                            <th class="px-4 sm:px-6 py-4">Address</th>
                        </tr>
                    </thead>

                    <tbody class="text-gray-800">
                        @forelse ($panelLawyers as $index => $lawyer)
                            <tr>
                                <td class="px-4 sm:px-6 py-4 font-medium">{{ $index + 1 }}</td>

                                {{-- Photo Column --}}
                                <td class="px-4 sm:px-6 py-4">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full border border-gray-300 shadow-sm mx-auto cursor-pointer"
                                        data-photo-url="{{ $lawyer->photo ? asset('storage/' . $lawyer->photo) : '' }}"
                                        data-lawyer-name="{{ $lawyer->first_name }} {{ $lawyer->last_name }}">
                                        @if ($lawyer->photo)
                                            <img class="h-full w-full object-cover open-modal"
                                                src="{{ asset('storage/' . $lawyer->photo) }}"
                                                alt="{{ $lawyer->first_name }} Photo">
                                        @else
                                            <div
                                                class="h-full w-full bg-[#1e3a8a] flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Content Columns (Whitespace-normal allows wrapping) --}}
                                <td class="px-4 sm:px-6 py-4 whitespace-normal">
                                    <div class="font-semibold text-gray-900 tracking-wide">
                                        {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                    </div>
                                </td>

                                <td class="px-4 sm:px-6 py-4 whitespace-normal">{{ $lawyer->designation ?? '-' }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-normal">{{ $lawyer->enrolment_no ?? '-' }}</td>
                                <td class="px-4 sm:px-6 py-4 whitespace-normal">{{ $lawyer->email ?? '-' }}</td>
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
    <div id="photoModal"
        class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-80 transition-opacity duration-300"
        onclick="closeModal(event)">
        <div class="relative bg-white/20 p-4 rounded-xl max-w-4xl max-h-[90vh]" onclick="event.stopPropagation()">
            <button class="absolute top-4 right-4 text-white text-3xl font-bold p-2 transition hover:text-red-400"
                onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="Lawyer Photo"
                class="max-w-full max-h-[80vh] object-contain rounded-lg shadow-2xl">
            <p id="modalCaption" class="text-center text-white text-lg font-semibold mt-4"></p>
        </div>
    </div>

    {{-- DataTables JS (Unchanged) --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.0.8/js/dataTables.tailwindcss.min.js">
    </script>

    <script>
        $(document).ready(function() {
            // --- REMOVE the Blade 'empty' placeholder row if present (fixes DataTables parsing issue) ---
            const $tbody = $('#panelLawyersTable tbody');
            // If there's exactly 1 row and it contains a td with colspan attribute, remove it.
            if ($tbody.find('tr').length === 1 && $tbody.find('td[colspan]').length > 0) {
                $tbody.empty();
            }

            // Initialize DataTable after cleanup
            let table = $('#panelLawyersTable').DataTable({
                ordering: true,
                searching: true,
                order: [
                    [0, 'asc']
                ],
                scrollX: true,

                // Use retrieve to avoid re-initialization errors and to read DOM
                retrieve: true,
                deferRender: true,
                autoWidth: false,

                columnDefs: [{
                        targets: 0,
                        type: 'num'
                    },
                    {
                        targets: 1,
                        orderable: false,
                        searchable: false
                    },
                ],

                language: {
                    search: "Search Lawyers:",
                    lengthMenu: "Show _MENU_ entries",
                    emptyTable: "No panel lawyers available at the moment.",
                    zeroRecords: "No matching lawyers found."
                },

                // DO NOT provide 'data' here — we are reading rows from DOM (or we removed the placeholder above)
            });

            // --- Modal Logic ---
            $(document).on('click', '.open-modal', function() {
                const imgSrc = $(this).attr('src');
                const name = $(this).closest('div').data('lawyer-name');
                $('#modalImage').attr('src', imgSrc);
                $('#modalCaption').text(name);
                $('#photoModal').removeClass('hidden').addClass('flex');
            });

            window.closeModal = function() {
                $('#photoModal').addClass('hidden').removeClass('flex');
            };
        });
    </script>

</body>

</html>
