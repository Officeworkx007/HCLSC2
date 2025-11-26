@extends('admin.layouts.master')

@section('title', 'View Album: ' . $album->title)

@section('page-title', 'Album Photos')

{{-- CLEAN CSS: Only includes necessary styles for image fitting --}}
@push('styles')
<style>
    /* Ensures image takes full height of its container while maintaining aspect ratio */
    .image-grid-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Lightbox image sizing for full view with scrolling */
    #lightboxImage {
        /* This ensures the image is constrained by the screen but allows scrolling */
        max-width: 90vw;
        max-height: 90vh;
        object-fit: contain;
        width: auto;
        height: auto;
    }
</style>
@endpush

@section('content')

<section class="p-8 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-300">
            <h1 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i class="fa-solid fa-images w-7 h-7 mr-3 text-indigo-600"></i> Photos in "{{ $album->title }}"
            </h1>
            <a href="{{ route('admin.photo_gallery.index') }}"
               class="inline-flex items-center px-4 py-2 border border-indigo-400 text-sm font-medium rounded-lg shadow-sm text-indigo-600 bg-white hover:bg-indigo-50 transition duration-150">
                <i class="fa-solid fa-arrow-left mr-2"></i> Back to Albums
            </a>
        </div>

        {{-- Album Metadata --}}
        <div class="mb-8 p-4 bg-white rounded-xl shadow-lg border-t-4 border-indigo-600">
            <p class="text-gray-700 text-lg font-semibold">
                Event Date:
                <span class="font-normal text-gray-600">
                    {{ $album->event_date?->format('F d, Y') ?? 'N/A' }}
                </span>
                |
                Total Photos:
                <span class="font-normal text-gray-600">
                    {{ $album->photos->count() }}
                </span>
            </p>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Photo Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
            @forelse ($album->photos as $photo)

            {{-- Image Card --}}
            <div class="bg-white rounded-xl shadow-lg overflow-hidden group">

                {{-- 1. CLICKABLE IMAGE AREA (CLEAN) --}}
                <div class="w-full pb-[100%] relative cursor-pointer image-grid-item"
                     onclick="window.openLightbox('{{ Storage::disk('public')->url($photo->file_path) }}', '{{ $photo->file_name }}')">
                    <img src="{{ Storage::disk('public')->url($photo->file_path) }}"
                         alt="{{ $photo->file_name }}"
                         loading="lazy"
                         class="absolute inset-0 transition duration-300 group-hover:opacity-80">
                </div>

                <div class="p-3">
                    {{-- Caption below the image --}}
                    <div class="p-1 text-xs text-gray-600 truncate text-center mb-2 border-b border-gray-100">
                        {{ $photo->file_name }}
                    </div>

                    {{-- 2. ACTION BUTTONS (ALWAYS VISIBLE, NO CONFLICTS) --}}
                    <div class="flex justify-center space-x-4 text-sm">

                        {{-- Download Button --}}
                        <a href="{{ Storage::disk('public')->url($photo->file_path) }}"
                            download
                            class="text-indigo-600 hover:text-indigo-800 transition flex items-center"
                            title="Download Photo">
                            <i class="fa-solid fa-download mr-1"></i> Download
                        </a>

                        {{-- Delete Button --}}
                        <form action="{{ route('admin.photo_gallery.destroyPhoto', ['album' => $album->id, 'photo' => $photo->id]) }}"
                            method="POST"
                            onsubmit="return confirm('Delete this photo: {{ $photo->file_name }}?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-red-600 hover:text-red-800 transition flex items-center" title="Delete Photo">
                                <i class="fa-solid fa-trash mr-1"></i> Delete
                            </button>
                        </form>
                    </div>
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

{{-- Lightbox (Set to start as 'hidden' via Tailwind) --}}
<div id="lightbox"
     class="fixed inset-0 bg-black bg-opacity-80 hidden flex items-center justify-center z-50 p-4"
     style="display: none;" {{-- Added style="display: none;" as an extra failsafe --}}
     onclick="window.closeLightbox(event)">

    {{-- Container for image and caption --}}
    <div class="relative max-w-[90vw] max-h-[90vh]" onclick="event.stopPropagation()">

        {{-- Close Button --}}
        <button onclick="window.closeLightbox()"
                class="absolute top-4 right-4 text-white text-3xl font-bold p-2 transition hover:text-red-400 z-50">
            <i class="fas fa-times"></i>
        </button>

        <img id="lightboxImage" src=""
             alt="Enlarged Photo"
             class="rounded shadow-2xl">

        <p id="lightboxCaption" class="text-center text-white text-lg font-semibold mt-4"></p>
    </div>
</div>

@endsection

@section('scripts')

<script>
    /**
     * Opens the lightbox/modal with the given image URL and caption.
     * Defined on window object for guaranteed global access.
     */
    window.openLightbox = function(imageUrl, caption) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImage = document.getElementById('lightboxImage');
        const lightboxCaption = document.getElementById('lightboxCaption');

        lightboxImage.src = imageUrl;
        lightboxCaption.textContent = caption;

        // Use explicit style to override the initial 'hidden' or 'display: none'
        lightbox.style.display = 'flex';
        lightbox.classList.remove('hidden');
    }

    /**
     * Closes the lightbox/modal.
     * Defined on window object for guaranteed global access.
     */
    window.closeLightbox = function(event) {
        const lightbox = document.getElementById('lightbox');

        // Prevent closing if click was inside the image container
        if (event && event.currentTarget !== event.target) {
            return;
        }

        // Use explicit style to hide it
        lightbox.style.display = 'none';
        lightbox.classList.add('hidden');
    }

    // Call the functions directly in the onclick attribute using window.openLightbox(...)
</script>

@endsection
