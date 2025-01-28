@extends('layouts.dashboard')

@section('title', 'Dashboard | Restaurante | Crear')

@section('content')
<div class="mrf-container">
    <div class="mrf-card">
        <h2 class="mrf-title">Registrar Reserva</h2>
        <form id="mrf-form" class="mrf-form" action="{{ route('reservas.store') }}" method="POST">
            @csrf
            <div class="mrf-form-group">
                <label for="habitacion_id" class="mrf-label">
                    <i data-lucide="home"></i> Seleccionar Habitación
                </label>
                <select name="habitacion_id" id="habitacion_id" class="mrf-select" required>
                    <option value="" disabled selected>Seleccione una habitación</option>
                    @foreach($habitaciones as $habitacion)
                        @if($habitacion->estado == 'disponible')  <!-- Solo mostrar habitaciones disponibles -->
                            <option value="{{ $habitacion->id }}" data-precio="{{ $habitacion->precio }}">
                                Habitación N°{{ $habitacion->id }} - {{ $habitacion->tipo }} (Capacidad: {{ $habitacion->capacidad }}) - S/ {{ $habitacion->precio }} por noche
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>            

            <div class="mrf-form-group">
                <label for="cliente_id" class="mrf-label">
                    <i data-lucide="user"></i> Seleccionar Cliente
                </label>
                <select name="cliente_id" id="cliente_id" class="mrf-select" required>
                    <option value="" disabled selected>Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->nombre }} {{ $cliente->apellidos }} (DNI: {{ $cliente->dni }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mrf-form-row">
                <div class="mrf-form-group">
                    <label for="fecha_entrada" class="mrf-label">
                        <i data-lucide="calendar"></i> Fecha de Entrada
                    </label>
                    <input type="date" name="fecha_entrada" id="fecha_entrada" class="mrf-input" required>
                </div>

                <div class="mrf-form-group">
                    <label for="fecha_salida" class="mrf-label">
                        <i data-lucide="calendar"></i> Fecha de Salida
                    </label>
                    <input type="date" name="fecha_salida" id="fecha_salida" class="mrf-input" required>
                </div>
            </div>

            <div class="mrf-form-row">
                <div class="mrf-form-group">
                    <label for="dias_estadia" class="mrf-label">
                        <i data-lucide="clock"></i> Días de Estadía
                    </label>
                    <input type="number" id="dias_estadia" class="mrf-input" readonly>
                </div>

                <div class="mrf-form-group">
                    <label for="costo_total" class="mrf-label">
                        <i data-lucide="dollar-sign"></i> Costo Total
                    </label>
                    <input name="costo_total" type="text" id="costo_total" class="mrf-input" readonly>
                </div>
            </div>

            <div class="mrf-form-group">
                <label for="estado" class="mrf-label">
                    <i data-lucide="check-circle"></i> Estado
                </label>
                <select name="estado" id="estado" class="mrf-select" required>
                    <option value="Pendiente">Pendiente</option>
                    <option value="Confirmada">Confirmada</option>
                    <option value="Cancelada">Cancelada</option>
                </select>
            </div>

            <button type="submit" class="mrf-button">
                <i data-lucide="save"></i> Registrar Reserva
            </button>
        </form>
    </div>
</div>
    
@endsection