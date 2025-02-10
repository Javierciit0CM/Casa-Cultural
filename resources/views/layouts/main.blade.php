<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('titulo')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js"></script>
    <link rel="stylesheet" href="{{asset('resources/css/cliente-header.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-footer.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-carrusel.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-habitaciones.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-experiencias.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-blog.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-testimonios.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-reserva.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-cargando.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/cliente-buscar.css')}}">
    <link rel="stylesheet" href="{{asset('resources/css/whatsapp.css')}}">
    
    
</head>
<body>

    <div id="loading-screen" class="loading-screen">
        <div class="loading-content">
            <div class="circular-loader">
                <svg class="circular" viewBox="25 25 50 50">
                    <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
                </svg>
            </div>
        </div>
    </div>
    
    @include('layouts.partials.header')

    @yield('contenido')

    @include('layouts.partials.whatsapp')
    @include('layouts.partials.footer')

    <script src="{{ asset('resources/js/cliente-header.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-footer.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-carrusel.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-habitaciones.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-experiencias.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-blog.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-testimonios.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-reserva.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-cargando.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-buscar.js') }}"></script>
    <script src="{{ asset('resources/js/whatsapp.js') }}"></script>
</body>
</html>