@extends('layouts.dashboard')

@section('title', 'Dashboard | Habitaciones | Registrar')

@section('content')
<div class="rm-container-c">
    <h1 class="rm-title"><i class="fas fa-hotel"></i> Registro de Habitación</h1>
    <form action="{{ route('habitaciones.store') }}" method="POST" id="rmRoomRegistrationForm" class="rm-form" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="rm-alert rm-alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="rm-form-group">
            <label for="rmRoomImages" class="rm-file-label">
                <i class="fas fa-images"></i> Imágenes de la Habitación
            </label>
            <div class="rm-file-upload-container">
                <div class="rm-file-upload">
                    <input type="file" name="img[]" id="rmRoomImages" accept="image/*" class="rm-file-input" multiple>
                    <label for="rmRoomImages" class="rm-file-button">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Agregar Imágenes</span>
                    </label>
                </div>
                <div id="rmImagePreview" class="rm-image-preview"></div>
            </div>
        </div>

        <div class="rm-form-row">
            <div class="rm-form-group">
                <label for="rmTipoHabitacion">
                    <i class="fas fa-bed"></i> Tipo de Habitación
                </label>
                <select name="tipo_habitacion" id="rmTipoHabitacion" required>
                    <option value="" disabled selected>Seleccione tipo...</option>
                    <option value="Simples">Simple</option>
                    <option value="Doble">Doble</option>
                    <option value="Matrimonial">Matrimonial</option>
                    <option value="Grupal">Grupal</option>
                </select>
            </div>
            <div class="rm-form-group">
                <label for="rmCapacidadMaxima">
                    <i class="fas fa-users"></i> Capacidad Máxima
                </label>
                <input type="number" name="capacidad_maxima" id="rmCapacidadMaxima" required>
            </div>
        </div>

        <div class="rm-form-row">
            <div class="rm-form-group">
                <label for="rmPrecio">
                    <i class="fas fa-tag"></i> Precio
                </label>
                <input type="number" name="precio" id="rmPrecio" step="0.01" min="0" required>
            </div>
            <div class="rm-form-group">
                <label for="rmNumeroHabitacion">
                    <i class="fas fa-door-closed"></i> Número de Habitación
                </label>
                <input type="number" name="numero_habitacion" id="rmNumeroHabitacion" required>
            </div>
        </div>

        <div class="rm-form-group">
            <label for="rmDescripcion">
                <i class="fas fa-info-circle"></i> Descripción
            </label>
            <textarea name="descripcion" id="rmDescripcion" rows="3" required></textarea>
        </div>

        <button type="submit" class="rm-btn rm-btn-primary rm-btn-block">
            <i class="fas fa-save"></i>
            <span>Registrar Habitación</span>
        </button>
    </form>
</div>
@endsection