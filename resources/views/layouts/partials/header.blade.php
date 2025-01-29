<!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <i class="icon_menu"></i>
</div>
<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <div class="header-configure-area">
        <a href="login-register.php" class="bk-btn">Registrate</a>
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <li class="active"><a href="/">Inicio</a></li>
            <li><a href="habitaciones">Habitaciones</a></li>
            <li><a href="nosotros">Nosotros</a></li>
            <li><a href="restaurante">Servicios</a>
                <ul class="dropdown">
                    <li><a href="restaurante">Restaurante</a></li>
                    <li><a href="#">Tours</a></li>
                </ul>
            </li>
            <li><a href="blog">Blog</a></li>
            <li><a href="contactanos">Contactanos</a></li>
        </ul>
    </nav>
    <div id="mobile-menu-wrap"></div>
    <div class="top-social">
        <a href="#"><i class="fa fa-facebook"></i></a>
        <a href="#"><i class="fa fa-twitter"></i></a>
        <a href="#"><i class="fa fa-instagram"></i></a>
    </div>
    <ul class="top-widget">
        <li><i class="fa fa-phone"></i> (+51) 916 410 461</li>
        <li><i class="fa fa-envelope"></i> infoelmirador@gmail.com</li>
    </ul>
</div>
<!-- Offcanvas Menu Section End -->

<!-- Header Section Begin -->
<header class="header-section">
    <div class="top-nav">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="tn-left">
                        <li><i class="fa fa-phone"></i> (+51) 916 410 461</li>
                        <li><i class="fa fa-envelope"></i> infoelmirador@gmail.com</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                        </div>
                        <a href="login" class="bk-btn">Registrate Ahora</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-item">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="logo">
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                <li class="{{ Request::is('/') ? 'active' : '' }}"><a {{-- href="{{ route('index') }}" --}}>Inicio</a></li>
                                <li class="{{ Request::is('habitaciones') ? 'active' : '' }}"><a {{-- href="{{ route('habitacion') }}" --}}>Habitaciones</a></li>
                                <li class="{{ Request::is('nosotros') ? 'active' : '' }}"><a {{-- href="nosotros" --}}>Nosotros</a></li>
                                <li class="{{ Request::is('restaurante*') || Request::is('tours') ? 'active' : '' }}">
                                    <a {{-- href="restaurante" --}}>Servicios</a>
                                    <ul class="dropdown">
                                        <li class="{{ Request::is('restaurante') ? 'active' : '' }}"><a {{-- href="restaurante" --}}>Restaurante</a></li>
                                        <li class="{{ Request::is('tours') ? 'active' : '' }}"><a href="#">Tours</a></li>
                                    </ul>
                                </li>
                                <li class="{{ Request::is('blog') ? 'active' : '' }}"><a {{-- href="blog" --}}>Blog</a></li>
                                <li class="{{ Request::is('contactanos') ? 'active' : '' }}"><a {{-- href="contactanos" --}}>Contáctanos</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Header End -->