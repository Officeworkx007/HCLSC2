<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>High Court Legal Services Committee, Manipur</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Heroicons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
</head>

<body class="font-sans bg-gray-50">

    @include('homepage.layouts.header')

    <section class="bg-white py-10 flex justify-center">
        <div
            class="relative w-[90%] md:w-[85%] max-w-7xl h-[560px] rounded-xl overflow-hidden shadow-lg flex flex-col md:flex-row bg-gradient-to-r from-[#0A2240] via-[#0F3575] to-[#1E40AF]">

            <div class="md:w-1/2 h-full relative overflow-hidden">
                <img src="/images/coverrr.png" alt="Legal Aid"
                    class="object-cover w-full h-full scale-110 translate-x-2 md:translate-x-4 transition-transform duration-700 ease-in-out" />
            </div>

            <!-- RIGHT: Text Content -->
            <div class="md:w-1/2 flex flex-col justify-center px-8 md:px-12 py-10 text-white">
                <h2 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    EQUAL RIGHTS <br>
                    <span class="text-[#FFD700]">EQUAL JUSTICE!</span></span>
                </h2>

                <p class="text-lg text-gray-200 mb-2">
                    For Speedy Resolutions, Free Legal Assistance | <br>
                    <span class="font-semibold text-[#FFD700]">Lok Adalats</span> for Fair & Quick Justice
                </p>

                <p class="text-gray-300 mb-6">
                    Every voice deserves to be heard. Every right deserves protection !
                </p>

                <a href="{{ route('homepage.legalaid') }}"
                    class="inline-block border-2 border-[#FFD700] text-[#FFD700] font-semibold text-sm px-8 py-3 rounded-md hover:bg-[#FFD700] hover:text-[#0A2240] transition-all duration-300 shadow">
                    SEEK LEGAL ASSISTANCE NOW
                </a>
            </div>

            <!-- Optional: Arrow Buttons (like in the shared design) -->
            <button
                class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white text-[#0A2240] rounded-full p-2 shadow hover:bg-gray-100">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button
                class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white text-[#0A2240] rounded-full p-2 shadow hover:bg-gray-100">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
        </div>
    </section>

    <!-- Help Section -->
    <section class="relative py-20 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('/images/pattern-light.svg')] opacity-10"></div>

        <div class="relative max-w-7xl mx-auto px-6">
            <!-- Heading -->
            <div class="text-center mb-14">
                <h2
                    class="text-4xl font-bold tracking-wide bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text text-transparent">
                    How We Can Help
                </h2>
                <div class="w-24 h-1 bg-[#FFD700] mx-auto mt-3 rounded-full"></div>
                <p class="text-gray-200 max-w-2xl mx-auto mt-4 text-sm md:text-base">
                    We provide comprehensive support and access to justice through various services, programs, and
                    initiatives.
                </p>
            </div>

            <!-- Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8 text-center">

                <!-- Card Template -->
                @php
                    $cards = [
                        [
                            'icon' => 'file-text',
                            'title' => 'Eligibility & Services',
                            'desc' =>
                                'Free legal services including advice, drafting, representation, and court fee coverage.',
                        ],
                        [
                            'icon' => 'users',
                            'title' => 'Lok Adalats',
                            'desc' => 'Organizes Lok Adalats for settlement of pending and pre-litigation disputes.',
                        ],
                        [
                            'icon' => 'book-open',
                            'title' => 'Legal Awareness',
                            'desc' => 'Awareness programs, workshops, and campaigns on legal rights and remedies.',
                        ],
                        [
                            'icon' => 'briefcase',
                            'title' => 'Panel of Advocates',
                            'desc' =>
                                'Maintains a panel of advocates to represent eligible persons before the High Court.',
                        ],
                        [
                            'icon' => 'user-check',
                            'title' => 'Support for ADR',
                            'desc' => 'Encourages mediation and conciliation for quicker, less adversarial resolution.',
                        ],
                        [
                            'icon' => 'monitor',
                            'title' => 'Monitoring',
                            'desc' => 'Ensures implementation of legal aid schemes and reports on activities.',
                        ],
                        [
                            'icon' => 'advocate',
                            'title' => 'Pro Bono Lawyers',
                            'desc' =>
                                'Access to dedicated pro bono lawyers offering voluntary legal support for deserving cases.',
                        ],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div
                        class="group bg-blue-800/30 backdrop-blur-sm border border-blue-400/20 rounded-xl flex flex-col justify-center items-center p-10 transition duration-500 hover:bg-white hover:scale-[1.03] hover:shadow-2xl hover:border-yellow-400">

                        <!-- ICON HANDLING -->
                        @if ($card['icon'] === 'advocate')
                            <!-- Custom Advocate SVG Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-12 h-12 mb-4 text-[#FFD700] transition duration-500 group-hover:text-blue-800"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.7">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm6 10v-1c0-2.76-4-4-6-4s-6 1.24-6 4v1h12z" />
                            </svg>
                        @else
                            <!-- Feather Icon -->
                            <i data-feather="{{ $card['icon'] }}"
                                class="w-12 h-12 mb-4 text-[#FFD700] transition duration-500 group-hover:text-blue-800"></i>
                        @endif

                        <h3
                            class="font-semibold text-lg mb-3 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text group-hover:text-blue-900 group-hover:bg-none transition">
                            {{ $card['title'] }}
                        </h3>
                        <p
                            class="text-sm text-gray-200 group-hover:text-gray-700 transition duration-500 px-3 leading-relaxed">
                            {{ $card['desc'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Judges / Testimonials -->
    <section class="bg-gradient-to-b from-gray-50 to-white py-16 mt-[5rem] flex justify-center">
        <div
            class="max-w-7xl w-full mx-6 p-10 rounded-2xl border border-blue-400 shadow-[0_4px_25px_-5px_rgba(59,130,246,0.3)] bg-white">
            <!-- Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 justify-items-center">

                <!-- Card 1 -->
                <div
                    class="group relative w-[22rem] h-[30rem] rounded-3xl overflow-hidden shadow-xl transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl bg-white/20 backdrop-blur-lg border border-gray-200">
                    <img src="/images/Chief Justice M Sundar.jpg" alt="Hon'ble Chief Justice M Sundar"
                        class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 p-6 text-white text-center">
                        <h3 class="text-xl font-semibold">Hon'ble Mr. Chief Justice M Sundar</h3>
                        <p class="text-sm opacity-90 mt-1">Judge, High Court of Manipur</p>
                        <p class="text-sm opacity-90 mt-1">Patron-in-Chief, Manipur State Legal Services Authority</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="group relative w-[22rem] h-[30rem] rounded-3xl overflow-hidden shadow-xl transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl bg-white/20 backdrop-blur-lg border border-gray-200">
                    <img src="/images/A Bimol Singh.jpg" alt="Hon'ble Mr. Justice A. Bimol Singh"
                        class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 p-6 text-white text-center">
                        <h3 class="text-xl font-semibold">Hon'ble Mr. Justice A. Bimol Singh</h3>
                        <p class="text-sm opacity-90 mt-1">Judge, High Court of Manipur</p>
                        <p class="text-sm opacity-90 mt-1">Executive Chairman, Manipur State Legal Services Authority
                        </p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="group relative w-[22rem] h-[30rem] rounded-3xl overflow-hidden shadow-xl transition-all duration-500 hover:scale-[1.03] hover:shadow-2xl bg-white/20 backdrop-blur-lg border border-gray-200">
                    <img src="/images/Justice A. Guneshwar Sharma.jpg" alt="Hon'ble Mr. Justice A. Guneshwar Sharma"
                        class="absolute inset-0 w-full h-full object-cover object-top transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                    <div class="absolute bottom-0 p-6 text-white text-center">
                        <h3 class="text-xl font-semibold">Hon'ble Mr. Justice A. Guneshwar Sharma</h3>
                        <p class="text-sm opacity-90 mt-1">Judge, High Court of Manipur</p>
                        <p class="text-sm opacity-90 mt-1">Chairman, High Court Legal Services Committee</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Apply Section -->
    <section
        class="relative py-16 bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 text-white overflow-hidden mt-[5rem]">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Heading -->
            <h2 class="text-4xl font-bold text-center mb-10">
                How to Apply for <span class="text-yellow-400">Legal Aid</span>
            </h2>

            <!-- Content layout: Left text + Right steps box -->
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <!-- Left content -->
                <div>
                    <p class="text-lg leading-relaxed mb-6 text-slate-200 indent-4">
                        Applying for legal aid through the High Court Legal Services Committee (HCLSC)
                        is quick and simple. Follow these easy steps to get legal assistance and track your case status
                        easily.
                    </p> <br>
                    <p class="text-lg leading-relaxed mb-6 text-slate-200 indent-4">
                        🏛️ For Offline Submition, Please visit our Front Office at High Court Legal Services Committee,
                        High Court of Manipur, Mantripukhri.
                    </p>
                    <button
                        class="px-8 py-3 bg-gradient-to-r from-yellow-400 to-yellow-600 text-blue-900 font-semibold rounded-md shadow-lg hover:from-yellow-500 hover:to-yellow-700 transition-all">
                        Learn More
                    </button>
                </div>

                <!-- Right floating box with steps -->
                <div
                    class="bg-gradient-to-b from-blue-700 via-blue-800 to-blue-900 rounded-2xl shadow-2xl p-8 lg:translate-x-10">
                    <div class="space-y-8">
                        <!-- Step 1 -->
                        <div class="flex gap-4 items-start">
                            <div class="text-3xl font-bold text-yellow-400">1</div>
                            <p>Visit our official website <span
                                    class="font-semibold text-yellow-400">www.hclscmanipur.in</span></p>
                        </div>

                        <!-- Step 2 -->
                        <div class="flex gap-4 items-start">
                            <div class="text-3xl font-bold text-yellow-400">2</div>
                            <p>Fill up the <span class="font-semibold text-yellow-400">Legal Aid Form</span> under
                                “Apply”.</p>
                        </div>

                        <!-- Step 3 -->
                        <div class="flex gap-4 items-start">
                            <div class="text-3xl font-bold text-yellow-400">3</div>
                            <p>HCLSC staff will verify your details and assign a suitable lawyer.</p>
                        </div>

                        <!-- Step 4 -->
                        <div class="flex gap-4 items-start">
                            <div class="text-3xl font-bold text-yellow-400">4</div>
                            <p>Track your application using your <span class="font-semibold text-yellow-400">Form
                                    ID</span>.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Optional gradient overlay for depth -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent pointer-events-none"></div>
    </section>

    <!-- Floating Beneficiary Categories Section -->
    <section class="relative z-20">
        <div class="max-w-7xl mx-auto px-6 -mt-10 bg-white rounded-2xl shadow-2xl py-10">
            <!-- Heading -->
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-10">
                Beneficiaries Eligible for <span class="text-yellow-500">Free Legal Aid</span>
            </h2>

            <!-- Cards Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-5">

                <!-- Women -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">👩</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Women</p>
                </div>

                <!-- Children -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">👧</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Children</p>
                </div>

                <!-- Persons with disability -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">♿</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Persons with Disability</p>
                </div>

                <!-- Industrial Workmen -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🏭</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Industrial Workmen</p>
                </div>

                <!-- Victims of Disaster -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🌊</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Victims of Disaster / Violence</p>
                </div>

                <!-- Victims of Trafficking -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🚨</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Victims of Trafficking / Beggary</p>
                </div>

                <!-- Persons in Custody -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🚔🧍‍♂️</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Persons in Custody / Homes</p>
                </div>

                <!-- General (Low Income) -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">💰</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">General (Low Income)</p>
                </div>

                <!-- Transgender -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🌈</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Transgender</p>
                </div>

                <!-- Scheduled Caste -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">⚖️</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Scheduled Caste</p>
                </div>

                <!-- Scheduled Tribe -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">🌿</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Scheduled Tribe</p>
                </div>

                <!-- Senior Citizens -->
                <div
                    class="flex flex-col items-center p-4 bg-yellow-400 rounded-xl shadow-md hover:shadow-lg transition">
                    <div class="text-3xl mb-2">👴</div>
                    <p class="text-sm font-semibold text-blue-900 text-center">Senior Citizens</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="relative bg-white py-16 mt-20 shadow-sm overflow-hidden">
        <!-- Optional Background Illustration (light city-like background effect) -->
        <div class="absolute inset-0 opacity-10 bg-[url('/images/statcard.png')] bg-center bg-cover"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <!-- Heading -->
            <div class="text-center mb-12">
                <span class="px-6 py-2 bg-yellow-200 text-gray-800 rounded-full text-xl font-semibold">
                    Statistics
                </span>
            </div>

            <!-- Stats Row -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-12 text-center">

                <!-- Panel Lawyers -->
                <div class="flex flex-col items-center">
                    <img src="/images/panellawyers.png" alt="Panel Lawyers"
                        class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">23</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Panel Lawyers</p>
                </div>

                <!-- Total Mediations Done -->
                <div class="flex flex-col items-center">
                    <img src="/images/totalmediations.png" alt="Total Mediations"
                        class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">566</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Mediations Completed</p>
                </div>

                <!-- Successful Mediations -->
                <div class="flex flex-col items-center">
                    <img src="/images/successful.png" alt="Successful Mediations"
                        class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">50</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Successful Mediations</p>
                </div>

                <!-- Lok Adalats -->
                <div class="flex flex-col items-center">
                    <img src="/images/adalat.png" alt="Lok Adalat" class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">3 (2025)</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Lok Adalats</p>
                </div>

                <!-- Mediators -->
                <div class="flex flex-col items-center">
                    <img src="/images/mediators.png" alt="Mediators" class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">22</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Mediators</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Calendar Section -->
    <section class="py-16 bg-[#00476E] text-white">
        <div class="container mx-auto px-4 max-w-7xl relative z-10">

            <h2 class="text-4xl font-bold text-center mb-10 tracking-wider">
                CALENDAR
            </h2>
            <div class="w-16 h-1 bg-[#FFD700] mx-auto mb-10"></div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

                <div class="md:col-span-2 p-4 bg-[#003350] rounded-xl shadow-2xl">
                    <div id="defaultCalendar" class="p-4">

                        <div class="flex justify-center items-center mb-6">
                            <button id="prevMonth"
                                class="text-3xl font-bold text-white hover:text-yellow-400 transition mr-6">
                                <i class="fa-solid fa-chevron-left"></i>
                            </button>
                            <h3 id="currentMonthYear"
                                class="text-3xl font-extrabold text-[#FFD700] tracking-widest text-center uppercase min-w-[200px]">
                            </h3>
                            <button id="nextMonth"
                                class="text-3xl font-bold text-white hover:text-yellow-400 transition ml-6">
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </div>

                        <div class="grid grid-cols-7 text-center text-lg font-bold text-white uppercase mb-4 gap-1">
                            <span>S</span>
                            <span>M</span>
                            <span>T</span>
                            <span>W</span>
                            <span>T</span>
                            <span>F</span>
                            <span>S</span>
                        </div>

                        <div id="calendarDates" class="grid grid-cols-7 gap-1">
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1 p-6 max-h-[520px] overflow-y-auto scrollbar-hide">

                    <h3 class="text-3xl font-light mb-8 text-white tracking-wider">OCT</h3>

                    <div class="space-y-6">
                        @if (isset($events) && count($events) > 0)
                            @foreach ($events as $event)
                                <div class="flex items-start">
                                    <div class="text-center mr-4 pt-1 flex-shrink-0">
                                        <p class="text-xl font-bold text-yellow-400 leading-none">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('OCT') }}
                                        </p>
                                        <p class="text-5xl font-extrabold text-white leading-none">
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('d') }}
                                        </p>
                                    </div>
                                    <div class="pt-2 border-b border-gray-600/50 w-full pb-4">
                                        <p class="text-lg font-semibold text-white leading-snug">
                                            {{ $event->title }}
                                        </p>
                                        <p class="text-base text-yellow-400 mt-1">
                                            {{-- Assuming you have a time field, otherwise use a placeholder --}}
                                            {{ \Carbon\Carbon::parse($event->start_date)->format('h:i A') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center text-gray-400 py-10">
                                <i class="fa-regular fa-calendar-alt text-4xl mb-3"></i>
                                <p>No upcoming events scheduled.</p>
                                <a href="#"
                                    class="mt-4 inline-block px-4 py-2 bg-yellow-400 text-blue-900 font-semibold rounded text-sm">
                                    FULL CALENDAR >
                                </a>
                            </div>
                        @endif
                    </div>

                    <div class="text-right mt-8">
                        <a href="#"
                            class="px-6 py-3 bg-yellow-400 text-blue-900 font-semibold rounded text-sm hover:bg-yellow-500 transition shadow-lg">
                            FULL CALENDAR >
                        </a>
                    </div>

                </div>

            </div>
        </div>
    </section>

    @include('homepage.layouts.footer')

    <script>
        feather.replace()
    </script>

    <!-- FullCalendar (CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        const scrollContainer = document.getElementById('scrollContainer');
        document.getElementById('scrollLeft').addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: -250,
                behavior: 'smooth'
            });
        });
        document.getElementById('scrollRight').addEventListener('click', () => {
            scrollContainer.scrollBy({
                left: 250,
                behavior: 'smooth'
            });
        });

        // Announcement list
        const list = document.querySelector('.announcement-list');
        if (list && list.children.length >= 5) {
            list.innerHTML += list.innerHTML;
        }

        //Drop down code
        document.addEventListener("DOMContentLoaded", function() {
            const btn = document.getElementById("apply-btn");
            const menu = document.getElementById("dropdown");

            if (!btn || !menu) return;

            btn.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
                menu.classList.toggle("hidden"); // toggle dropdown
            });

            // Close dropdown if clicked outside
            document.addEventListener("click", function(event) {
                if (!btn.contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add("hidden");
                }
            });
        });

        // --- CALENDAR SCRIPT ---
        document.addEventListener("DOMContentLoaded", function() {

            // ... Existing drop-down, scroll-related code here ...

            // --- CALENDAR LOGIC (Designed for Screenshot Style) ---
            const calendarDates = document.getElementById('calendarDates');
            const currentMonthYear = document.getElementById('currentMonthYear');
            const prevMonthButton = document.getElementById('prevMonth');
            const nextMonthButton = document.getElementById('nextMonth');

            let currentDate = new Date(); // Start with current month

            // Hardcoded example event dates for visual testing (use your live $events data)
            const exampleEventDates = [
                '2025-10-08',
                '2025-10-15',
                '2025-10-22',
            ];

            function renderCalendar(date) {
                calendarDates.innerHTML = '';
                const year = date.getFullYear();
                const month = date.getMonth();

                // Format to match the screenshot: "OCTOBER 2025"
                currentMonthYear.textContent = date.toLocaleDateString('en-US', {
                    month: 'long',
                    year: 'numeric'
                });

                // Get day of the week for the first day of the month (0=Sun, 6=Sat)
                const firstDayOfMonth = new Date(year, month, 1).getDay();
                // Get the number of days in the month
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                // Assuming $events is passed from Laravel, map their dates
                var events = @json($events ?? []);
                var eventDates = events.map(ev => ev.start_date.slice(0, 10));

                // Use the example dates if no live events are present for testing the highlight
                if (eventDates.length === 0 && year === 2025 && month === 9) { // Oct 2025
                    eventDates = exampleEventDates;
                }


                function hasEvent(day, month, year) {
                    const dateString =
                        `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                    return eventDates.includes(dateString);
                }

                // --- Padding (Previous Month's Days) ---
                const prevMonthLastDay = new Date(year, month, 0).getDate();
                for (let i = firstDayOfMonth - 1; i >= 0; i--) {
                    const day = prevMonthLastDay - i;
                    const cell = document.createElement('div');
                    cell.classList.add(
                        'p-3', 'text-center', 'aspect-square', 'flex', 'items-center',
                        'justify-center', 'font-medium', 'text-lg',
                        'bg-[#003350]', 'text-white/30' // Dark background, faded text
                    );
                    cell.textContent = day;
                    calendarDates.appendChild(cell);
                }


                // --- Current Month's Days ---
                const today = new Date();
                for (let day = 1; day <= daysInMonth; day++) {
                    const cell = document.createElement('div');
                    cell.classList.add(
                        'p-3', 'text-center', 'aspect-square', 'flex', 'items-center',
                        'justify-center', 'cursor-pointer', 'font-medium', 'text-lg',
                        'bg-white', 'text-black' // Base style: White cell, Black text
                    );
                    cell.textContent = day;

                    // Highlight Logic
                    const isToday = (day === today.getDate() && month === today.getMonth() && year === today
                        .getFullYear());
                    const isEventDay = hasEvent(day, month, year);

                    if (isEventDay) {
                        // Screenshot Event Day Style: Yellow background, Black text
                        cell.classList.add('bg-[#FFD700]', 'text-black', 'font-bold');
                        cell.classList.remove('bg-white'); // Remove base white
                    }

                    // Hover style (optional, but good UX)
                    cell.classList.add('hover:bg-gray-200');

                    calendarDates.appendChild(cell);
                }

                // --- Padding (Next Month's Days) ---
                const totalCells = firstDayOfMonth + daysInMonth;
                const remainingCells = 42 - totalCells; // Max 6 rows * 7 days

                for (let day = 1; day <= remainingCells && day <= 7; day++) {
                    const cell = document.createElement('div');
                    cell.classList.add(
                        'p-3', 'text-center', 'aspect-square', 'flex', 'items-center',
                        'justify-center', 'font-medium', 'text-lg',
                        'bg-[#003350]', 'text-white/30' // Dark background, faded text
                    );
                    cell.textContent = day;
                    calendarDates.appendChild(cell);
                }
            }

            renderCalendar(currentDate);

            // Event listeners for month navigation
            prevMonthButton.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar(currentDate);
            });

            nextMonthButton.addEventListener('click', () => {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar(currentDate);
            });
        });
    </script>

    <!-- Tailwind helper to hide scrollbar -->
    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .announcement-wrapper {
            position: relative;
            height: 420px;
            overflow: hidden;
        }

        .announcement-wrapper::before,
        .announcement-wrapper::after {
            content: "";
            position: absolute;
            left: 0;
            right: 0;
            height: 32px;
            pointer-events: none;
            z-index: 5;
        }

        .announcement-wrapper::before {
            top: 0;
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0));
        }

        .announcement-wrapper::after {
            bottom: 0;
            background: linear-gradient(to top, rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0));
        }

        /* Correct bottom-to-top scroll loop */
        @keyframes scroll-up {
            0% {
                transform: translateY(100%);
            }

            100% {
                transform: translateY(-100%);
            }
        }

        .announcement-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            will-change: transform;
            animation: scroll-up 12s linear infinite;
            transform: translateY(100%);
            /* start from bottom */
        }

        /* Pause on hover */
        .announcement-wrapper:hover .announcement-list {
            animation-play-state: paused;
        }

        #calendar {
            min-height: 400px !important;
        }
    </style>
</body>

</html>
