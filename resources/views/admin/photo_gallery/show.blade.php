@extends('admin.layouts.master')

@section('title', 'View Album: ' . $album->title)
@section('page-title', 'Album Photos')

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
    /* Table/Card wrapper */
    .album-wrapper {
        overflow-x: auto;
        margin-top: 1rem;
    }

    /* Header Card */
    .album-header {
        background: linear-gradient(90deg, #1e3a8a, #2563eb);
        color: white;
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }

    .album-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

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

    /* Album Metadata */
    .album-meta {
        background: #ffffff;
        border-radius: 0.75rem;
        padding: 1rem 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
        color: #374151;
    }

    /* Photo Grid */
    .photo-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }

    .photo-card {
        background: #ffffff;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.2s ease-in-out;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .photo-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 15px rgba(0,0,0,0.1);
    }

    .photo-card img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        transition: opacity 0.3s ease-in-out;
        cursor: pointer;
    }

    .photo-card img:hover {
        opacity: 0.85;
    }

    .photo-card .photo-info {
        padding: 0.5rem 0.75rem;
        text-align: center;
        font-size: 0.85rem;
        color: #374151;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .photo-card .photo-info a,
    .photo-card .photo-info button {
        font-size: 0.85rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
        transition: all 0.15s ease-in-out;
    }

    .photo-card .photo-info a:hover,
    .photo-card .photo-info button:hover {
        color: #1e3a8a;
        transform: scale(1.05);
    }

    /* Lightbox */
    #lightbox {
        position: fixed;
        inset: 0;
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 50;
        background-color: rgba(0,0,0,0.85);
        padding: 1rem;
    }

    #lightbox img {
        max-width: 90vw;
        max-height: 90vh;
        border-radius: 0.5rem;
    }

    #lightbox p {
        color: white;
        text-align: center;
        margin-top: 0.5rem;
        font-weight: 600;
    }

    #lightbox .close-btn {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 2rem;
        color: white;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }

    #lightbox .close-btn:hover {
        color: #f87171;
    }
</style>
@endpush

@section('content')
<section class="p-8 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="album-header">
            <h1><i class="fa-solid fa-images"></i> Photos in "{{ $album->title }}"</h1>
            <a href="{{ route('admin.photo_gallery.index') }}" class="admin-btn-primary">
                <i class="fa-solid fa-arrow-left"></i> Back to Albums
            </a>
        </div>

        {{-- Album Metadata --}}
        <div class="album-meta">
            <div>
                <strong>Event Date:</strong>
                {{ $album->event_date?->format('F d, Y') ?? 'N/A' }}
            </div>
            <div>
                <strong>Total Photos:</strong> {{ $album->photos->count() }}
            </div>
        </div>

        {{-- Photo Grid --}}
        <div class="photo-grid">
            @forelse ($album->photos as $photo)
            <div class="photo-card">
                <img src="{{ Storage::disk('public')->url($photo->file_path) }}"
                     alt="{{ $photo->file_name }}"
                     onclick="openLightbox('{{ Storage::disk('public')->url($photo->file_path) }}', '{{ $photo->file_name }}')">

                <div class="photo-info">
                    <a href="{{ Storage::disk('public')->url($photo->file_path) }}" download title="Download">
                        <i class="fa-solid fa-download"></i>
                    </a>

                    <form action="{{ route('admin.photo_gallery.destroyPhoto', ['album' => $album->id, 'photo' => $photo->id]) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this photo: {{ $photo->file_name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" title="Delete Photo"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
            @empty
            <div class="col-span-full bg-yellow-100 p-6 rounded-xl text-center text-yellow-800 border border-yellow-300 shadow-md">
                <i class="fa-solid fa-triangle-exclamation mr-2"></i> No photos uploaded for this album yet.
            </div>
            @endforelse
        </div>
    </div>
</section>

{{-- Lightbox --}}
<div id="lightbox" onclick="closeLightbox(event)">
    <span class="close-btn" onclick="closeLightbox(event)">&times;</span>
    <img id="lightboxImage" src="">
    <p id="lightboxCaption"></p>
</div>
@endsection

@push('scripts')
<script>
    window.openLightbox = function(imageUrl, caption) {
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightboxImage');
        const cap = document.getElementById('lightboxCaption');

        img.src = imageUrl;
        cap.textContent = caption;

        lightbox.style.display = 'flex';
    }

    window.closeLightbox = function(event) {
        if(event && event.currentTarget !== event.target) return;
        document.getElementById('lightbox').style.display = 'none';
    }
</script>
@endpush
