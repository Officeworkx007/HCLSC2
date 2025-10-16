<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Panel Lawyers | HCLSC</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-b from-[#f5f7fa] to-[#e6ebff] text-gray-800 font-sans antialiased">
    <!-- @include('homepage.layouts.header') -->

    <section class="max-w-7xl mx-auto px-6 py-16">
        <!-- Page Header -->
        <div class="text-center mb-14">
            <h1 class="text-4xl md:text-5xl font-extrabold text-[#1e3a8a] mb-4">
                Our <span class="text-[#2563eb]">Panel Lawyers</span>
            </h1>
            <p class="text-gray-600 text-base md:text-lg max-w-2xl mx-auto">
                 Meet our dedicated panel of lawyers committed to providing access to justice without barriers.
            </p>
        </div>

        <!-- Modern Card Table Container -->
        <div class="overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.12)] rounded-2xl backdrop-blur-lg bg-white/70 border border-white/40">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm text-left text-gray-700">
                    <thead class="bg-[#e0e7ff]/60 backdrop-blur-sm">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-[#1e3a8a]">#</th>
                            <th class="px-6 py-4 font-semibold text-[#1e3a8a]">Name</th>
                            <th class="px-6 py-4 font-semibold text-[#1e3a8a]">Email</th>
                            <th class="px-6 py-4 font-semibold text-[#1e3a8a]">Phone</th>
                            <th class="px-6 py-4 font-semibold text-[#1e3a8a]">Address</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100/70">
                        @forelse ($panelLawyers as $index => $lawyer)
                            <tr class="hover:bg-[#eef2ff] transition-all duration-300 ease-in-out">
                                <td class="px-6 py-4 font-semibold text-gray-800">{{ $index + 1 }}</td>

                                <td class="px-6 py-4 whitespace-nowrap flex items-center gap-3">
                                    <div
                                        class="h-10 w-10 flex items-center justify-center rounded-full bg-gradient-to-r from-[#3b82f6] to-[#60a5fa] text-white font-bold shadow-md">
                                        {{ strtoupper(substr($lawyer->first_name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-gray-900 tracking-wide">
                                            {{ $lawyer->first_name }} {{ $lawyer->last_name }}
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4">{{ $lawyer->email ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $lawyer->phone_number ?? '-' }}</td>
                                <td class="px-6 py-4">{{ $lawyer->address ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fa-solid fa-scale-balanced text-4xl text-gray-400 mb-3"></i>
                                        <p>No panel lawyers available at the moment.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Optional: Add subtle pagination -->
        @if ($panelLawyers instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="mt-8 flex justify-center">
                {{ $panelLawyers->links('pagination::tailwind') }}
            </div>
        @endif
    </section>

    @include('homepage.layouts.footer')
</body>

</html>
