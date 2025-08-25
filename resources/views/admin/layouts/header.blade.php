<!--Navbar-->
<nav class="main-header navbar navbar-expand navbar-white navbar-light shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <h6 class="fw-bold mb-0 pt-1">@yield('page-title', 'Dashboard')</h6>
        </li>
    </ul>

    <!--right link-->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link nav-link text-body fw-bold px-0">
                    <i class="fa-solid fa-right-from-bracket me-1"></i>Logout
                </button>
            </form>
        </li>
    </ul>
</nav>
