<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" >
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    


    <!-- Css Styles -->

    <link rel="stylesheet" href="{{ asset('resources/css/bootstrap.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/font-awesome.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/elegant-icons.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/flaticon.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/owl.carousel.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/nice-select.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/jquery-ui.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/magnific-popup.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/slicknav.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('resources/css/style.css') }}">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    @include('layouts.partials.header')

    
    @yield('content')


    @include('layouts.partials.footer')

    @include('layouts.partials.whatsapp')
    

    <script src="{{ asset('resources/js/jquery-3.3.1.min.js') }}"></script>   
    <script src="{{ asset('resources/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('resources/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('resources/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('resources/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('resources/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('resources/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('resources/js/main.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    
</body>
</html>