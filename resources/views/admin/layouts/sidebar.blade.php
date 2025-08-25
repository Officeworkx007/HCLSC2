<aside class="main-sidebar sidebar-dark-primary elevation-4 custom-sidebar">
    <div class="sidebar-overlay"></div>

    <a href="{{ route('admin.dashboard') }}" class="brand-link font-weight-bold custom-brand">
        <span class="brand-text">Admin Panel</span>
    </a>
</aside>

<style>
    .custom-sidebar {
        background: url('{{ asset('images/outdoor.jpg') }}') no-repeat center center;
        background-size: cover;
        color: #ffffff !important;
        position: relative;
    }

    /* Dark transparent overlay to make text/icons readable */
    .custom-sidebar .sidebar-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5); /* adjust darkness */
        z-index: 0;
    }

    /* Brand link styling */
    .custom-brand {
        color: #FFD700 !important;
        position: relative;
        z-index: 1; /* ensures it sits above overlay */
        transition: color 0.3s ease-in-out;
    }

    .custom-brand:hover {
        color: #FFA500 !important;
    }
</style>
