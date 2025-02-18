@extends('layouts.main')

@section('titulo', 'Reservar | Habitaciones')

@section('contenido')

<div class="room-details">
    <h1 class="room-details__title">Suite de Lujo</h1>

    <div class="room-details__content">
        <div class="room-details__gallery">
            <div class="room-details__image-container">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80" alt="Suite de Lujo" class="room-details__image">
                <button class="room-details__image-nav room-details__image-nav--prev">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
                </button>
                <button class="room-details__image-nav room-details__image-nav--next">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                </button>
            </div>
            <div class="room-details__image-indicators"></div>
        </div>

        <div class="room-details__info">
            <div class="room-details__quick-info">
                <div class="room-details__quick-info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    <span>4 personas</span>
                </div>
                <div class="room-details__quick-info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v18H3zM12 8v8m-4-4h8"></path></svg>
                    <span>50 m²</span>
                </div>
                <div class="room-details__quick-info-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <span>Vista al mar</span>
                </div>
            </div>

            <p class="room-details__id"><strong>ID de Habitación:</strong> SUITE-001</p>
            <p class="room-details__price"><strong>Precio:</strong> $299 por noche</p>
            <p class="room-details__description">
                Disfrute de nuestra espaciosa Suite de Lujo con impresionantes vistas al mar. Esta suite de 50 m² ofrece un amplio dormitorio con cama king-size, sala de estar separada, y un lujoso baño con jacuzzi privado. Perfecta para parejas en busca de una escapada romántica o para familias que desean un alojamiento premium.
            </p>

            <h3 class="room-details__amenities-title">Comodidades</h3>
            <ul class="room-details__amenities-list">
                <li>Wi-Fi gratuito de alta velocidad</li>
                <li>Televisor de pantalla plana de 55"</li>
                <li>Minibar surtido diariamente</li>
                <li>Cafetera Nespresso</li>
                <li>Caja fuerte digital</li>
                <li>Servicio de habitaciones 24/7</li>
            </ul>
            
            <button class="room-details__book-btn">Reservar Ahora</button>
        </div>
    </div>
</div>
@endsection