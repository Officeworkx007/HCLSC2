@extends('admin.layouts.master')

@section('title', 'Album Management')
@section('page-title', 'Photo Gallery Management')

@push('styles')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">

<style>
    /* Table wrapper for horizontal scroll */
    .table-wrapper {
        overflow-x: auto;
    }

    #galleryAlbumsTable {
        border-collapse: separate;
        border-spacing: 0;
        width: 100%;
        font-size: 0.95rem;
        background-color: #ffffff;
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }

    #galleryAlbumsTable th {
        background: linear-gradient(90deg, #1e3a8a, #2563eb);
        color: #fff;
        font-weight: 600;
        text-transform: uppercase;
        padding: 0.75rem 1rem;
        text-align: left;
        letter-spacing: 0.5px;
    }

    #galleryAlbumsTable td {
        padding: 0.65rem 1rem;
        border-bottom: 1px solid #f0f0f0;
        vertical-align: middle;
        color: #374151;
    }

    #galleryAlbumsTable tbody tr {
        transition: all 0.2s ease-in-out;
    }

    #galleryAlbumsTable tbody tr:hover {
        background-color: #f3f4f6;
        box-shadow: inset 0 0 10px rgba(0,0,0,0.03);
    }

    #galleryAlbumsTable tbody tr:nth-child(even) {
        background-color: #f9fafb;
    }

    /* Actions buttons modern look */
    .flex.justify-center.gap-2 a,
    .flex.justify-center.gap-2 button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border-radius: 0.5rem;
        transition: all 0.2s ease-in-out;
    }

    .flex.justify-center.gap-2 a:hover,
    .flex.justify-center.gap-2 button:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    /* Primary Admin Button */
    .admin-btn-primary {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.55rem 1.1rem;
        background: linear-gradient(90deg, #1e3a8a, #2563eb);
        color: #ffffff;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.5rem;
        box-shadow: 0 3px 6px rgba(0,0,0,0.15);
        transition: all 0.18s ease-in-out;
        text-decoration: none;
        letter-spacing: 0.3px;
    }

    .admin-btn-primary:hover {
        background: linear-gradient(90deg, #23398f, #1d4ed8);
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(0,0,0,0.20);
        color: #fff;
    }

    .admin-btn-primary i {
        font-size: 0.9rem;
    }

    /* Lightbox */
    #lightboxImage {
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
    }
</style>
@endpush

@section('content')
<div class="w-full p-6 bg-white shadow-xl rounded-2xl">

    {{-- Success Message --}}
    @if (session('success'))
        <div id="success-alert" class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-md transition-opacity duration-500">
            <p class="font-bold">Success</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-3 mb-6">
        <h2 class="text-xl md:text-2xl font-bold text-gray-800">Album Management</h2>

        <a href="{{ route('admin.photo_gallery.create') }}" class="admin-btn-primary">
            <i class="fas fa-plus"></i> Create New Album
        </a>
    </div>

    {{-- Table --}}
    <div class="table-wrapper border border-gray-200 rounded-lg">
        <table id="galleryAlbumsTable" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Album Title</th>
                    <th>Event Date</th>
                    <th>Photos</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($albums as $index => $album)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $album->title }}</td>
                        <td data-order="{{ $album->event_date->timestamp }}">
                            {{ $album->event_date->format('F d, Y') }}
                        </td>
                        <td>{{ $album->photos_count }} Photos</td>
                        <td data-order="{{ $album->created_at->timestamp }}">
                            {{ $album->created_at->diffForHumans() }}
                        </td>
                        <td class="text-center">
                            <div class="flex justify-center gap-2">
                                {{-- VIEW --}}
                                <a href="{{ route('admin.photo_gallery.show', $album) }}" class="p-2 rounded-full bg-blue-50 hover:bg-blue-100 text-blue-600">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- EDIT (disabled as in original) --}}
                                <button class="p-2 rounded-full bg-gray-100 text-gray-400 cursor-not-allowed">
                                    <i class="fas fa-pen"></i>
                                </button>

                                {{-- DELETE --}}
                                <form id="delete-{{ $album->id }}" action="{{ route('admin.photo_gallery.destroy', $album) }}" method="POST" onsubmit="return confirm('This will permanently delete the album & all photos. Continue?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 rounded-full bg-red-50 hover:bg-red-100 text-red-600">
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
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-80 hidden flex items-center justify-center z-50 p-4"
     onclick="closeLightbox(event)">
    <div class="relative max-w-[90vw] max-h-[90vh]" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-3xl font-bold p-2 hover:text-red-400 z-50">
            <i class="fas fa-times"></i>
        </button>
        <img id="lightboxImage" class="rounded shadow-2xl">
        <p id="lightboxCaption" class="text-center text-white text-lg font-semibold mt-4"></p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
(function($){
    $(document).ready(function(){
        // Auto-hide success alert
        var alertBox = document.getElementById('success-alert');
        if(alertBox){
            setTimeout(function(){
                alertBox.style.opacity = '0';
                setTimeout(function(){ alertBox.remove(); }, 500);
            }, 5000);
        }

        // Initialize DataTable
        if($('#galleryAlbumsTable').length){
            $('#galleryAlbumsTable').DataTable({
                responsive: true,
                pageLength: 10,
                lengthMenu: [5,10,25,50],
                ordering: true,
                searching: true,
                columnDefs: [
                    { orderable: false, targets: [5] },
                    { responsivePriority: 1, targets: -1 }
                ],
                language: {
                    search: "Search Albums:",
                    emptyTable: "No albums available."
                }
            });
        }
    });
})(jQuery);

// Lightbox open/close
function openLightbox(imageUrl, caption){
    document.getElementById('lightboxImage').src = imageUrl;
    document.getElementById('lightboxCaption').textContent = caption;
    document.getElementById('lightbox').classList.remove('hidden');
}
function closeLightbox(event){
    if(event && event.currentTarget !== event.target) return;
    document.getElementById('lightbox').classList.add('hidden');
}
</script>
@endpush
