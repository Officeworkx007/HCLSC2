@php
    $token = session('token_number');
@endphp

<!-- DEVELOPMENT NOTICE -->
<div class="bg-yellow-400 text-blue-900 text-center py-2 px-4 font-semibold text-sm shadow-md flex items-center justify-center gap-2 w-full">
    <i class="fa-solid fa-triangle-exclamation text-blue-900"></i>
    <span>Website is currently under development. Some pages may load slowly or may not function as expected.</span>
</div>

<!-- HEADER -->
<header class="bg-white shadow-md sticky top-0 z-50 w-full">
    <!-- Top Section -->
    <div class="max-w-7xl mx-auto flex items-center justify-between px-4 sm:px-6 py-3 lg:py-4">
        <!-- Left: Logo + Title -->
        <div class="flex items-center gap-2 sm:gap-3 md:gap-4">
            <img src="/images/hc logo.jpg" alt="High Court of Manipur logo"
                class="h-12 sm:h-14 md:h-16 lg:h-20 w-auto rounded-md shadow-sm transition-all duration-300">
            <div class="leading-tight">
                <h1
                    class="text-lg sm:text-xl md:text-2xl lg:text-4xl font-bold bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 bg-clip-text text-transparent">
                    High Court Legal Services Committee
                </h1>
                <p class="text-xs sm:text-sm md:text-md font-semibold text-black">High Court of Manipur, Mantripukhri</p>
            </div>
        </div>

        <!-- Right: Buttons -->
        <div class="hidden lg:flex items-center gap-3">
            <a href="#"
                class="bg-white border border-[#FFD700] text-black text-sm font-bold px-5 py-2 rounded-full shadow-sm hover:bg-[#FFD700] hover:text-[#0B2447] transition">
                Login
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobileMenuToggle"
            class="lg:hidden text-[#0B2447] focus:outline-none relative z-50 p-2 rounded-md border border-gray-300 bg-white shadow-sm">
            <i class="fa-solid fa-bars text-2xl transition-all duration-300" id="menuIcon"></i>
            <i class="fa-solid fa-xmark text-2xl hidden transition-all duration-300" id="closeIcon"></i>
        </button>
    </div>

    <!-- Animation Styles -->
    <style>
        .dropdown-menu {
            max-height: 0;
            opacity: 0;
            overflow: hidden;
            transition: max-height 260ms ease, opacity 220ms ease, transform 260ms ease;
            transform-origin: top;
            transform: translateY(-4px);
        }

        .dropdown-menu.open {
            max-height: 520px;
            opacity: 1;
            transform: translateY(0);
        }

        @media (min-width: 1024px) {
            .group:hover>.dropdown-menu {
                max-height: 520px;
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- NAVBAR -->
    <nav id="navMenu"
        class="bg-gradient-to-r from-blue-900 via-blue-800 to-blue-600 text-white font-medium text-[15px] flex flex-col lg:flex-row items-start lg:items-center lg:justify-center space-y-2 lg:space-y-0 lg:space-x-8 py-3 px-4 lg:px-0 transition-all duration-300 hidden lg:flex">

        <a href="{{ route('homepage.home') }}" class="hover:text-[#FFD700] transition">Home</a>

        <!-- ABOUT US DROPDOWN -->
        <div class="relative group w-full lg:w-auto">
            <button type="button"
                class="flex items-center justify-between w-full lg:w-auto hover:text-[#FFD700] focus:outline-none transition dropdown-toggle">
                About Us
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>

            <div
                class="dropdown-menu hidden lg:block lg:absolute left-0 mt-2 w-full lg:w-64 bg-[#102C57] text-white rounded-lg shadow-lg border border-[#1D4ED8] overflow-hidden divide-y divide-[#00FFFF]">
                <a href="{{ route('homepage.intro') }}" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">High Court Legal Services Committee</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Advisory Board</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Members</a>
            </div>
        </div>

        <a href="{{ route('homepage.lawyers') }}" class="hover:text-[#FFD700] transition">Panel Lawyers</a>
        <a href="#" class="hover:text-[#FFD700] transition">Gallery</a>
        <a href="#" class="hover:text-[#FFD700] transition">National Lok Adalat</a>
        <a href="#" class="hover:text-[#FFD700] transition">Mediation</a>
        <a href="{{ route('homepage.notice') }}" class="hover:text-[#FFD700] transition">Notice Board</a>

        <!-- APPLY DROPDOWN -->
        <div class="relative group w-full lg:w-auto">
            <button type="button"
                class="flex items-center justify-between w-full lg:w-auto hover:text-[#FFD700] focus:outline-none transition dropdown-toggle">
                Apply
                <i class="fa-solid fa-chevron-down text-xs ml-1"></i>
            </button>

            <div
                class="dropdown-menu hidden lg:block lg:absolute left-0 mt-2 w-full lg:w-56 bg-[#102C57] text-white rounded-lg shadow-lg border border-[#FFD700]/20 overflow-hidden divide-y divide-[#00FFFF]">
                <a href="{{ route('homepage.legalaid') }}" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Legal Aid</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Panel Lawyer</a>
                <a href="#" class="block px-4 py-2 hover:bg-[#1D4ED8] transition">Mediation</a>
            </div>
        </div>

        <a href="{{ route('homepage.track') }}" class="hover:text-[#FFD700] transition">Track your Form</a>
        <a href="#" class="hover:text-[#FFD700] transition">Guidelines</a>
        <a href="{{ route('homepage.contactus') }}" class="hover:text-[#FFD700] transition">Contact Us</a>
    </nav>
</header>

<!-- JS -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const mobileToggle = document.getElementById("mobileMenuToggle");
        const navMenu = document.getElementById("navMenu");
        const dropdownToggles = document.querySelectorAll(".dropdown-toggle");
        const dropdownMenus = document.querySelectorAll(".dropdown-menu");
        const menuIcon = document.getElementById("menuIcon");
        const closeIcon = document.getElementById("closeIcon");

        const closeAllDropdowns = () => {
            dropdownMenus.forEach(menu => {
                menu.classList.remove("open");
                if (window.innerWidth < 1024) menu.classList.add("hidden");
            });
        };

        mobileToggle.addEventListener("click", () => {
            navMenu.classList.toggle("hidden");
            menuIcon.classList.toggle("hidden");
            closeIcon.classList.toggle("hidden");
            if (!navMenu.classList.contains("hidden")) closeAllDropdowns();
        });

        dropdownToggles.forEach(toggle => {
            toggle.addEventListener("click", (e) => {
                if (window.innerWidth < 1024) {
                    e.preventDefault();
                    const dropdown = toggle.nextElementSibling;

                    if (dropdown.classList.contains("hidden")) {
                        closeAllDropdowns();
                        dropdown.classList.remove("hidden");
                        requestAnimationFrame(() => dropdown.classList.add("open"));
                    } else {
                        dropdown.classList.remove("open");
                        setTimeout(() => {
                            if (window.innerWidth < 1024) dropdown.classList.add("hidden");
                        }, 280);
                    }
                }
            });
        });

        window.addEventListener("resize", () => {
            if (window.innerWidth >= 1024) {
                navMenu.classList.remove("hidden");
                menuIcon.classList.remove("hidden");
                closeIcon.classList.add("hidden");
                dropdownMenus.forEach(menu => menu.classList.remove("hidden", "open"));
            } else {
                navMenu.classList.add("hidden");
                menuIcon.classList.remove("hidden");
                closeIcon.classList.add("hidden");
                dropdownMenus.forEach(menu => menu.classList.add("hidden"));
            }
        });

        if (window.innerWidth < 1024) {
            navMenu.classList.add("hidden");
            dropdownMenus.forEach(menu => menu.classList.add("hidden"));
        }

        document.addEventListener('click', (e) => {
            if (window.innerWidth < 1024) {
                const inside = e.target.closest('.group') || e.target.closest('.dropdown-menu') || e.target.closest('#mobileMenuToggle');
                if (!inside) closeAllDropdowns();
            }
        });
    });
</script>
