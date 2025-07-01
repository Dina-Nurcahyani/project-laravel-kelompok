<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplikasi Informasi Pasien RSJ</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="Aplikasi Informasi Pasien RSJ" />
    <!--end::Primary Meta Tags-->
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
        integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href={{ asset('css/adminlte.css') }} />
    <!--end::Required Plugin(AdminLTE)-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src={{ asset('img/profile.svg') }} class="user-image rounded-circle shadow"
                                alt="User Image" />
                            <span class="d-none d-md-inline">Nama User</span>
                        </a>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->
        <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
            <!--begin::Sidebar Brand-->
            <div class="sidebar-brand">
                <!--begin::Brand Link-->
                <a href="./index.html" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src={{ asset('img/logo-1.png') }} alt="Logo" class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <span class="brand-text fw-light">Emolife</span>
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>
            <!--end::Sidebar Brand-->
            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-header">Dashboard</li>
                        <li class="nav-item">
                            <a href="/" class="nav-link {{ request()->is('/') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-clipboard-data"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-header">Data</li>
                        {{-- @if (auth()->user()->role === 'admin') --}}
                        <li class="nav-item">
                            <a href="/pegawai" class="nav-link {{ request()->is('pegawai*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-circle"></i>
                                <p>
                                    Pegawai
                                </p>
                            </a>
                        </li>
                        {{-- @endif --}}
                        <li class="nav-item">
                            <a href="/pasien" class="nav-link {{ request()->is('pasien*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Pasien</p>
                            </a>
                        </li>
                        <li class="nav-header">Logout</li>
                        <li class="nav-item">
                            <a href="#" class="nav-link link-danger" onclick="confirmLogout(event)">
                                <i class="nav-icon bi bi-power"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->

        @yield('content')

        <!--begin::Footer-->
        <footer class="app-footer text-center">
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2025&nbsp;
                <a href="/" class="text-decoration-none">Aplikasi Informasi Pasien RSJ</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->

</body>
<!--end::Body-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmLogout(e) {
        e.preventDefault();
        Swal.fire({
            title: 'Yakin logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/logout";
            }
        });
    }
</script>


</html>
