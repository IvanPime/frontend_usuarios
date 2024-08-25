<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <style>
        label.error, label.is-invalid, label small.error {
            font-size: 0.9rem;
            font-weight: 400;
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            color: #F64E60;
        }
        .table tbody tr:hover {
            cursor: pointer;
        }
    </style>
    @stack('styles')
</head>
<body id="kt_app_body" class="app-default">
    <div id="kt_app_header" class="app-header">
        <div class="app-container container-xxl d-flex align-items-stretch justify-content-between" id="kt_app_header_container">
            <div class="d-flex align-items-center">
                <a href="/">
                    <img alt="Logo" src="{{ asset("img/logo.jpg") }}" class="h-50px theme-light-show" />
                </a>
            </div>
            @if (Auth::check())
            <div class="app-navbar flex-shrink-0">
                <div class="app-navbar-item ms-1 ms-lg-3">
                    <div class="cursor-pointer" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                        <h3 class="symbol-label font-weight-bold">{{ Auth::user()->name }}</h3>
                    </div>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
                        <div class="menu-item px-5">
                            <a href="javascript:void(0)" class="btn btn-link d-block" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container mt-8">
            @yield("content")
            <div id="kt_app_footer" class="app-footer d-flex flex-column flex-md-row flex-center flex-md-stack pb-3 mt-8">
                <div class="text-gray-900 order-2 order-md-1">
                    <span class="text-muted fw-semibold me-1" id="fechaHoraActual">2024©</span>
                    <span class="text-gray-800 text-hover-primary">Jorge Ivan García Pimentel</span>
                </div>
            </div>
        </div>
    </div>
    
    
    <script src="assets/plugins/global/plugins.bundle.js"></script>
    <script src="assets/js/scripts.bundle.js"></script>
    <script>
        function actualizarFechaHora() {
            const fechaHoraActual = new Date();
            const opciones = { year: 'numeric', month: '2-digit', day: '2-digit', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            const formatoFechaHora = new Intl.DateTimeFormat('es-ES', opciones).format(fechaHoraActual);
            document.getElementById('fechaHoraActual').innerText = formatoFechaHora.replace(',', '');
        }
        setInterval(actualizarFechaHora, 1000);
        actualizarFechaHora();
    </script>
    @stack('scripts')
</body>
</html>
