@extends('layouts.dashboard')

@section('title', 'Dashboard | Reportes')

@section('content')
<div class="hdr-content">
    <h2 class="hdr-title">Reportes</h2>

    <div class="hdr-card-container">
        <div class="hdr-card hdr-card-rooms">
            <h4 class="hdr-card-title">Estado de Habitaciones</h4>
            <div class="hdr-card-body">
                <p>
                    <i class="fas fa-bed"></i> 
                    <strong>Ocupadas:</strong> 
                    <span class="hdr-percentage" data-target="{{ number_format($porcentajeOcupadas, 0) }}">{{ number_format($porcentajeOcupadas, 0) }}</span>%
                </p>
                <p>
                    <i class="fas fa-door-open"></i> 
                    <strong>Disponibles:</strong> 
                    <span class="hdr-count" data-target="{{ $disponibles }}">{{ $disponibles }}</span>
                </p>
            </div>
        </div>
        

        <div class="hdr-card hdr-card-income">
            <h4 class="hdr-card-title">Ingreso Diario</h4>
            <div class="hdr-card-body">
                <p>
                    <i class="fas fa-coins"></i> 
                    <strong>Monto:</strong> 
                    S/ <span class="hdr-amount" data-target="{{ number_format($ingresosHoy, 2) }}">{{ number_format($ingresosHoy, 2) }}</span>
                </p>
            </div>
        </div>        

        <div class="hdr-card hdr-card-reviews">
            <h4 class="hdr-card-title">Reseñas de Clientes</h4>
            <div class="hdr-card-body">
                <p>
                    <strong>Valoración:</strong>
                    <span class="hdr-stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </span>
                    (4/5)
                </p>
            </div>
        </div>
    </div>

    <div class="hdr-table-container">
        <h4 class="hdr-table-title">Nuevas Reservaciones de Hoy</h4>
        <div class="hdr-table-responsive">
            <table class="hdr-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente</th>
                        <th>Habitación</th>
                        <th>Entrada</th>
                        <th>Salida</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservas as $reserva)
                        @if ($reserva->created_at->toDateString() == \Carbon\Carbon::today()->toDateString() && $reserva->estado == 'Confirmada')  <!-- Solo las reservas creadas hoy y con estado confirmada -->
                            <tr>
                                <td>{{ $reserva->id }}</td>
                                <td>{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellidos }}</td>
                                <td>{{ $reserva->habitacion->tipo_habitacion }}</td>
                                <td>{{ $reserva->fecha_entrada }}</td>
                                <td>{{ $reserva->fecha_salida }}</td>
                                <td>
                                    <span class="hdr-status 
                                        @if($reserva->estado == 'confirmada') hdr-status-confirmed
                                        @elseif($reserva->estado == 'pendiente') hdr-status-pending
                                        @elseif($reserva->estado == 'cancelada') hdr-status-cancelled
                                        @endif">
                                        {{ ucfirst($reserva->estado) }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>            
        </div>
    </div>
    
</div>
@endsection