@php
    $token = session('token_number');
@endphp

<!-- HEADER -->
<header class="bg-white shadow-md sticky top-0 z-50 border-b border-gray-100">

    <!-- Top Section -->
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        <!-- Left: Logo + Title -->
        <div class="flex items-center gap-4">
            <img src="/images/hc logo.jpg" alt="High Court of Manipur logo" class="h-20 w-auto rounded-md shadow-sm">
            <div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-[#0B2447] tracking-tight">
                    High Court Legal Services Committee
                </h1>
                <p class="text-sm text-gray-600">High Court of Manipur, Mantripukhri</p>
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
    <nav class="bg-[#0B2447] text-white font-medium text-[15px] md:flex md:items-center md:justify-center md:space-x-8 py-3 hidden transition-all duration-300"
        id="navMenu">

        <a href="{{ route('homepage.home') }}" class="hover:text-[#FFD700] transition">Home</a>
        <a href="#" class="hover:text-[#FFD700] transition">About Us</a>
        <a href="#" class="hover:text-[#FFD700] transition">Panel Lawyers</a>
        <a href="#" class="hover:text-[#FFD700] transition">Services</a>
        <a href="#" class="hover:text-[#FFD700] transition">Gallery</a>
        <a href="#" class="hover:text-[#FFD700] transition">National Lok Adalat</a>
        <a href="#" class="hover:text-[#FFD700] transition">Mediation</a>
        <a href="{{ route('homepage.notice') }}" class="hover:text-[#FFD700] transition">Notice Board</a>

        <!-- Dropdown -->
        <div class="relative">
            <button type="button"
                class="flex items-center hover:text-[#FFD700] focus:outline-none transition dropdown-toggle">
                Apply
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>

            <!-- Dropdown Menu -->
            <div
                class="absolute left-0 mt-2 w-48 bg-[#102C57] text-white rounded-lg shadow-lg border border-[#FFD700]/20 opacity-0 invisible transition-all duration-200 ease-out dropdown-menu">
                <a href="{{ route('homepage.legalaid') }}" class="block px-4 py-2 hover:bg-[#FFD700]/10">Legal Aid</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">Panel Lawyer</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#FFD700]/10">Mediation</a>
            </div>
        </div>

        <a href="{{ route('homepage.track') }}" class="hover:text-[#FFD700] transition">Track your Form</a>
        <a href="#" class="hover:text-[#FFD700] transition">Guidelines</a>
        <a href="{{ route('homepage.contactus') }}" class="hover:text-[#FFD700] transition">Contact Us</a>
    </nav>

    <!-- Mobile Dropdown Menu -->
    <div id="mobileDropdown" class="md:hidden bg-[#0B2447] text-white text-sm flex-col hidden px-6 py-3 space-y-2">
        <a href="{{ route('homepage.home') }}" class="block hover:text-[#FFD700]">Home</a>
        <a href="#" class="block hover:text-[#FFD700]">About Us</a>
        <a href="#" class="block hover:text-[#FFD700]">Panel Lawyers</a>
        <a href="#" class="block hover:text-[#FFD700]">Services</a>
        <a href="#" class="block hover:text-[#FFD700]">Gallery</a>
        <a href="#" class="block hover:text-[#FFD700]">National Lok Adalat</a>
        <a href="#" class="block hover:text-[#FFD700]">Mediation</a>
        <a href="{{ route('homepage.notice') }}" class="block hover:text-[#FFD700]">Notice Board</a>

        <!-- Apply Dropdown -->
        <div class="relative">
            <button type="button"
                class="flex items-center hover:text-[#FFD700] focus:outline-none transition dropdown-toggle">
                Apply
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>

            <!-- Dropdown Menu -->
            <div
                class="absolute left-0 mt-2 w-48 bg-[#102C57] text-white rounded-lg shadow-lg border border-[#FFD700]/20 opacity-0 invisible transition-all duration-200 ease-out dropdown-menu">
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

<!-- JS: Dropdown & Mobile Menu -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mobileToggle = document.getElementById("mobileMenuToggle");
        const navMenu = document.getElementById("navMenu");
        const mobileDropdown = document.getElementById("mobileDropdown");
        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

        // Mobile menu toggle
        mobileToggle.addEventListener("click", () => {
            navMenu.classList.toggle("hidden");
            mobileDropdown.classList.toggle("hidden");
        });

        // Click-to-toggle dropdowns
        dropdownToggles.forEach((toggle) => {
            const menu = toggle.nextElementSibling;

            toggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const isVisible = !menu.classList.contains('invisible');

                // Hide all other dropdowns
                document.querySelectorAll('.dropdown-menu').forEach((m) => {
                    m.classList.add('invisible', 'opacity-0');
                    m.classList.remove('visible', 'opacity-100');
                });

                // Toggle current dropdown
                if (!isVisible) {
                    menu.classList.remove('invisible', 'opacity-0');
                    menu.classList.add('visible', 'opacity-100');
                }
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            document.querySelectorAll('.dropdown-menu').forEach((menu) => {
                if (!menu.contains(e.target)) {
                    menu.classList.add('invisible', 'opacity-0');
                    menu.classList.remove('visible', 'opacity-100');
                }
            });
        });
    });
</script>
