@extends('layouts.dashboard')

@section('title', 'Dashboard | Habitaciones | Editar')

@section('content')
<div class="rmu-container">
    <h1 class="rmu-title"><i class="fas fa-hotel"></i> Actualizar Habitación</h1>
    <form action="{{ route('habitaciones.update', $habitaciones->id) }}" method="POST" id="rmuRoomUpdateForm" class="rmu-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="rmu-existing-images">
            @foreach ($habitaciones->imagenes as $imagen)
                <div class="rmu-image-item" data-image-id="{{ $imagen->id }}">
                    <img src="{{ asset('storage/' . $imagen->img) }}" alt="Imagen de la habitación">
                    <button type="button" class="rmu-delete-image" data-image-id="{{ $imagen->id }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <!-- Agregar nuevas imágenes -->
        <div class="rmu-form-group">
            <label for="rmuRoomImages" class="rmu-file-label">
                <i class="fas fa-images"></i> Agregar Nuevas Imágenes
            </label>
            <div class="rmu-file-upload-container">
                <input type="file" name="img[]" id="rmuRoomImages" accept="image/*" class="rmu-file-input" multiple>
                <label for="rmuRoomImages" class="rmu-file-button">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Seleccionar Imágenes</span>
                </label>
                <div id="rmuImagePreview" class="rmu-image-preview"></div>
            </div>
        </div>

        <!-- Tipo de Habitación y Capacidad Máxima -->
        <div class="rmu-form-row">
            <div class="rmu-form-group">
                <label for="rmuTipoHabitacion"><i class="fas fa-bed"></i> Tipo de Habitación</label>
                <select name="tipo_habitacion" id="rmuTipoHabitacion" required>
                    <option value="" disabled>Seleccione tipo...</option>
                    <option value="Simples" {{ $habitaciones->tipo_habitacion == 'Simples' ? 'selected' : '' }}>Simple</option>
                    <option value="Doble" {{ $habitaciones->tipo_habitacion == 'Doble' ? 'selected' : '' }}>Doble</option>
                    <option value="Matrimonial" {{ $habitaciones->tipo_habitacion == 'Matrimonial' ? 'selected' : '' }}>Matrimonial</option>
                    <option value="Grupal" {{ $habitaciones->tipo_habitacion == 'Grupal' ? 'selected' : '' }}>Grupal</option>
                </select>
            </div>
            <div class="rmu-form-group">
                <label for="rmuCapacidadMaxima"><i class="fas fa-users"></i> Capacidad Máxima</label>
                <input type="number" name="capacidad_maxima" id="rmuCapacidadMaxima" value="{{ $habitaciones->capacidad_maxima }}" required>
            </div>
        </div>

        <!-- Precio y Número de Habitación -->
        <div class="rmu-form-row">
            <div class="rmu-form-group">
                <label for="rmuPrecio"><i class="fas fa-tag"></i> Precio</label>
                <input type="number" name="precio" id="rmuPrecio" step="0.01" min="0" value="{{ $habitaciones->precio }}" required>
            </div>
            <div class="rmu-form-group">
                <label for="rmuNumeroHabitacion"><i class="fas fa-door-closed"></i> Número de Habitación</label>
                <input type="number" name="numero_habitacion" id="rmuNumeroHabitacion" value="{{ $habitaciones->numero_habitacion }}" required>
            </div>
        </div>

        <!-- Descripción -->
        <div class="rmu-form-group">
            <label for="rmuDescripcion"><i class="fas fa-info-circle"></i> Descripción</label>
            <textarea name="descripcion" id="rmuDescripcion" rows="3" required>{{ $habitaciones->descripcion }}</textarea>
        </div>

        <!-- Botón de Actualización -->
        <button type="submit" class="rmu-btn rmu-btn-primary">
            <i class="fas fa-save"></i>
            <span>Actualizar Habitación</span>
        </button>
    </form>

    <div id="rmuImageModal" class="rmu-modal">
        <span class="rmu-modal-close">&times;</span>
        <img class="rmu-modal-content" id="rmuModalImage">
    </div>
</div>
@endsection