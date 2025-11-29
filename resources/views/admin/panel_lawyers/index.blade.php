@extends('admin.layouts.master')

@section('title', 'Admin Dashboard')

@section('page-title', 'Panel Lawyers List')

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<style>
    /* Remove scroll on large screens but enable for small screens */
    .table-wrapper {
        overflow-x: visible;
    }

    @media (max-width: 1024px) {
        .table-wrapper {
            overflow-x: auto;
        }
    }

    /* Lightbox responsiveness */
    #lightboxImage {
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
    }
</style>
@endpush

@section('content')
<div class="w-full p-4 md:p-6 bg-white shadow-xl rounded-2xl">

    {{-- Success Message --}}
    @if (session('success'))
        <div id="success-alert"
            class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-md transition-opacity duration-500">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Panel Lawyers</h2>

        <a href="{{ route('admin.panel_lawyers.create') }}"
            class="flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg shadow-md hover:bg-indigo-700 transition transform hover:scale-[1.01]">
            <i class="fas fa-plus"></i> Add Panel Lawyer
        </a>
    </div>

    {{-- Table Wrapper --}}
    <div class="table-wrapper border border-gray-200 rounded-lg">
        <table id="panelLawyersTable" class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3">Sl. No.</th>
                    <th class="px-4 py-3">Photo</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Designation</th>
                    <th class="px-4 py-3">Bar Enrolment No</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Phone</th>
                    <th class="px-4 py-3">Address</th>
                    <th class="px-4 py-3">City</th>
                    <th class="px-4 py-3">Pin Code</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100 bg-white">
                @foreach ($panelLawyers as $index => $lawyer)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $index + 1 }}</td>

                        <td class="px-4 py-3">
                            @if ($lawyer->photo)
                                <div class="h-10 w-10 rounded-full overflow-hidden cursor-pointer"
                                    onclick="openLightbox('{{ asset('storage/' . $lawyer->photo) }}', '{{ $lawyer->first_name }} {{ $lawyer->last_name }}')">
                                    <img src="{{ asset('storage/' . $lawyer->photo) }}" class="h-full w-full object-cover">
                                </div>
                            @else
                                <div class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 font-bold">
                                    {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                </div>
                            @endif
                        </td>

                        <td class="px-4 py-3 font-semibold">{{ $lawyer->first_name }} {{ $lawyer->last_name }}</td>
                        <td class="px-4 py-3">{{ $lawyer->designation ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $lawyer->enrolment_no ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $lawyer->email ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $lawyer->phone_number ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $lawyer->address ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $lawyer->city ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $lawyer->pin_code ?? '-' }}</td>

                        <td class="px-4 py-3 text-center">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('admin.panel_lawyers.edit', $lawyer->id) }}"
                                    class="p-2 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-600">
                                    <i class="fas fa-pen"></i>
                                </a>

                                <form action="{{ route('admin.panel_lawyers.destroy', $lawyer->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="p-2 rounded-full bg-red-50 hover:bg-red-100 text-red-600">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Lightbox --}}
<div id="lightbox"
    class="fixed inset-0 bg-black bg-opacity-80 hidden flex items-center justify-center z-50 p-4"
    onclick="closeLightbox(event)">
    <div class="relative max-w-[90vw] max-h-[90vh]" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()"
                class="absolute top-4 right-4 text-white text-3xl font-bold p-2 hover:text-red-400 z-50">
            <i class="fas fa-times"></i>
        </button>

        <img id="lightboxImage" class="rounded shadow-2xl">
        <p id="lightboxCaption" class="text-center text-white text-lg font-semibold mt-4"></p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function () {

        // Auto-hide success alert
        const alertBox = document.getElementById('success-alert');
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }, 5000);
        }

        // DataTables
        $('#panelLawyersTable').DataTable({
            responsive: true,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50],
            ordering: true,
            searching: true,
            language: {
                search: "Search:",
                lengthMenu: "Show _MENU_ entries",
            }
        });
    });

    // Lightbox open
    function openLightbox(imageUrl, caption) {
        document.getElementById('lightboxImage').src = imageUrl;
        document.getElementById('lightboxCaption').textContent = caption;
        document.getElementById('lightbox').classList.remove('hidden');
    }

    // Lightbox close
    function closeLightbox(event) {
        if (event && event.currentTarget !== event.target) return;
        document.getElementById('lightbox').classList.add('hidden');
    }
</script>
@endpush
