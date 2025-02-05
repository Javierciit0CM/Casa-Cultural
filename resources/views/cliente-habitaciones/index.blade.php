@extends('layouts.main')

@section('titulo', 'Reserva | Habitaciones')

@section('contenido')

<div class="lhs-container">
    <form class="lhs-search-form" action="{{ url('/buscar-habitaciones') }}" method="GET">
        <div class="lhs-input-group">
            <label for="fecha_entrada">Fecha de Entrada</label>
            <input type="date" id="fecha_entrada" name="fecha_entrada" required>
        </div>
        <div class="lhs-input-group">
            <label for="fecha_salida">Fecha de Salida</label>
            <input type="date" id="fecha_salida" name="fecha_salida" required>
        </div>
        <button class="lhs-search-btn" type="submit">Buscar Disponibilidad</button>
    </form>
    
    <div class="lhs-room-grid">
        @foreach($habitaciones as $habitacion)
        <article class="lhs-room-card" data-aos="fade-up">
            <div class="lhs-carousel">
                @foreach($habitacion->imagenes as $imagen)
                    <img src="{{ asset('storage/' . $imagen->img) }}" alt="{{ $habitacion->tipo_habitacion }}" loading="lazy">
                @endforeach
            </div>
            <div class="lhs-room-info">
                <h2>{{ ucfirst($habitacion->tipo_habitacion) }}</h2>
                <ul class="lhs-features-list">
                    @foreach(explode(',', $habitacion->descripcion) as $caracteristica)
                        <li><i class="fa {{ $iconos[trim(strtolower($caracteristica))] ?? 'fa-check' }}"></i> {{ ucfirst(trim($caracteristica)) }}</li>
                    @endforeach
                </ul>
                <div class="lhs-room-price">
                    <span>Desde</span>
                    <strong>${{ $habitacion->precio }}</strong>
                    <span>por noche</span>
                </div>
                <button class="lhs-book-btn">Reservar Ahora</button>
            </div>
        </article>
        @endforeach
    </div>
</div>
@endsection