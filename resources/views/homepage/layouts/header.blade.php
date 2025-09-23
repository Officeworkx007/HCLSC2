@php
    $token = session('token_number');
@endphp

<!-- Header -->
<header class="shadow">

    <!-- Top Header (Logo + Title + Buttons) -->
    <div class="bg-white text-black">
        <div class="max-w-7xl mx-auto px-6 py-6 flex items-center justify-between">

            <!-- Left Side: Logo + Title -->
            <div class="flex items-center space-x-4">
                <img src="/images/logo2.png" alt="hclsc logo" class="h-24 w-auto">
                <div>
                    <h1 class="text-2xl font-bold">High Court Legal Services Committee</h1>
                    <p class="text-sm text-gray-600">High Court of Manipur, Mantripukhri</p>
                </div>
            </div>

            <!-- Right Side: Buttons -->
            <div class="absolute right-10 translate-y-1/2 space-x-4">
                <a href="#"
                    class="bg-white border border-[#FFD700] text-[#FFD700] text-sm font-semibold px-5 py-2 rounded shadow
                          hover:bg-[#FFD700] hover:text-white transition">
                    Login
                </a>
            </div>

        </div>
    </div>

    <!-- Bottom Header (Navigation) -->
    <div class="bg-blue-900 relative z-50">
        <nav
            class="max-w-8xl mx-auto px-6 py-4 flex flex-wrap gap-x-6 font-medium text-white text-md justify-center relative">

            <a href="{{ route('homepage.home') }}" class="hover:text-[#FFD700] whitespace-nowrap">Home</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">About Us</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Panel Lawyers</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Services</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Gallery</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">National Lok Adalat</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Mediation</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Notice Board</a>

            <!-- Apply Dropdown -->
            <div class="relative dropdown">
                <button type="button" class="dropdown-toggle hover:text-[#FFD700] whitespace-nowrap flex items-center">
                    Apply ▾
                </button>
                <div
                    class="dropdown-menu absolute top-full left-0 mt-2 w-48 bg-[#0c1e33] text-white rounded shadow-lg hidden z-50">
                    <a href="{{ route('homepage.legalaid') }}"
                        class="block px-4 py-2 hover:bg-[#0c1e33] hover:text-[#FFD700]">Legal Aid</a>
                    <hr class="border-gray-600">
                    <a href="#" class="block px-4 py-2 hover:bg-[#0c1e33] hover:text-[#FFD700]">Panel Lawyer</a>
                    <hr class="border-gray-600">
                    <a href="#" class="block px-4 py-2 hover:bg-[#0c1e33] hover:text-[#FFD700]">Mediation</a>
                </div>
            </div>

            <a href="{{ route('homepage.track') }}" class="hover:text-[#FFD700] whitespace-nowrap">Track your Form</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Guidelines</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Contact Us</a>
        </nav>
    </div>

</header>

<!-- Dropdown Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.dropdown-toggle').forEach(btn => {
            const menu = btn.nextElementSibling;

            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                menu.classList.toggle('hidden');
            });
        });

        document.addEventListener('click', function(e) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                if (!menu.contains(e.target) && !menu.previousElementSibling.contains(e
                        .target)) {
                    menu.classList.add('hidden');
                }
            });
        });
    });
</script>
