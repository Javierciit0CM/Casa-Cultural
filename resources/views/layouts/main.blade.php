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
    
</head>
<body>
    
    @include('layouts.partials.header')

    @include('layouts.partials.carrusel')

    @include('layouts.partials.habitaciones-section')

    @include('layouts.partials.experiencias-section')
    @include('layouts.partials.blog-section')
    @include('layouts.partials.testimonios-section')
    @include('layouts.partials.footer')

    <script src="{{ asset('resources/js/cliente-header.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-footer.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-carrusel.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-habitaciones.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-experiencias.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-blog.js') }}"></script>
    <script src="{{ asset('resources/js/cliente-testimonios.js') }}"></script>
</body>
</html>