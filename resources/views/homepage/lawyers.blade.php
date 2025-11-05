<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Panel Lawyers | HCLSC</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-[#f5f7fa] to-[#e6ebff] text-gray-800 font-sans antialiased flex flex-col min-h-screen">
    @include('homepage.layouts.header')

    <section class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-12">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-[#1e3a8a] mb-4">
                Our <span class="text-[#2563eb]">Panel Lawyers</span>
            </h1>
            <p class="text-gray-600 text-sm sm:text-base md:text-lg max-w-2xl mx-auto">
                Meet our dedicated panel of lawyers committed to providing access to justice without barriers.
            </p>
        </div>

        <div class="overflow-hidden shadow-lg rounded-2xl bg-white/80 backdrop-blur-sm border border-white/30">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-[#e0e7ff]/50 backdrop-blur-sm">
                        <tr>
                            <th class="px-4 sm:px-6 py-3 font-semibold text-[#1e3a8a] w-12">#</th>
                            {{-- 📸 NEW: Photo Header --}}
                            <th class="px-4 sm:px-6 py-3 font-semibold text-[#1e3a8a]">Photo</th>
                            <th class="px-4 sm:px-6 py-3 font-semibold text-[#1e3a8a]">Name</th>
                            <th class="px-4 sm:px-6 py-3 font-semibold text-[#1e3a8a]">Email</th>
                            <th class="px-4 sm:px-6 py-3 font-semibold text-[#1e3a8a]">Address</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100/50">
                        @forelse ($panelLawyers as $index => $lawyer)
                            <tr class="hover:bg-[#eef2ff] transition-all duration-300 ease-in-out">
                                <td class="px-4 sm:px-6 py-3 font-semibold text-gray-800">{{ $index + 1 }}</td>

                                {{-- 📸 PHOTO COLUMN (Properly Aligned) --}}
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                                    <div class="h-10 w-10 flex-shrink-0 overflow-hidden rounded-full border border-gray-300 shadow-sm">
                                        @if ($lawyer->photo)
                                            {{-- Display the uploaded photo --}}
                                            <img class="h-full w-full object-cover"
                                                src="{{ asset('storage/' . $lawyer->photo) }}"
                                                alt="{{ $lawyer->first_name }} Photo">
                                        @else
                                            {{-- Display initial placeholder with background gradient --}}
                                            <div class="h-full w-full bg-gradient-to-r from-[#3b82f6] to-[#60a5fa] flex items-center justify-center text-white font-bold text-sm">
                                                {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                            </div>
                                        @endif
                                    </div>
                                </td>

                                {{-- Name Column (Moved content to next column) --}}
                                <td class="px-4 sm:px-6 py-3 whitespace-nowrap">
                                    <div class="truncate">
                                        <div class="font-semibold text-gray-900 tracking-wide truncate">
                                            {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-4 sm:px-6 py-3 truncate">{{ $lawyer->email ?? '-' }}</td>
                                <td class="px-4 sm:px-6 py-3 truncate">{{ $lawyer->address ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 sm:px-6 py-10 text-center text-gray-500">
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
            <div class="mt-8 flex justify-center">
                {{ $panelLawyers->links('pagination::tailwind') }}
            </div>
        @endif
    </section>

    @include('homepage.layouts.footer')
</body>

</html>
