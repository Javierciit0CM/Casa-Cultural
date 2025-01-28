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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="eap-body">
    @include('layouts.partials.sidebar')


        @yield('content')

    <script src="{{ asset('resources/js/sidebar.js') }}"></script>
    <script src="{{ asset('resources/js/resportes.js') }}"></script>
    <script src="{{ asset('resources/js/reserva.js') }}"></script>
    <script src="{{ asset('resources/js/habitaciones.js') }}"></script>
    <script src="{{ asset('resources/js/clientes.js') }}"></script>
    <script src="{{ asset('resources/js/restaurante.js') }}"></script>
    
</body>
</html>