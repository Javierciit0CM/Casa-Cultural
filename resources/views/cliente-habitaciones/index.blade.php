@extends('layouts.main')

@section('titulo', 'Reservar | Habitaciones')

@section('contenido')
<div class="container">
    <!-- Sidebar con filtros -->
    <aside class="filters">
        <div class="filter-section">
            <h3>Nombre</h3>
            <input type="text" placeholder="Buscar" class="search-input">
        </div>

        <div class="filter-section">
            <h3>Precio por noche</h3>
            <div class="price-filters">
                <label class="checkbox-container">
                    <input type="checkbox">
                    <span>S/0 a S/100</span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox">
                    <span>S/100 a S/150 </span>
                </label>
                <label class="checkbox-container">
                    <input type="checkbox">
                    <span>S/150 a S/200 </span>
                </label>
            </div>
        </div>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <header class="results-header">
            <div class="sort-options">
                <span>ORDENAR POR:</span>
                <button class="sort-btn active">Todos</button>
                <button class="sort-btn">Simple</button>
                <button class="sort-btn">Doble</button>
                <button class="sort-btn">Matrimonial</button>
            </div>
        </header>

        <div class="hotels-grid">
            @foreach ($habitaciones as $habitacion)
                <div class="hotel-card">
                    <!-- Mostrar la primera imagen si hay imágenes disponibles -->
                    @if($habitacion->imagenes->isNotEmpty())
                        <img src="{{ asset('storage/' . $habitacion->imagenes->first()->img) }}" 
                            alt="{{ $habitacion->tipo_habitacion }}" 
                            class="hotel-image">
                    @else
                        <img  
                            alt="Imagen no disponible" 
                            class="hotel-image">
                    @endif
                    
                    <div class="hotel-info">
                        <div class="hotel-details">
                            <h3 class="hotel-name">{{ $habitacion->tipo_habitacion }}</h3>
                            <p class="hotel-location">Capacidad: {{ $habitacion->capacidad_maxima }} Personas</p>
                            <div class="hotel-description">
                                @foreach(explode(',', $habitacion->descripcion) as $detalle)
                                    <div class="description-item">
                                        <i class="fa-solid fa-check-circle"></i> <!-- Ícono de check -->
                                        <span>{{ trim($detalle) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="hotel-price">
                            <div>desde</div>
                            <div class="price-amount">S/{{ $habitacion->precio }}</div>
                            <div>Total 1 noche</div>
                            <button class="book-btn">ELIGIR HABITACIÓN</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('.price-filters input[type="checkbox"]').on('change', function () {
            let preciosSeleccionados = [];

            $('.price-filters input[type="checkbox"]:checked').each(function () {
                let textoRango = $(this).next().text().trim().replace('S/', '').replace(' a ', '-');
                preciosSeleccionados.push(textoRango);
            });

            $.ajax({
                url: "{{ route('habitaciones.filtrar') }}",
                method: "GET",
                data: { precios: preciosSeleccionados },
                success: function (response) {
                    $('.hotels-grid').html('');

                    if (response.habitaciones.length === 0) {
                        $('.hotels-grid').html('<p>No se encontraron habitaciones en este rango de precios.</p>');
                        return;
                    }

                    response.habitaciones.forEach(function (habitacion) {
                        $('.hotels-grid').append(`
                            <div class="hotel-card">
                                <img src="${habitacion.imagenes.length ? '/storage/' + habitacion.imagenes[0].img : '/images/default-hotel.jpg'}"
                                    alt="${habitacion.tipo_habitacion}" class="hotel-image">
                                <div class="hotel-info">
                                    <h3 class="hotel-name">${habitacion.tipo_habitacion}</h3>
                                    <p class="hotel-location">Capacidad: ${habitacion.capacidad_maxima} personas</p>
                                    <div class="hotel-description">
                                        ${habitacion.descripcion.map(detalle => `
                                            <div class="description-item">
                                                <i class="fa-solid fa-check-circle"></i>
                                                <span>${detalle}</span>
                                            </div>`).join('')}
                                    </div>
                                    <div class="hotel-price">
                                        <div>desde</div>
                                        <div class="price-amount">S/${habitacion.precio}</div>
                                        <button class="book-btn">ELIGE HABITACIÓN</button>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            });
        });
    });
</script>
