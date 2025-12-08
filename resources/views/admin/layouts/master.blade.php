<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    {{-- jQuery FIRST --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script>
        window.$ = window.jQuery;
    </script>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    {{-- AdminLTE CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">

    {{-- Laravel / Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    {{-- DataTables CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('admin.layouts.header')
        @include('admin.layouts.sidebar')

        <div class="content-wrapper bg-white">
            <section class="content-header">
                <div class="container-fluid">
                    @yield('page-header')
                </div>
            </section>

            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

        @include('admin.layouts.footer')

    </div>

    {{-- Bootstrap + AdminLTE --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>

    <!-- Prevent AdminLTE DOM errors from breaking all JS -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            try {
                // AdminLTE initializer
                $.AdminLTE = $.AdminLTE || {};
            } catch (e) {
                console.warn("AdminLTE script error guarded:", e);
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Feather Icons FIX --}}
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    {{-- DataTables JS --}}
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

    {{-- Page-level scripts --}}
    @stack('scripts')
</body>

</html>
