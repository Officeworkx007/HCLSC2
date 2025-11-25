@extends('admin.layouts.master')

@section('title', 'View Album: ' . $album->title)

@section('page-title', 'Album Photos')

@section('content')

<section class="p-8 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto">

        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8 pb-4 border-b border-gray-300">
            <h1 class="text-3xl font-extrabold text-gray-800 flex items-center">
                <i data-feather="image" class="w-7 h-7 mr-3 text-indigo-600"></i> Photos in "{{ $album->title }}"
            </h1>
            <a href="{{ route('admin.photo_gallery.index') }}"
               class="inline-flex items-center px-4 py-2 border border-indigo-400 text-sm font-medium rounded-lg shadow-sm text-indigo-600 bg-white hover:bg-indigo-50 transition duration-150">
                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i> Back to Albums
            </a>
        </div>

        {{-- Album Metadata (Error Fix Applied Here) --}}
        <div class="mb-8 p-4 bg-white rounded-xl shadow-lg border-t-4 border-indigo-600">
            <p class="text-gray-700 text-lg font-semibold">
                Event Date:
                {{-- FIX: Safely access the date using the null-safe operator (?->) --}}
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

        {{-- Success/Error Message Placeholder --}}
        @if (session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Photo Grid --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6">
            @forelse ($album->photos as $photo)

            {{-- Modern Photo Card Style --}}
            <div class="relative bg-white rounded-xl shadow-xl overflow-hidden group transform hover:shadow-2xl transition duration-500 ease-in-out">

                {{-- Image --}}
                <img src="{{ Storage::disk('public')->url($photo->file_path) }}"
                     alt="{{ $photo->file_name }}"
                     class="w-full h-40 object-cover transition duration-500 group-hover:opacity-80">

                {{-- Overlay Actions --}}
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">

                    {{-- DELETE FORM (Requires a route like admin.photo_gallery.photo.destroy) --}}
                    <form action="" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this photo: {{ $photo->file_name }}?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-white bg-red-600 p-3 rounded-full hover:bg-red-700 shadow-lg transition duration-150 transform hover:scale-110" title="Delete Photo">
                            <i data-feather="trash-2" class="w-5 h-5"></i>
                        </button>
                    </form>

                    {{-- You can add a view/zoom button here if needed --}}

                </div>

                {{-- Caption/Details (Optional) --}}
                <div class="p-2 text-xs text-gray-500 truncate text-center">
                    {{ $photo->file_name }}
                </div>
            </div>

            @empty
            <div class="col-span-full bg-yellow-100 p-6 rounded-xl text-center text-yellow-800 border border-yellow-300 shadow-md">
                <i data-feather="alert-triangle" class="w-6 h-6 inline mr-2"></i> No photos have been uploaded for this album yet.
            </div>
            @endforelse
        </div>

    </div>
</section>

@endsection

@section('scripts')
<script>
    feather.replace();
    // No additional JavaScript needed as deletion is handled via form onsubmit.
</script>
@endsection
