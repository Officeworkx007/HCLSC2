@extends('admin.layouts.master')

@section('title', 'Album Management')

@section('page-title', 'Photo Gallery Management')

{{-- EXTRA DATATABLES CSS --}}
@push('styles')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <style>
        #galleryAlbumsTable_wrapper {
            padding: 1rem;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #d1d5db;
            padding: 0.5rem 0.75rem;
            border-radius: 0.375rem;
            width: 15rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #4f46e5 !important;
            color: white !important;
            border-radius: 0.375rem;
        }

        #galleryAlbumsTable td, #galleryAlbumsTable th {
            vertical-align: middle;
            font-size: 0.9rem;
        }

        .action-buttons-container {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
        }
    </style>
@endpush

@section('content')

<section class="p-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-300">
            <h1 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i data-feather="image" class="w-7 h-7 mr-3 text-indigo-600"></i>
                Album Management
            </h1>

            <a href="{{ route('admin.photo_gallery.create') }}"
                class="inline-flex items-center px-4 py-2 rounded-full shadow-lg text-white bg-indigo-600 hover:bg-indigo-700 transition">
                <i data-feather="plus" class="w-4 h-4 mr-2"></i> Create New Album
            </a>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-3 rounded-md mb-6 shadow-md">
                <p class="font-semibold">Success:</p>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">

                <table id="galleryAlbumsTable"
                       class="display stripe hover min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-xs font-semibold text-gray-600 uppercase">#</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Album Title</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Event Date</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Photos</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Created At</th>
                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-600 uppercase">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($albums as $index => $album)
                        <tr>

                            {{-- INDEX --}}
                            <td class="px-6 py-4">{{ $index + 1 }}</td>

                            {{-- TITLE --}}
                            <td class="px-6 py-4">{{ $album->title }}</td>

                            {{-- EVENT DATE --}}
                            <td class="px-6 py-4" data-order="{{ $album->event_date->timestamp }}">
                                {{ $album->event_date->format('F d, Y') }}
                            </td>

                            {{-- PHOTOS COUNT --}}
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 inline-flex text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                    {{ $album->photos_count }} Photos
                                </span>
                            </td>

                            {{-- CREATED --}}
                            <td class="px-6 py-4" data-order="{{ $album->created_at->timestamp }}">
                                {{ $album->created_at->diffForHumans() }}
                            </td>

                            {{-- ACTIONS --}}
                            <td class="px-6 py-4 text-center">
                                <div class="action-buttons-container">

                                    {{-- VIEW --}}
                                    <a href="{{ route('admin.photo_gallery.show', $album) }}"
                                       class="px-3 py-1 text-xs rounded bg-indigo-600 text-white hover:bg-indigo-700 flex items-center">
                                        <i data-feather="eye" class="w-3 h-3 mr-1"></i> View
                                    </a>

                                    {{-- EDIT (Disabled) --}}
                                    <a href="#"
                                       class="px-3 py-1 text-xs rounded bg-gray-200 text-gray-600 cursor-not-allowed flex items-center">
                                        <i data-feather="edit-2" class="w-3 h-3 mr-1"></i> Edit
                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.photo_gallery.destroy', $album) }}"
                                          method="POST"
                                          onsubmit="return confirm('This will permanently delete the album & all photos. Continue?');">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-3 py-1 text-xs rounded bg-red-600 text-white hover:bg-red-700 flex items-center">
                                            <i data-feather="trash-2" class="w-3 h-3 mr-1"></i> Delete
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
    </div>
</section>

@endsection

{{-- DATATABLES JS --}}
@push('scripts')
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>

<script>
    feather.replace();

    $(document).ready(function() {
        $('#galleryAlbumsTable').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: true,
            dom: 'lftip',
            order: [[2, 'desc']], // event_date
            columnDefs: [
                { orderable: false, targets: [0, 5] }
            ],
            pageLength: 10
        });
    });
</script>
@endpush
