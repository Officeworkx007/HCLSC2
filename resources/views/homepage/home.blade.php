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

    <section class="relative w-full h-[560px] bg-white">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-stretch h-full">

            <!-- Left Section -->
            <div class="w-full md:w-1/2 flex flex-col justify-center px-10 md:px-16 py-12">
                <h2 class="text-4xl font-bold text-[#1E3A5F] leading-snug">
                    Mediation for the Nation
                </h2>
                <p class="mt-4 text-lg text-[#1E3A5F]/80 max-w-md">
                    Because every dispute deserves a fair, timely, and peaceful solution.
                </p>
                <button
                    class="mt-6 bg-[#A52A2A] text-white text-sm font-semibold px-5 py-2 rounded-full shadow hover:bg-[#8B0000] transition">
                    Read More
                </button>
            </div>

            <!-- Right Section (Announcements) -->
            <div class="w-full md:w-1/2 flex justify-end">
                <div class="flex flex-col items-start w-full md:w-[90%] lg:w-[75%] mt-4 pl-32">
                    <h3 class="text-xl font-bold text-[#1E3A5F] mb-4 ml-24">Announcements</h3>

                    <div class="relative announcement-wrapper">
                        <!-- Vertical Line -->
                        <div class="absolute left-4 top-0 bottom-0 w-[2px] bg-gray-300"></div>

                        <!-- Dynamic Notices -->
                        <ul class="announcement-list">
                            @forelse($notices as $notice)
                                <li class="relative pl-12 pb-6 border-b border-gray-200">
                                    <span
                                        class="absolute left-2 top-2 w-4 h-4 rounded-full bg-[#A52A2A] border-2 border-white"></span>

                                    <a href="{{ route('homepage.notice') }}"
                                        class="text-gray-700 hover:underline block">
                                        {{ Str::limit($notice->description, 80) }}
                                    </a>

                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($notice->notice_date)->format('d-m-Y') }}
                                    </span>
                                </li>
                            @empty
                                <li class="pl-12 text-gray-500">No active announcements.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Help Section -->
    <section class="relative bg-blue-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-10 text-center">How We Can Help</h2>

            <!-- Cards Grid (equal sizes like San Jose site) -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6 text-center">

                <!-- Card 1 -->
                <div
                    class="group bg-blue-900 rounded-lg flex flex-col justify-center items-center py-10 transition duration-300 hover:bg-white">
                    <i data-feather="file-text"
                        class="w-10 h-10 mb-4 text-[#FFD700] transition duration-300 group-hover:text-black"></i>
                    <h3
                        class="font-semibold text-lg mb-2 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Eligibility & Services
                    </h3>
                    <p
                        class="text-sm px-4 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Free legal services including advice, drafting, representation, and court fee coverage.
                    </p>
                </div>

                <!-- Card 2 -->
                <div
                    class="group bg-blue-900 rounded-lg flex flex-col justify-center items-center py-10 transition duration-300 hover:bg-white">
                    <i data-feather="users"
                        class="w-10 h-10 mb-4 text-[#FFD700] transition duration-300 group-hover:text-black"></i>
                    <h3
                        class="font-semibold text-lg mb-2 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Lok Adalats
                    </h3>
                    <p
                        class="text-sm px-4 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Organizes Lok Adalats for settlement of pending and pre-litigation disputes.
                    </p>
                </div>

                <!-- Card 3 -->
                <div
                    class="group bg-blue-900 rounded-lg flex flex-col justify-center items-center py-10 transition duration-300 hover:bg-white">
                    <i data-feather="book-open"
                        class="w-10 h-10 mb-4 text-[#FFD700] transition duration-300 group-hover:text-black"></i>
                    <h3
                        class="font-semibold text-lg mb-2 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Legal Awareness
                    </h3>
                    <p
                        class="text-sm px-4 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Awareness programs, workshops, and campaigns on legal rights and remedies.
                    </p>
                </div>

                <!-- Card 4 -->
                <div
                    class="group bg-blue-900 rounded-lg flex flex-col justify-center items-center py-10 transition duration-300 hover:bg-white">
                    <i data-feather="briefcase"
                        class="w-10 h-10 mb-4 text-[#FFD700] transition duration-300 group-hover:text-black"></i>
                    <h3
                        class="font-semibold text-lg mb-2 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Panel of Advocates
                    </h3>
                    <p
                        class="text-sm px-4 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Maintains a panel of advocates to represent eligible persons before the High Court.
                    </p>
                </div>

                <!-- Card 5 -->
                <div
                    class="group bg-blue-900 rounded-lg flex flex-col justify-center items-center py-10 transition duration-300 hover:bg-white">
                    <i data-feather="user-check"
                        class="w-10 h-10 mb-4 text-[#FFD700] transition duration-300 group-hover:text-black"></i>
                    <h3
                        class="font-semibold text-lg mb-2 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Support for ADR
                    </h3>
                    <p
                        class="text-sm px-4 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Encourages mediation and conciliation for quicker, less adversarial resolution.
                    </p>
                </div>

                <!-- Card 6 -->
                <div
                    class="group bg-blue-900 rounded-lg flex flex-col justify-center items-center py-10 transition duration-300 hover:bg-white">
                    <i data-feather="monitor"
                        class="w-10 h-10 mb-4 text-[#FFD700] transition duration-300 group-hover:text-black"></i>
                    <h3
                        class="font-semibold text-lg mb-2 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Monitoring
                    </h3>
                    <p
                        class="text-sm px-4 text-transparent bg-gradient-to-r from-[#FFD700] via-[#FFEC8B] to-[#DAA520] bg-clip-text transition duration-300 group-hover:text-black group-hover:bg-none">
                        Ensures implementation of legal aid schemes and reports on activities.
                    </p>
                </div>
            </div>
        </div>
    </section>


    <!-- Judges / Testimonials -->
    <section class="bg-gray-50 py-12 justify-items-center mt-[5rem]">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 justify-items-center">

                <!-- Card 1 -->
                <div class="flex flex-col items-center">
                    <article
                        class="relative h-[28rem] w-[22rem] rounded-2xl overflow-hidden shadow-xl ring-1 ring-black/5 transition hover:shadow-2xl">
                        <!-- Background image -->
                        <img src="/images/Chief Justice M Sundar.jpg" alt="Hon'ble Chief Justice M Sundar"
                            class="absolute inset-0 w-full h-full object-contain scale-150">

                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/80"></div>
                    </article>
                    <!-- Content below the card -->
                    <div class="mt-4 text-center">
                        <h3 class="text-gray-900 text-xl font-semibold">Hon'ble Mr. Chief Justice M Sundar</h3>
                        <p class="text-gray-700 text-sm">Judge, High Court of Manipur</p>
                        <p class="text-gray-700 text-sm">Patron-in-Chief, High Court Legal Services Committee</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="flex flex-col items-center">
                    <article
                        class="relative h-[28rem] w-[22rem] rounded-2xl overflow-hidden shadow-xl ring-1 ring-black/5 transition hover:shadow-2xl">
                        <!-- Background image -->
                        <img src="/images/A Bimol Singh.jpg" alt="Hon'ble Mr. Justice A. Bimol Singh"
                            class="absolute inset-0 w-full h-full object-contain scale-110">

                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/80"></div>
                    </article>
                    <!-- Content below the card -->
                    <div class="mt-4 text-center">
                        <h3 class="text-gray-900 text-xl font-semibold">Hon'ble Mr. Justice A. Bimol Singh</h3>
                        <p class="text-gray-700 text-sm">Judge, High Court of Manipur</p>
                        <p class="text-gray-700 text-sm">Executive Chairman, Manipur State Legal Services Authority</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="flex flex-col items-center">
                    <article
                        class="relative h-[28rem] w-[22rem] rounded-2xl overflow-hidden shadow-xl ring-1 ring-black/5 transition hover:shadow-2xl">
                        <img src="/images/Justice A. Guneshwar Sharma.jpg" alt="Hon'ble Justice Name"
                            class="absolute inset-0 w-full h-full object-cover object-top scale-110">
                        <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/80"></div>
                    </article>
                    <div class="mt-4 text-center">
                        <h3 class="text-gray-900 text-xl font-semibold whitespace-nowrap overflow-hidden text-ellipsis">
                            Hon'ble Mr. Justice A. Guneshwar Sharma
                        </h3>
                        <p class="text-gray-700 text-sm">Judge, High Court of Manipur</p>
                        <p class="text-gray-700 text-sm">Chairman, High Court Legal Services Committee</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!--Entitlement to legal aid-->
    <section class="py-12 bg-gray-50 mt-[5rem]">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Heading -->
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-10">Who is entitled to Free Legal Services?
            </h2>
            <!-- Wrapper with arrows -->
            <div class="relative">
                <!-- Left Arrow -->
                <button id="scrollLeft"
                    class="absolute -left-4 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>

                <!-- Scroll Container -->
                <div id="scrollContainer" class="flex overflow-x-auto gap-6 scrollbar-hide scroll-smooth mt-5">

                    <!-- Card 1 -->
                    <div
                        class="min-w-[220px] bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-blue-100 rounded-full mb-4">
                            <span class="text-3xl">🪶</span>
                        </div>
                        <h3 class="font-semibold text-gray-800">Scheduled Caste / Tribe</h3>
                    </div>

                    <!-- Card 2 -->
                    <div
                        class="min-w-[220px] bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-pink-100 rounded-full mb-4">
                            <span class="text-3xl">🚸</span>
                        </div>
                        <h3 class="font-semibold text-gray-800">Victim of Trafficking / Begar</h3>
                    </div>

                    <!-- Card 3 -->
                    <div
                        class="min-w-[220px] shadow-md rounded-xl overflow-hidden flex flex-col items-center text-center">
                        <img src="/images/womenchildren.png" alt="Persons in Custody"
                            class="w-full h-64 object-cover">
                    </div>

                    <!-- Card 4 -->
                    <div
                        class="min-w-[220px] shadow-md rounded-xl overflow-hidden flex flex-col items-center text-center">
                        <img src="/images/mentally.png" alt="Persons in Custody" class="w-full h-64 object-cover">
                    </div>

                    <!-- Card 5 -->
                    <div
                        class="min-w-[220px] shadow-md rounded-xl overflow-hidden flex flex-col items-center text-center">
                        <img src="/images/disaster.png" alt="Persons in Custody" class="w-full h-64 object-cover">
                    </div>

                    <!-- Card 6 -->
                    <div
                        class="min-w-[220px] bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-yellow-100 rounded-full mb-4">
                            <span class="text-3xl">⚒️</span>
                        </div>
                        <h3 class="font-semibold text-gray-800">Industrial Workmen</h3>
                    </div>

                    <!-- Card 7 -->
                    <div
                        class="min-w-[220px] shadow-md rounded-xl overflow-hidden flex flex-col items-center text-center">
                        <img src="/images/custody.png" alt="Persons in Custody" class="w-full h-64 object-cover">
                    </div>

                    <!-- Card 8 -->
                    <div
                        class="min-w-[220px] bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-teal-100 rounded-full mb-4">
                            <span class="text-3xl">💰</span>
                        </div>
                        <h3 class="font-semibold text-gray-800">Income below ₹3,00,000/-</h3>
                    </div>

                    <!-- Card 9 -->
                    <div
                        class="min-w-[220px] bg-white shadow-md rounded-xl p-6 flex flex-col items-center text-center">
                        <div class="w-16 h-16 flex items-center justify-center bg-orange-100 rounded-full mb-4">
                            <span class="text-3xl">🌈</span>
                        </div>
                        <h3 class="font-semibold text-gray-800">Senior Citizens, Transgenders, HIV+</h3>
                    </div>
                </div>

                <!-- Right Arrow -->
                <button id="scrollRight"
                    class="absolute -right-4 top-1/2 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-md hover:bg-gray-100 z-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Apply Section -->
    <section class="py-12 bg-gray-50 mt-[5rem]">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Heading -->
            <h2 class="text-3xl font-bold text-center text-blue-900 mb-10">
                How to Apply for Legal Aid
            </h2>

            <!-- Grid for cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Card 1 -->
                <div
                    class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    <img src="/images/section1.png" alt="Visit website" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-blue-900 text-center">
                            Visit the website www.hclscmanipur.in
                        </h3>
                    </div>
                </div>

                <!-- Card 2 -->
                <div
                    class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    <img src="/images/section2.png" alt="Fill up form" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-blue-900 text-center">
                            Fill up the Legal Aid form under “Apply”
                        </h3>
                    </div>
                </div>

                <!-- Card 3 -->
                <div
                    class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    <img src="/images/section3.png" alt="Track status" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-blue-900 text-center">
                            Track your application using your Form ID
                        </h3>
                    </div>
                </div>

                <!-- Card 4 -->
                <div
                    class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                    <img src="/images/section4.png" alt="Verification" class="w-full h-56 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-blue-900 text-center">
                            HCLSC staff will verify & assign a lawyer
                        </h3>
                    </div>
                </div>
            </div>

            <!-- Button centered below grid -->
            <div class="flex justify-center mt-10">
                <button
                    class="px-8 py-2.5 rounded-md shadow bg-gradient-to-r from-yellow-400 to-yellow-600 text-white font-semibold hover:from-yellow-500 hover:to-yellow-700 transition-all">
                    Read More
                </button>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="py-12 bg-gray-50 mt-[5rem]">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Heading (unchanged) -->
            <div class="text-start mb-12">
                <span class="px-4 py-1 bg-yellow-200 text-gray-800 rounded-full text-xl font-medium">
                    Statistics
                </span>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-10 text-center">

                <!-- Panel Lawyers -->
                <div>
                    <div class="flex justify-center mb-4">
                        <img src="/images/panellawyers.png" alt="Panel Lawyers"
                            class="w-[160px] h-[130px] object-contain">
                    </div>
                    <p class="text-3xl font-bold text-gray-900">23</p>
                    <p class="text-blue-700 font-medium mt-1">Panel Lawyers</p>
                </div>

                <!-- Total Mediations Done -->
                <div>
                    <div class="flex justify-center mb-4">
                        <img src="/images/totalmediations.png" alt="Total Mediations Done"
                            class="w-[160px] h-[130px] object-contain">
                    </div>
                    <p class="text-3xl font-bold text-gray-900">560</p>
                    <p class="text-blue-700 font-medium mt-1">Total Mediations Completed</p>
                </div>

                <!-- Successful Mediations -->
                <div>
                    <div class="flex justify-center mb-4">
                        <img src="/images/successful.png" alt="Successful Mediations"
                            class="w-[160px] h-[130px] object-contain">
                    </div>
                    <p class="text-3xl font-bold text-gray-900">10</p>
                    <p class="text-green-700 font-medium mt-1">Successful Mediations</p>
                </div>

                <!-- Lok Adalats -->
                <div>
                    <div class="flex justify-center mb-4">
                        <img src="/images/adalat.png" alt="Lok Adalat" class="w-[160px] h-[130px] object-contain">
                    </div>
                    <p class="text-3xl font-bold text-gray-900">15</p>
                    <p class="text-purple-700 font-medium mt-1">Lok Adalats</p>
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
