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
        <!-- Optional subtle graphic -->

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
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div
                        class="group bg-blue-800/30 backdrop-blur-sm border border-blue-400/20 rounded-xl flex flex-col justify-center items-center p-10 transition duration-500 hover:bg-white hover:scale-[1.03] hover:shadow-2xl hover:border-yellow-400">
                        <i data-feather="{{ $card['icon'] }}"
                            class="w-12 h-12 mb-4 text-[#FFD700] transition duration-500 group-hover:text-blue-800"></i>
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
                    <div class="text-3xl mb-2">🏥</div>
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
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12 text-center">

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
                    <p class="text-5xl font-extrabold text-green-600">560</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Mediations Completed</p>
                </div>

                <!-- Successful Mediations -->
                <div class="flex flex-col items-center">
                    <img src="/images/successful.png" alt="Successful Mediations"
                        class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">10</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Successful Mediations</p>
                </div>

                <!-- Lok Adalats -->
                <div class="flex flex-col items-center">
                    <img src="/images/adalat.png" alt="Lok Adalat" class="w-[170px] h-[140px] mb-6 object-contain">
                    <p class="text-5xl font-extrabold text-green-600">3 (2025)</p>
                    <p class="text-gray-700 tracking-wide uppercase text-sm mt-1 font-medium">Lok Adalats</p>
                </div>

            </div>
        </div>
    </section>

    @include('homepage.layouts.footer')

    <script>
        feather.replace()
    </script>
    <!-- Small helper JS -->
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
    </style>
</body>

</html>
