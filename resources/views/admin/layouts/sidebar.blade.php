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
            <li>
                <a href="#"
                   class="flex items-center space-x-3 px-6 py-3 rounded-l-full transition duration-300 hover:bg-white hover:text-[#0c1e33]">
                    <i class="fas fa-file-alt"></i>
                    <span class="sidebar-text">Legal Aid Applications</span>
                </a>
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
    document.getElementById("toggle-btn").addEventListener("click", function () {
        document.getElementById("sidebar").classList.toggle("collapsed");
    });
</script>
