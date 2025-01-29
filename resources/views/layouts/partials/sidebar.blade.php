<div class="hotel-dashboard">
    <button id="hotelSidebarToggle" class="hotel-sidebar__toggle">
        <i class="fas fa-bars"></i>
    </button>
    
    <!-- Sidebar -->
    <nav id="hotelSidebar" class="hotel-sidebar">
        <div class="hotel-sidebar__header">
            <img src="{{ asset('resources/img/logo.avif') }}" alt="Hotel Logo" class="hotel-logo">
        </div>
        <div class="hotel-sidebar__links">
            <a href="{{ route('reportes.index') }}" class="hotel-sidebar__link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="fas fa-chart-line"></i>
                <span>Reportes</span>
            </a>
            <a href="{{ route('reservas.index') }}" class="hotel-sidebar__link {{ request()->routeIs('reservas') ? 'active' : '' }}">
                <i class="fas fa-calendar-alt"></i>
                <span>Reservas</span>
            </a>
            <a href="{{ route('habitaciones.index') }}" class="hotel-sidebar__link {{ request()->routeIs('habitaciones.*') ? 'active' : '' }}">
                <i class="fas fa-bed"></i>
                <span>Habitaciones</span>
            </a>
            <a href="{{ route('restaurante.index') }}" class="hotel-sidebar__link {{ request()->routeIs('restaurante.*') ? 'active' : '' }}">
                <i class="fas fa-utensils"></i>
                <span>Restaurante</span>
            </a>
            <a href="{{ route('clientes.index') }}" class="hotel-sidebar__link {{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Clientes</span>
            </a>
        </div>
    </nav>
        <!-- Header -->
        <header class="hotel-header">
            <div class="hotel-header__search">
                
            </div>
            <div class="hotel-header__menu">
                <!-- Notifications -->
                <div class="hotel-dropdown">
                    <button class="hotel-dropdown__toggle">
                        <i class="fas fa-bell"></i>
                        <span class="hotel-notification__count">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </button>
                    <div class="hotel-dropdown__menu">
                        <div class="hotel-dropdown__header">Notificaciones</div>
                        @foreach(auth()->user()->unreadNotifications as $notification)
                            <a href="#" class="hotel-dropdown__item">
                                <div class="hotel-dropdown__item-icon"><i class="fas fa-envelope"></i></div>
                                <div class="hotel-dropdown__item-content">
                                    <div class="hotel-dropdown__item-title">Nueva reserva</div>
                                    <div class="hotel-dropdown__item-description">{{ $notification->data['message'] }}</div>
                                </div>
                            </a>
                        @endforeach
                        <a href="#" class="hotel-dropdown__footer">Ver todas las notificaciones</a>
                    </div>
                </div>                

                <!-- Profile Menu -->
                <div class="hotel-dropdown">
                    <button class="hotel-dropdown__toggle hotel-profile__toggle">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="Foto de Perfil" class="hotel-profile__photo">
                        <span>{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="hotel-dropdown__menu">
                        <div class="hotel-dropdown__header">Mi Cuenta</div>
                        <a href="#" class="hotel-dropdown__item">
                            <i class="fas fa-user"></i> Perfil
                        </a>
                        <a href="#" class="hotel-dropdown__item">
                            <i class="fas fa-cog"></i> Configuración
                        </a>
                        <div class="hotel-dropdown__divider"></div>
                        <a href="#" class="hotel-dropdown__item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </header>
</div>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('login') }}" method="POST" style="display: none;">
    @csrf
</form>