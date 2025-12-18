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

    <!-- FullCalendar (required) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.css">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js"></script>

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

                <!-- Card 2 -->
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

    <!-- Public Events Calendar Section -->
    <section class="relative bg-gray-50 py-20 mt-20">
        <div class="max-w-7xl mx-auto px-6">

            <!-- Heading -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-blue-900">
                    Events & Activities
                </h2>
                <div class="w-28 h-1 bg-yellow-400 mx-auto mt-3 rounded-full"></div>
                <p class="text-gray-600 mt-4 text-sm md:text-base">
                    Monthly schedule of Lok Adalats, legal awareness programs and other activities.
                </p>
            </div>

            <!-- Calendar + Events Layout -->
            <div class="bg-white rounded-2xl shadow-xl border border-gray-200 p-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-start">

                    <!-- LEFT: Calendar -->
                    <div>
                        <div class="rounded-xl border border-blue-200 shadow-sm p-4">
                            <div id="public-calendar"></div>
                        </div>
                    </div>

                    <!-- RIGHT: Events -->
                    <div>
                        <h3 class="text-xl font-semibold text-blue-900 mb-4">
                            Events in <span id="current-month-text"></span>
                        </h3>

                        <div id="monthly-events" class="space-y-4">
                            <p class="text-gray-500 text-sm">Loading events...</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('homepage.layouts.footer')

    <script src="fullcalendar.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const calendarEl = document.getElementById('public-calendar');
            const eventsContainer = document.getElementById('monthly-events');
            const monthText = document.getElementById('current-month-text');

            function formatMonthYear(date) {
                return date.toLocaleString('default', {
                    month: 'long',
                    year: 'numeric'
                });
            }

            function loadMonthlyEvents(year, month) {
                eventsContainer.innerHTML = '';

                fetch(`{{ route('homepage.calendar.month') }}?year=${year}&month=${month}`)
                    .then(res => res.json())
                    .then(data => {

                        if (!data.length) {
                            eventsContainer.innerHTML =
                                `<p class="text-red-500 text-sm">No events scheduled for this month.</p>`;
                            return;
                        }

                        const MAX_EVENTS = 5;

                        data.slice(0, MAX_EVENTS).forEach((event, index) => {

                            let colorClass = 'bg-blue-50 border-blue-700';
                            let badgeClass = 'bg-blue-800';

                            if (event.event_type === 'restricted_holiday') {
                                colorClass = 'bg-green-50 border-green-700';
                                badgeClass = 'bg-green-700';
                            }

                            if (event.event_type === 'general_holiday') {
                                colorClass = 'bg-red-50 border-red-700';
                                badgeClass = 'bg-red-700';
                            }

                            eventsContainer.innerHTML += `
                        <div class="flex gap-4 ${colorClass} border-l-4 rounded-lg p-4 shadow-sm">

                            <div class="w-8 h-8 flex items-center justify-center
                                rounded-full ${badgeClass} text-white font-bold">
                                ${index + 1}
                            </div>

                            <div>
                                <p class="text-sm font-semibold mb-1">
                                    ${event.date}
                                </p>
                                <h4 class="text-base font-semibold text-gray-800">
                                    ${event.title}
                                </h4>
                                ${event.description ? `
                                        <p class="text-sm text-gray-600 mt-1">
                                            ${event.description}
                                        </p>` : ''}
                            </div>

                        </div>
                    `;
                        });

                        if (data.length > MAX_EVENTS) {
                            eventsContainer.innerHTML += `
                        <div class="pt-4">
                            <a href=""
                               class="inline-flex items-center gap-2 px-5 py-2.5
                                      bg-blue-800 text-white text-sm font-semibold
                                      rounded-md hover:bg-blue-900 transition">
                                <i class="fa-solid fa-calendar-days"></i>
                                Full Calendar
                            </a>
                        </div>
                    `;
                        }
                    });
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                fixedWeekCount: false,
                showNonCurrentDates: true,
                selectable: false,
                editable: false,
                navLinks: false,
                dayMaxEvents: 2,

                headerToolbar: {
                    left: 'prev',
                    center: 'title',
                    right: 'next'
                },

                events: `{{ route('homepage.calendar.events') }}`,

                datesSet: function(info) {
                    const date = info.view.currentStart;
                    monthText.innerText = formatMonthYear(date);
                    loadMonthlyEvents(date.getFullYear(), date.getMonth() + 1);
                },

                dayCellDidMount: function(info) {

                    const dateStr = info.date.toISOString().split('T')[0];
                    const day = info.date.getDay();
                    const numberEl = info.el.querySelector('.fc-daygrid-day-number');

                    if (!numberEl) return;

                    numberEl.style.fontWeight = '700';
                    numberEl.style.color = '#000';

                    // Weekend
                    if (day === 0 || day === 6) {
                        numberEl.style.color = '#facc15';
                    }

                    // Event-based coloring
                    calendar.getEvents().forEach(ev => {
                        if (ev.startStr === dateStr) {

                            if (ev.extendedProps.event_type === 'event') {
                                numberEl.style.color = '#2563eb';
                            }

                            if (ev.extendedProps.event_type === 'restricted_holiday') {
                                numberEl.style.color = '#16a34a';
                            }

                            if (ev.extendedProps.event_type === 'general_holiday') {
                                numberEl.style.color = '#dc2626';
                            }
                        }
                    });
                }
            });

            calendar.render();
        });
    </script>

    <style>
        /* Calendar container */
        #public-calendar {
            background: #ffffff;
            border-radius: 12px;
        }

        /* Header */
        .fc-toolbar-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #1e3a8a;
        }

        /* Buttons */
        .fc-button {
            background-color: #1e40af !important;
            border: none !important;
            box-shadow: none !important;
            padding: 6px 12px !important;
        }

        .fc-button:hover {
            background-color: #1e3a8a !important;
        }

        /* Remove internal scrollbars */
        .fc-scroller {
            overflow: visible !important;
        }

        /* Day headers */
        .fc-col-header-cell {
            background: #f1f5f9;
            font-weight: 600;
            font-size: 0.9rem;
            color: #334155;
            padding: 6px 0;
        }

        /* Day cells */
        .fc-daygrid-day {
            border: 1px solid #e5e7eb;
        }

        /* Date number */
        .fc-daygrid-day-number {
            font-size: 0.85rem;
        }

        /* Today */
        .fc-day-today {
            background-color: #eff6ff !important;
        }

        /* Remove focus outline */
        .fc-button:focus {
            box-shadow: none !important;
        }
    </style>
