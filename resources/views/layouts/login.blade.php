<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
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
<body id="kt_body" class="app-blank">
    <script>
        document.documentElement.setAttribute("data-bs-theme", "light");
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <div class="w-lg-500px p-10">
                        @yield("content")
                    </div>
                </div>
                <div class="w-lg-500px d-flex flex-stack px-10 mx-auto">
                    <div class="me-10">
                        <span class="text-muted fw-semibold me-1" id="fechaHoraActual">2024©</span>
                        <span data-kt-element="current-lang-name" class="me-1">Jorge Iván García Pimentel</span>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url(assets/media/misc/auth-bg.png)">
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">   
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">Iniciar sesión y obtener usuarios dinámicos por medio de una API</h1>
                    <div class="d-none d-lg-block text-white fs-base text-center">Este proyecto es un caso práctico para evaluación.</div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
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
