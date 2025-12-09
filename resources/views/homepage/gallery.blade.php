<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Photo Gallery</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <style>
        .album-card:hover .album-overlay {
            opacity: 1;
        }
    </style>
</head>

<body class="min-h-screen bg-gray-100 flex flex-col font-sans">

    @include('homepage.layouts.header')

    <main class="flex-grow">

        {{-- PAGE HEADER --}}
        <section class="bg-blue-900 text-white py-16 mb-12">
            <div class="max-w-7xl mx-auto px-6">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-3">
                    📸 Official Photo <span class="text-yellow-400">Gallery</span>
                </h1>
                <p class="text-lg text-gray-300">
                    Explore visual memories from our initiatives, events, and legal outreach programs.
                </p>
                <nav class="mt-4 text-sm">
                    <ol class="flex space-x-2">
                        <li><a href="/" class="hover:text-yellow-400">Home</a></li>
                        <li class="text-yellow-400">/</li>
                        <li>Gallery</li>
                    </ol>
                </nav>
            </div>
        </section>

        {{-- ALBUMS LIST --}}
        <section class="max-w-7xl mx-auto px-6 pb-20">

            <h2 class="text-3xl font-bold text-blue-900 mb-10 border-b border-gray-300 pb-3">
                All Albums
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                @foreach ($albums as $album)
                    <div
                        class="album-card group relative bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 hover:shadow-2xl hover:scale-[1.03] border border-gray-200 hover:border-blue-500">

                        {{-- Album Thumbnail --}}
                        <div class="h-64 overflow-hidden">
                            <img src="{{ $album->cover_image
                                ? asset('storage/gallery/albums/' . $album->cover_image)
                                : 'https://via.placeholder.com/600x400?text=No+Image' }}"
                                alt="Album: {{ $album->title }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                loading="lazy">
                        </div>

                        {{-- Overlay --}}
                        <a href="{{ route('homepage.gallery', $album->id) }}"
                           class="absolute inset-0 flex flex-col justify-between p-6 bg-black/50 transition duration-300 album-overlay opacity-0 group-hover:opacity-100">

                            <div class="flex justify-between items-center w-full">
                                <span class="bg-yellow-400 text-blue-900 font-bold px-3 py-1 text-sm rounded-full shadow-lg">
                                    {{ $album->photos_count ?? $album->photos->count() }} Photos
                                </span>
                                <i data-feather="external-link" class="w-6 h-6 text-white"></i>
                            </div>

                            <div class="text-white">
                                <h3 class="text-2xl font-bold leading-snug mb-1 text-yellow-400">
                                    {{ $album->title }}
                                </h3>
                                <p class="text-sm text-gray-200">Date: {{ $album->date }}</p>
                            </div>
                        </a>

                        {{-- Bottom Info --}}
                        <div class="p-4 bg-white">
                            <h3 class="text-lg font-semibold text-blue-900 truncate">
                                 <a href="{{ route('homepage.gallery', $album->id) }}"
                                    class="hover:text-yellow-500 transition">{{ $album->title }}</a>
                            </h3>
                            <p class="text-xs text-gray-500 mt-1">
                                <i data-feather="calendar" class="w-3 h-3 inline mr-1"></i>
                                {{ $album->date }}
                            </p>
                        </div>

                    </div>
                @endforeach

            </div>

            {{-- Pagination --}}
            @if (method_exists($albums, 'links'))
                <div class="col-span-full mt-8">
                    {{ $albums->links() }}
                </div>
            @endif

            {{-- CTA Box --}}
            <div class="mt-20 p-10 bg-blue-800 rounded-xl shadow-xl text-center">
                <h3 class="text-3xl font-bold text-white mb-3">Need Legal Assistance?</h3>
                <p class="text-gray-200 mb-6">
                    If you or someone you know is eligible for free legal services, apply today.
                </p>
                <a href="{{ route('homepage.legalaid') }}"
                   class="inline-block px-8 py-3 bg-yellow-400 text-blue-900 font-semibold rounded-md shadow-lg hover:bg-yellow-500 transition-all">
                    Seek Legal Assistance Now
                </a>
            </div>

        </section>
    </main>

    @include('homepage.layouts.footer')

    <script>
        feather.replace();
    </script>

</body>
</html>
