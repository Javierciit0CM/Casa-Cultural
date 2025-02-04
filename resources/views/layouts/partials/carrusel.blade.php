<div class="lh-hero-wrapper">
    <div class="lh-hero-carousel">
        <div class="lh-carousel-container">
            <div class="lh-carousel">
                <div class="lh-carousel-slide lh-active">
                    <img src="{{asset('resources/img/hero1.jpg')}}" alt="Hotel de Lujo 1">
                    <div class="lh-slide-content">
                        <h2>Lujo Inigualable</h2>
                        <p>Descubre el confort en cada detalle</p>
                    </div>
                </div>
                <div class="lh-carousel-slide">
                    <img src="{{asset('resources\img/hero2.avif')}}" alt="Hotel de Lujo 2">
                    <div class="lh-slide-content">
                        <h2>Relájate y Renuévate</h2>
                        <p>Spa de clase mundial a tu disposición</p>
                    </div>
                </div>
                <div class="lh-carousel-slide">
                    <img src="{{asset('resources\img/hero3.jpg')}}" alt="Hotel de Lujo 3">
                    <div class="lh-slide-content">
                        <h2>Experiencia Culinaria</h2>
                        <p>Sabores exquisitos en cada plato</p>
                    </div>
                </div>
            </div>
            <button class="lh-carousel-control lh-prev" aria-label="Anterior"><i class="fas fa-chevron-left"></i></button>
            <button class="lh-carousel-control lh-next" aria-label="Siguiente"><i class="fas fa-chevron-right"></i></button>
            <div class="lh-carousel-indicators"></div>
        </div>
        <div class="lh-hero-content">
            <button id="lh-show-form" class="lh-show-form-button">Reserva Ahora</button>
        </div>
    </div>
</div>
<div id="lh-form-overlay" class="lh-form-overlay">
    <div class="lh-form-container">
        <button id="lh-close-form" class="lh-close-form-button">&times;</button>
        <h2>Reserva tu Estancia</h2>
        <form class="lh-search-form">
            <div class="lh-form-group">
                <label for="check-in">Check-in</label>
                <input type="date" id="check-in" required>
            </div>
            <div class="lh-form-group">
                <label for="check-out">Check-out</label>
                <input type="date" id="check-out" required>
            </div>
            <div class="lh-form-group">
                <label for="guests">Huéspedes</label>
                <select id="guests" required>
                    <option value="1">1 Adulto</option>
                    <option value="2">2 Adultos</option>
                    <option value="3">3 Adultos</option>
                    <option value="4">4 Adultos</option>
                </select>
            </div>
            <button type="submit" class="lh-search-button">Buscar Disponibilidad</button>
        </form>
    </div>
</div>