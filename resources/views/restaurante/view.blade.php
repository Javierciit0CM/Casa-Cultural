@extends('layouts.dashboard')

@section('title', 'Dashboard | Clientes')

@section('content')

<div class="luxe-container">
    <h1 class="luxe-title luxe-fade-in">Detalles de la Habitación</h1>
    <div class="luxe-card luxe-fade-in">
        <div class="luxe-info-grid">
            <div class="luxe-info-item luxe-slide-in">
                <strong class="luxe-icon-wrapper">
                    <i data-feather="hash"></i>
                    ID:
                </strong>
                <span id="luxe-room-id">{{ $restaurante->id }}</span>
            </div>
            <div class="luxe-info-item luxe-slide-in">
                <strong class="luxe-icon-wrapper">
                    <i data-feather="key"></i>
                    Tipo
                </strong>
                <span id="luxe-room-number">{{ $restaurante->tipo }}</span>
            </div>
            <div class="luxe-info-item luxe-slide-in">
                <strong class="luxe-icon-wrapper">
                    <i data-feather="home"></i>
                    Nombre:
                </strong>
                <span id="luxe-room-type">{{ $restaurante->nombre }}</span>
            </div>
            <div class="luxe-info-item luxe-slide-in">
                <strong class="luxe-icon-wrapper">
                    <i data-feather="dollar-sign"></i>
                    Precio:
                </strong>
                <span id="luxe-room-price">{{ $restaurante->precio }}</span>
            </div>
            <div class="luxe-info-item luxe-info-item-description luxe-slide-in">
                <strong class="luxe-icon-wrapper">
                    <i data-feather="file-text"></i>
                    Disponibilidad:
                </strong>
                <p id="luxe-room-description" class="luxe-description-text">{{ $restaurante->disponibilidad }}</p>
            </div>
        </div>
    </div>

    <h2 class="luxe-subtitle luxe-fade-in">Imágenes De La Habitación</h2>
    <div id="luxe-images-grid" class="luxe-images-grid">
        @if($restaurante->imagenes->isNotEmpty())
            @foreach($restaurante->imagenes as $imagen)
                <div class="luxe-image-card luxe-fade-in">
                    <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" 
                         alt="Imagen de la Habitación {{ $restaurante->id }}" 
                         class="luxe-room-image">
                </div>
            @endforeach
        @else
            <p>No hay imágenes disponibles para esta habitación.</p>
        @endif
    </div>

    <div class="luxe-button-container luxe-fade-in">
        <a href="{{ route('restaurante.index') }}" class="luxe-btn luxe-btn-back">
            <i data-feather="chevron-left"></i>
            Volver al Listado
        </a>
    </div>
</div>

<div id="luxe-image-modal" class="luxe-modal">
    <div class="luxe-modal-content">
        <span class="luxe-close-button" aria-label="Cerrar galería">&times;</span>
        <img id="luxe-modal-image" src="/placeholder.svg" alt="Imagen ampliada de la habitación">
        <button id="luxe-prev-button" class="luxe-nav-button luxe-prev" aria-label="Imagen anterior">&#10094;</button>
        <button id="luxe-next-button" class="luxe-nav-button luxe-next" aria-label="Imagen siguiente">&#10095;</button>
    </div>
</div>
@endsection