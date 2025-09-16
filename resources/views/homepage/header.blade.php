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
                <a href=""
                    class="bg-white border border-[#FFD700] text-[#FFD700] text-sm font-semibold px-5 py-2 rounded shadow
          hover:bg-[#FFD700] hover:text-white transition">
                    Login
                </a>
            </div>

        </div>
    </div>
    <!-- Bottom Header (Navigation) -->
    <div class="bg-blue-900 relative z-50"> <!-- Added z-50 -->
        <nav
            class="max-w-7xl mx-auto px-6 py-4 flex flex-wrap gap-x-6 font-medium text-white text-md justify-center relative">
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Home</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">About Us</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Panel Lawyers</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Services</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Gallery</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">National Lok Adalat</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Mediation</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Notice Board</a>

            <!-- Apply with Dropdown -->
            <div class="relative" id="apply-menu">
                <button id="apply-btn" class="hover:text-[#FFD700] whitespace-nowrap flex items-center">
                    Apply ▾
                </button>
                <!-- Dropdown Menu -->
                <div id="dropdown"
                    class="absolute left-0 mt-2 w-48 bg-[#0c1e33] text-white rounded shadow-lg hidden z-50">
                    <a href="{{ route('homepage.legalaid') }}"
                        class="block px-4 py-2 hover:bg-[#0c1e33] hover:text-[#FFD700]">Legal Aid</a>
                    <hr class="border-gray-600">
                    <a href="#" class="block px-4 py-2 hover:bg-[#0c1e33] hover:text-[#FFD700]">Panel
                        Lawyer</a>
                    <hr class="border-gray-600">
                    <a href="#" class="block px-4 py-2 hover:bg-[#0c1e33] hover:text-[#FFD700]">Mediation</a>
                </div>
            </div>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Guidelines</a>
            <a href="#" class="hover:text-[#FFD700] whitespace-nowrap">Contact Us</a>
        </nav>
    </div>
    <script>
        window.onload = function() {
            const btn = document.getElementById("apply-btn");
            const menu = document.getElementById("dropdown");

            if (!btn || !menu) return;

            btn.addEventListener("click", function(e) {
                e.stopPropagation();
                menu.classList.toggle("hidden");
            });

            document.addEventListener("click", function(event) {
                if (!btn.contains(event.target) && !menu.contains(event.target)) {
                    menu.classList.add("hidden");
                }
            });
        };
    </script>

</header>
