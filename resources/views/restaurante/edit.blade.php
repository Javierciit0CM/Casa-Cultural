@extends('layouts.dashboard')

@section('title', 'Dashboard | Restaurante | Editar')

@section('content')
<div class="rr-container">
    <h2 class="rr-title">Registrar Nuevo Restaurante</h2>

    <!-- Mensaje de error -->
    @if ($errors->any())
        <div class="rr-alert rr-alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('restaurante.update', $restaurante->id) }}" method="POST" id="restaurantForm" class="rr-form" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="rmu-existing-images">
            @foreach ($restaurante->imagenes as $imagen)
                <div class="rmu-image-item" data-image-id="{{ $imagen->ruta_imagen }}">
                    <img src="{{ asset('storage/' . $imagen->ruta_imagen) }}" alt="Imagen de la habitación">
                    <button type="button" class="rmu-delete-image" data-image-id="{{ $imagen->ruta_imagen }}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            @endforeach
        </div>

        <div class="rr-form-group">
            <label for="imagenes" class="rr-label">Imágenes del Plato</label>
            <div class="rr-file-input">
                <input type="file" class="rr-file" id="imagenes" name="imagenes[]" multiple accept="image/*">
                <label for="imagenes" class="rr-file-label">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Seleccionar archivos</span>
                </label>
            </div>
            <small class="rr-help-text">Puedes subir varias imágenes (formatos permitidos: JPG, PNG, GIF).</small>
        </div>

        <!-- Contenedor para vista previa de imágenes -->
        <div id="imagePreviewContainer" class="rr-image-preview-container">
            <!-- Aquí se mostrarán las imágenes seleccionadas -->
        </div>

        <div class="rr-form-group">
            <label for="tipo" class="rr-label">Tipo de Plato</label>
            <div class="rr-select-wrapper">
                <select class="rr-select" name="tipo" id="tipo" required>
                    <option value="" selected disabled>Seleccionar tipo...</option>
                    <option value="Entrante" {{ $restaurante->tipo == 'Entrante' ? 'selected' : '' }}>Entrante</option>
                    <option value="Principal" {{ $restaurante->tipo == 'Principal' ? 'selected' : '' }}>Principal</option>
                    <option value="Postre" {{ $restaurante->tipo == 'Postre' ? 'selected' : '' }}>Postre</option>
                    <option value="Bebida" {{ $restaurante->tipo == 'Bebida' ? 'selected' : '' }}>Bebida</option>
                </select>
                <i class="fas fa-utensils rr-select-icon"></i>
            </div>
        </div>

        <div class="rr-form-group">
            <label for="nombre" class="rr-label">Nombre del Plato</label>
            <div class="rr-input-wrapper">
                <input type="text" class="rr-input" id="nombre" name="nombre" placeholder="Nombre del plato" value="{{ $restaurante->nombre }}" required>
                <i class="fas fa-pencil-alt rr-input-icon"></i>
            </div>
        </div>

        <div class="rr-form-group">
            <label for="precio" class="rr-label">Precio</label>
            <div class="rr-input-wrapper">
                <input type="number" class="rr-input" id="precio" name="precio" placeholder="0.00" step="0.01" value="{{ $restaurante->precio }}" required>
                <i class="fas fa-euro-sign rr-input-icon"></i>
            </div>
        </div>

        <div class="rr-form-group">
            <label for="disponibilidad" class="rr-label">Disponibilidad</label>
            <div class="rr-select-wrapper">
                <select class="rr-select" name="disponibilidad" id="disponibilidad" required>
                    <option value="1" {{ $restaurante->disponibilidad == 1 ? 'selected' : '' }}>Disponible</option>
                    <option value="0" {{ $restaurante->disponibilidad == 0 ? 'selected' : '' }}>No Disponible</option>
                </select>
                <i class="fas fa-check-circle rr-select-icon"></i>
            </div>
        </div>

        <button type="submit" class="rr-submit-btn">
            <i class="fas fa-save"></i>
            Registrar Restaurante
        </button>
    </form>
</div>
@endsection
