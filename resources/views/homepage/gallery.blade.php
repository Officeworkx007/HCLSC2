<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Photo Gallery | HCLSC</title>

    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- DataTables Dependencies --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.8/css/dataTables.tailwindcss.min.css">


    <style>
        /* Styling for Laravel's default pagination to match your theme */
        .custom-pagination nav svg {
            height: 20px;
        }

        .custom-pagination nav div span,
        .custom-pagination nav div a {
            border-radius: 9999px !important;
            margin: 0 4px;
        }
    </style>
</head>

<body
    class="bg-gradient-to-b from-[#f5f7fa] to-[#e6ebff] text-gray-800 font-sans antialiased flex flex-col min-h-screen">
    @include('homepage.layouts.header')

    <div class="bg-blue-900 pt-32 pb-20 px-4">
        <div class="max-w-[1400px] mx-auto text-center">
            <nav class="flex justify-center mb-4 text-sm text-blue-200 uppercase tracking-widest font-semibold">
                <a href="" class="hover:text-yellow-400">Home</a>
                <span class="mx-2">/</span>
                <span class="text-white">Photo Gallery</span>
            </nav>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight">
                Our <span class="text-yellow-400">Activity</span> Archives
            </h1>
            <p class="text-blue-100 mt-6 max-w-2xl mx-auto text-lg leading-relaxed">
                Explore our full history of National Lok Adalats, mediation programs and various legal service initiatives.
            </p>
        </div>
    </div>

    <div class="max-w-[1400px] mx-auto px-4 md:px-6 -mt-10">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($albums as $album)
                @php $cover = $album->photos->first() ?? $album->photos()->first(); @endphp

                <div
                    class="group bg-white p-3 rounded-[2rem] shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100 flex flex-col">
                    <div class="relative h-56 overflow-hidden rounded-[1.5rem] mb-5">
                        @if ($cover)
                            <img src="{{ asset('storage/' . $cover->file_path) }}" alt="{{ $album->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">No
                                Image</div>
                        @endif

                        <div class="absolute bottom-3 left-3">
                            <span
                                class="bg-yellow-400 text-blue-900 px-3 py-1 rounded-full text-[10px] font-bold shadow-md uppercase">
                                {{ \Carbon\Carbon::parse($album->event_date)->format('M d, Y') }}
                            </span>
                        </div>
                    </div>

                    <div class="px-2 pb-4 flex-grow">
                        <div class="flex items-center gap-2 text-gray-400 text-xs mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                            </svg>
                            {{ $album->photos_count }} Photos
                        </div>
                        <h3
                            class="text-xl font-bold text-blue-900 leading-tight group-hover:text-blue-700 transition-colors">
                            {{ $album->title }}
                        </h3>
                    </div>

                    {{-- Dynamic Link to Single Album Page --}}
                    <a href="
                        class="mt-2 block w-full py-3 bg-gray-50 text-center text-blue-900 font-bold rounded-xl hover:bg-yellow-400 transition-colors">
                        View Album
                    </a>
                </div>
            @endforeach
        </div>

        <div class="mt-16 custom-pagination">
            {{ $albums->links() }}
        </div>
    </div>
    </div>
    @include('homepage.layouts.footer')
</body>

</html>
