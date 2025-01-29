<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('resources/css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/reportes.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/reserva.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/clientes.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/restaurante.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/habitaciones.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/cargando.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="eap-body">
    @include('layouts.partials.sidebar')

    <div id="loading-screen" class="loading-screen">
        <div class="loading-container">
            <svg class="loading-icon" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <circle class="circle-bg" cx="50" cy="50" r="45" />
                <path class="circle-path" d="M50 10
                           a 40 40 0 0 1 0 80
                           a 40 40 0 0 1 0 -80" />
                <text x="50" y="50" text-anchor="middle" dy=".3em" class="percentage">0%</text>
            </svg>
            <div class="loading-text">Iniciando Administrador</div>
            <div class="loading-modules"></div>
        </div>
    </div>

        @yield('content')

    <script src="{{ asset('resources/js/sidebar.js') }}"></script>
    <script src="{{ asset('resources/js/resportes.js') }}"></script>
    <script src="{{ asset('resources/js/reserva.js') }}"></script>
    <script src="{{ asset('resources/js/habitaciones.js') }}"></script>
    <script src="{{ asset('resources/js/clientes.js') }}"></script>
    <script src="{{ asset('resources/js/restaurante.js') }}"></script>
    <script src="{{ asset('resources/js/cargando.js') }}"></script>
    
</body>
</html>