@php
    $token = session('token_number');
@endphp

<!-- HEADER -->
<header class="bg-white shadow-md sticky top-0 z-50">

    <!-- Top Section -->
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        <!-- Left: Logo + Title -->
        <div class="flex items-center gap-4">
            <img src="/images/hc logo.jpg" alt="High Court of Manipur logo" class="h-20 w-auto rounded-md shadow-sm">
            <div>
                <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 bg-clip-text text-transparent inline-block">
                    High Court Legal Services Committee
                </h1>
                <p class="text-md font-semibold text-black">High Court of Manipur, Mantripukhri</p>
            </div>
        </div>

        <!-- Right: Buttons -->
        <div class="hidden md:flex items-center gap-3">
            <a href="#"
                class="bg-white border border-[#FFD700] text-black text-sm font-bold px-5 py-2 rounded-full shadow-sm hover:bg-[#FFD700] hover:text-[#0B2447] transition">
                Login
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuToggle" class="md:hidden text-[#0B2447] focus:outline-none">
            <i class="fa-solid fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- NAVBAR -->
    <nav class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 text-white font-medium text-[15px] md:flex md:items-center md:justify-center md:space-x-8 py-3 hidden transition-all duration-300"
        id="navMenu">

        <a href="{{ route('homepage.home') }}" class="hover:text-[#FFD700] transition">Home</a>

        <!-- ABOUT US DROPDOWN -->
        <div class="relative group">
            <button type="button" class="flex items-center hover:text-[#FFD700] focus:outline-none transition">
                About Us
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>

            <!-- Dropdown -->
            <div
                class="absolute left-0 mt-2 w-64 bg-[#102C57] text-white rounded-lg shadow-lg border border-[#1D4ED8] opacity-0 scale-y-0 origin-top transform transition-all duration-300 ease-out group-hover:opacity-100 group-hover:scale-y-100 overflow-hidden">

                <a href="{{ route('homepage.intro') }}" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">High Court Legal Services
                    Committee</a>
                <div class="border-t border-[#1D4ED8]"></div>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Advisory Board</a>
                <div class="border-t border-[#1D4ED8]"></div>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Members</a>
            </div>
        </div>

        <a href="{{ route('homepage.lawyers') }}" class="hover:text-[#FFD700] transition">Panel Lawyers</a>
        <a href="#" class="hover:text-[#FFD700] transition">Gallery</a>
        <a href="#" class="hover:text-[#FFD700] transition">National Lok Adalat</a>
        <a href="#" class="hover:text-[#FFD700] transition">Mediation</a>
        <a href="{{ route('homepage.notice') }}" class="hover:text-[#FFD700] transition">Notice Board</a>

        <!-- APPLY DROPDOWN -->
        <div class="relative group">
            <button type="button" class="flex items-center hover:text-[#FFD700] focus:outline-none transition">
                Apply
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>

            <!-- Dropdown -->
            <div
                class="absolute left-0 mt-2 w-56 bg-[#102C57] text-white rounded-lg shadow-lg border border-[#FFD700]/20 opacity-0 scale-y-0 origin-top transform transition-all duration-300 ease-out group-hover:opacity-100 group-hover:scale-y-100 overflow-hidden">

                <a href="{{ route('homepage.legalaid') }}"
                    class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Legal Aid</a>
                <div class="border-t border-[#1D4ED8]"></div>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Panel Lawyer</a>
                <div class="border-t border-[#1D4ED8]"></div>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Mediation</a>
            </div>
        </div>

        <a href="{{ route('homepage.track') }}" class="hover:text-[#FFD700] transition">Track your Form</a>
        <a href="#" class="hover:text-[#FFD700] transition">Guidelines</a>
        <a href="{{ route('homepage.contactus') }}" class="hover:text-[#FFD700] transition">Contact Us</a>
    </nav>

    <!-- MOBILE MENU -->
    <div id="mobileDropdown"
        class="md:hidden bg-[#0B2447] text-white text-sm flex-col hidden px-6 py-3 space-y-2 border-t border-[#FFD700]/20">

        <a href="{{ route('homepage.home') }}" class="block hover:text-[#FFD700]">Home</a>

        <!-- About Us Dropdown -->
        <div class="relative">
            <button type="button"
                class="flex items-center justify-between w-full hover:text-[#FFD700] focus:outline-none transition dropdown-toggle">
                About Us
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>
            <div class="hidden flex-col mt-1 bg-[#102C57] rounded-lg">
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">High Court Legal Services Committee</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">Advisory Board</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">Members</a>
            </div>
        </div>

        <a href="#" class="block hover:text-[#FFD700]">Panel Lawyers</a>
        <a href="#" class="block hover:text-[#FFD700]">Services</a>
        <a href="#" class="block hover:text-[#FFD700]">Gallery</a>
        <a href="#" class="block hover:text-[#FFD700]">National Lok Adalat</a>
        <a href="#" class="block hover:text-[#FFD700]">Mediation</a>
        <a href="{{ route('homepage.notice') }}" class="block hover:text-[#FFD700]">Notice Board</a>

        <!-- Apply Dropdown -->
        <div class="relative">
            <button type="button"
                class="flex items-center justify-between w-full hover:text-[#FFD700] focus:outline-none transition dropdown-toggle">
                Apply
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>
            <div class="hidden flex-col mt-1 bg-[#102C57] rounded-lg">
                <a href="{{ route('homepage.legalaid') }}" class="block px-4 py-2 hover:bg-[#FFD700]/10">Legal Aid</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">Panel Lawyer</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">Mediation</a>
            </div>
        </div>

        <a href="{{ route('homepage.track') }}" class="block hover:text-[#FFD700]">Track your Form</a>
        <a href="#" class="block hover:text-[#FFD700]">Guidelines</a>
        <a href="{{ route('homepage.contactus') }}" class="block hover:text-[#FFD700]">Contact Us</a>
    </div>
</header>

<!-- JS -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mobileToggle = document.getElementById("mobileMenuToggle");
        const navMenu = document.getElementById("navMenu");
        const mobileDropdown = document.getElementById("mobileDropdown");
        const dropdownToggles = mobileDropdown.querySelectorAll(".dropdown-toggle");

        // Toggle main mobile menu
        mobileToggle.addEventListener("click", () => {
            navMenu.classList.toggle("hidden");
            mobileDropdown.classList.toggle("hidden");
        });

        // Mobile dropdown open/close
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener("click", () => {
                const menu = toggle.nextElementSibling;
                menu.classList.toggle("hidden");
            });
        });
    });
</script>
