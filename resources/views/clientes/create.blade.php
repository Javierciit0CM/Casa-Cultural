@extends('layouts.dashboard')

@section('title', 'Dashboard | Clientes | Crear')

@section('content')
<div class="rnp-container">
    <div class="rnp-form-container">
        <h2 class="rnp-form-title"><i class="fas fa-user-plus"></i> Registrar Nueva Persona</h2>

        <div id="rnp-errorContainer" class="rnp-alert rnp-alert-danger">
            <ul id="rnp-errorList"></ul>
        </div>

        <form action="{{ route('clientes.store') }}" method="POST" id="rnp-personaForm" class="rnp-form">
            @csrf
            <div class="rnp-form-row">
                <div class="rnp-form-group">
                    <label for="rnp-dni" class="rnp-form-label"><i class="fas fa-id-card"></i> DNI</label>
                    <input type="text" class="rnp-form-input" id="rnp-dni" name="dni" placeholder="Ingrese el DNI" maxlength="8" required>
                </div>
                <div class="rnp-form-group">
                    <label for="rnp-edad" class="rnp-form-label"><i class="fas fa-birthday-cake"></i> Edad</label>
                    <input type="number" class="rnp-form-input" id="rnp-edad" name="edad" placeholder="Ingrese la edad" min="1" required>
                </div>
            </div>

            <div class="rnp-form-row">
                <div class="rnp-form-group">
                    <label for="rnp-nombre" class="rnp-form-label"><i class="fas fa-user"></i> Nombre</label>
                    <input type="text" class="rnp-form-input" id="rnp-nombre" name="nombre" placeholder="Ingrese el nombre" required>
                </div>
                <div class="rnp-form-group">
                    <label for="rnp-apellidos" class="rnp-form-label"><i class="fas fa-user"></i> Apellidos</label>
                    <input type="text" class="rnp-form-input" id="rnp-apellidos" name="apellidos" placeholder="Ingrese los apellidos" required>
                </div>
            </div>

            <div class="rnp-form-row">
                <div class="rnp-form-group">
                    <label for="rnp-telefono" class="rnp-form-label"><i class="fas fa-phone"></i> Teléfono</label>
                    <input type="text" class="rnp-form-input" id="rnp-telefono" name="telefono" placeholder="Ingrese el teléfono" maxlength="9" required>
                </div>
                <div class="rnp-form-group">
                    <label for="rnp-procedencia" class="rnp-form-label"><i class="fas fa-map-marker-alt"></i> Procedencia</label>
                    <input type="text" class="rnp-form-input" id="rnp-procedencia" name="procedencia" placeholder="Ingrese la procedencia" required>
                </div>
            </div>

            <div class="rnp-form-group">
                <label for="rnp-condicion" class="rnp-form-label"><i class="fas fa-notes-medical"></i> Condición</label>
                <textarea class="rnp-form-textarea" id="rnp-condicion" name="condicion" placeholder="Ingrese la condición" rows="4" required></textarea>
            </div>

            <button type="submit" class="rnp-form-button"><i class="fas fa-save"></i> Registrar</button>
        </form>
    </div>
</div>
@endsection