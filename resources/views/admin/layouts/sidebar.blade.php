<aside class="main-sidebar bg-[#0c1e33] text-white h-screen flex flex-col transition-all duration-300" id="sidebar">
    <div class="sidebar-overlay"></div>

    <!-- Brand -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link font-bold text-center py-4 block">
        <span class="brand-text sidebar-text">Admin Panel</span>
    </a>

    <!-- Menu -->
    <nav class="flex-1 w-full mt-5">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33]">
                    <i class="fas fa-tachometer-alt"></i>
                    <span class="sidebar-text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="#"
                    class="flex items-center space-x-3 px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33]">
                    <i class="fas fa-users"></i>
                    <span class="sidebar-text">Users</span>
                </a>
            </li>

            <!-- Legal Aid Applications Dropdown -->
            <li x-data="{ open: false }" class="relative">
                <!-- Main Item -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33] focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-balance-scale"></i>
                        <span class="sidebar-text">Legal Aid Applications</span>
                    </div>
                    <!-- Arrow -->
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <ul x-show="open" x-transition
                    class="relative ml-10 mt-2 flex flex-col space-y-2 text-sm text-gray-300">

                    <!-- vertical line -->
                    <span class="absolute left-0 top-0 h-full w-px bg-gray-600"></span>

                    <li>
                        <a href="{{ route('admin.legal_aid.index') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            View
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Panel Lawyers Dropdown -->
            <li x-data="{ open: false }" class="relative">
                <!-- Main Item -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33] focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-users"></i>
                        <span class="sidebar-text">Panel Lawyers</span>
                    </div>
                    <!-- Arrow -->
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <ul x-show="open" x-transition
                    class="relative ml-10 mt-2 flex flex-col space-y-2 text-sm text-gray-300">

                    <!-- vertical line -->
                    <span class="absolute left-0 top-0 h-full w-px bg-gray-600"></span>

                    <li>
                        <a href="{{ route('admin.panel_lawyers.index') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            All Panel Lawyers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.panel_lawyers.create') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            Add New Lawyer
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Notices Dropdown -->
            <li x-data="{ open: false }" class="relative">
                <!-- Main Item -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33] focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-clipboard"></i>
                        <span class="sidebar-text">Notices</span>
                    </div>
                    <!-- Arrow -->
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <ul x-show="open" x-transition
                    class="relative ml-10 mt-2 flex flex-col space-y-2 text-sm text-gray-300">

                    <!-- vertical line -->
                    <span class="absolute left-0 top-0 h-full w-px bg-gray-600"></span>

                    <li>
                        <a href="{{ route('admin.notices.index') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            View
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.notices.create') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            Create
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Mediation Causelist Dropdown -->
            <li x-data="{ open: false }" class="relative">
                <!-- Main Item -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33] focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-file-pdf"></i>
                        <span class="sidebar-text">Mediation Causelist</span>
                    </div>
                    <!-- Arrow -->
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <ul x-show="open" x-transition
                    class="relative ml-10 mt-2 flex flex-col space-y-2 text-sm text-gray-300">

                    <!-- vertical line -->
                    <span class="absolute left-0 top-0 h-full w-px bg-gray-600"></span>

                    <li>
                        <a href="{{ route('admin.mediations.index') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            View
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.mediations.create') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            Create
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Photo Gallery Dropdown -->
            <li x-data="{ open: false }" class="relative">
                <!-- Main Item -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33] focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-images"></i>
                        <span class="sidebar-text">Photo Gallery</span>
                    </div>
                    <!-- Arrow -->
                    <svg :class="open ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <ul x-show="open" x-transition
                    class="relative ml-10 mt-2 flex flex-col space-y-2 text-sm text-gray-300">

                    <!-- vertical line -->
                    <span class="absolute left-0 top-0 h-full w-px bg-gray-600"></span>

                    <li>
                        <a href="{{ route('admin.photo_gallery.index') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            View
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.photo_gallery.create') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            Create
                        </a>
                    </li>
                </ul>
            </li>

            <!-- Calendar Dropdown -->
            <li x-data="{ openCal: false }" class="relative">
                <!-- Main Item -->
                <button @click="openCal = !openCal"
                    class="w-full flex items-center justify-between px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33] focus:outline-none">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-calendar-alt"></i>
                        <span class="sidebar-text">Calendar</span>
                    </div>

                    <!-- Arrow -->
                    <svg :class="openCal ? 'rotate-90' : ''" class="w-4 h-4 transform transition-transform"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <!-- Dropdown Items -->
                <ul x-show="openCal" x-transition
                    class="relative ml-10 mt-2 flex flex-col space-y-2 text-sm text-gray-300">

                    <!-- vertical line -->
                    <span class="absolute left-0 top-0 h-full w-px bg-gray-600"></span>

                    <li>
                        <a href="{{ route('admin.calendar.index') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            View Calendar
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('admin.calendar.create') }}"
                            class="block px-3 py-2 rounded hover:bg-white hover:text-[#0c1e33] transition">
                            Add Event
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<style>
    .main-sidebar {
        width: 250px;
        transition: width 0.3s ease;
    }

    .main-sidebar .sidebar-text {
        opacity: 1;
        white-space: nowrap;
        display: inline-block;
        overflow: hidden;
        transition: opacity 0.3s ease, width 0.3s ease;
    }

    .main-sidebar.collapsed {
        width: 80px;
    }

    .main-sidebar.collapsed .sidebar-text {
        opacity: 0;
        width: 0;
        transition: opacity 0.2s ease, width 0.3s ease;
    }
</style>

<script>
    // Toggle sidebar collapse
    document.getElementById("toggle-btn").addEventListener("click", function() {
        document.getElementById("sidebar").classList.toggle("collapsed");
    });
</script>

<!-- Add Alpine.js -->
<script src="https://unpkg.com/alpinejs" defer></script>
