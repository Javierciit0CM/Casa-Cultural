@extends('layouts.dashboard')

@section('title', 'Dashboard | Reservas')

@section('content')
<div class="dashboard-container">
    <header class="dashboard-header">
        <h1 class="dashboard-title">Reservas</h1>
    </header>
    <main class="dashboard-main">
        <section class="calendar-section">
            <div class="calendar-container">
                <div class="calendar-header">
                    <button id="prevYear" class="calendar-btn"><i class="fas fa-angle-double-left"></i></button>
                    <button id="prevMonth" class="calendar-btn"><i class="fas fa-angle-left"></i></button>
                    <h2 id="currentMonthYear" class="current-date">Mes Año</h2>
                    <button id="nextMonth" class="calendar-btn"><i class="fas fa-angle-right"></i></button>
                    <button id="nextYear" class="calendar-btn"><i class="fas fa-angle-double-right"></i></button>
                </div>
                <div class="calendar-body">
                    <div class="calendar-weekdays" id="calendarWeekdays"></div>
                    <div class="calendar-days" id="calendarDays"></div>
                </div>
            </div>
            <div class="legend">
                <span class="legend-item"><span class="legend-color pending"></span> Pendiente</span>
                <span class="legend-item"><span class="legend-color confirmed"></span> Confirmado</span>
                <span class="legend-item"><span class="legend-color cancelled"></span> Cancelado</span>
            </div>
        </section>
        <section class="reservations-section">
            <div class="search-bar">
                <div class="search-input-container">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="searchInput" class="search-input" placeholder="Buscar reserva..." />
                </div>
                <a href="{{ route('reservas.create') }} " id="addReservation" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nueva Reserva
                </a>
            </div>
            <div class="table-container">
                <table class="reservations-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Habitación</th>
                            <th>Entrada</th>
                            <th>Salida</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="reservationTable">
                        @foreach ($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->id }}</td>
                            <td class="truncate">{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellidos }}</td>
                            <td class="truncate">{{ $reserva->habitacion->tipo_habitacion }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->fecha_entrada)->format('d/m/y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($reserva->fecha_salida)->format('d/m/y') }}</td>
                            <td>
                                <span class="status status-{{ strtolower($reserva->estado) }}">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </td>
                            <td class="btn-group">
                                <button type="button" class="btn btn-icon btn-info" aria-label="Ver" data-id="{{ $reserva->id }}" data-cliente="{{ $reserva->cliente->nombre }} {{ $reserva->cliente->apellidos }}" data-dni="{{ $reserva->cliente->dni }}" data-telefono="{{ $reserva->cliente->telefono }}" data-edad="{{ $reserva->cliente->edad }}" data-procedencia="{{ $reserva->cliente->procedencia }}" data-condicion="{{ $reserva->cliente->condicion }}" data-habitacion="{{ $reserva->habitacion->tipo_habitacion }}" data-precio="{{ $reserva->habitacion->precio }}" data-capacidad="{{ $reserva->habitacion->capacidad_maxima }}" data-descripcion="{{ $reserva->habitacion->descripcion }}" data-numero="{{ $reserva->habitacion->numero_habitacion }}" data-entrada="{{ $reserva->fecha_entrada }}" data-salida="{{ $reserva->fecha_salida }}" data-estado="{{ ucfirst($reserva->estado) }}" onclick="elegantModal(this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button class="btn btn-warning btn-edit" aria-label="Editar" data-id="{{ $reserva->id }}" data-estado="{{ $reserva->estado }}" onclick="openEditModal(this)">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <form action="{{route('reservas.destroy', $reserva->id)}}" method="POST" aria-label="Eliminar">
                                    @csrf 
                                    @method('DELETE')
                                    <button class="btn btn-icon btn-danger" type="submit">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>   
            </div>
        </section>
    </main>
</div>

    {{-- MODAL PARA VER LOS DETALLES DE LA RESERVA --}}
    <div id="elegantModal" class="elegant-modal">
        <div class="elegant-modal-content">
            <div class="elegant-modal-header">
                <h2><i class="fas fa-concierge-bell"></i> Detalles de la Reservación</h2>
                <button type="button" class="elegant-close-modal" onclick="closeModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="elegant-modal-body">
                <div class="elegant-reservation-summary">
                    <div class="summary-item" id="modal-estado"></div>
                    <div class="summary-item" id="modal-fechas"></div>
                    <div class="summary-item" id="modal-id"></div>
                </div>
                <div class="elegant-reservation-details">
                    <div class="elegant-detail-section client-info">
                        <h3><i class="fas fa-user-circle"></i> Información del Cliente</h3>
                        <div class="elegant-detail-grid">
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-user"></i> Nombre</span>
                                <span id="modal-cliente" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-passport"></i> DNI</span>
                                <span id="modal-dni" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-phone"></i> Teléfono</span>
                                <span id="modal-telefono" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-birthday-cake"></i> Edad</span>
                                <span id="modal-edad" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-map-marker-alt"></i> Procedencia</span>
                                <span id="modal-procedencia" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-info-circle"></i> Condición</span>
                                <span id="modal-condicion" class="elegant-detail-value"></span>
                            </div>
                        </div>
                    </div>
                    <div class="elegant-detail-section room-info">
                        <h3><i class="fas fa-hotel"></i> Detalles de la Habitación</h3>
                        <div class="elegant-detail-grid">
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-bed"></i> Tipo</span>
                                <span id="modal-habitacion" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-door-open"></i> Número</span>
                                <span id="modal-numero" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-users"></i> Capacidad</span>
                                <span id="modal-capacidad" class="elegant-detail-value"></span>
                            </div>
                            <div class="elegant-detail-item">
                                <span class="elegant-detail-label"><i class="fas fa-dollar-sign"></i> Precio</span>
                                <span id="modal-precio" class="elegant-detail-value"></span>
                            </div>
                        </div>
                        <div class="elegant-detail-item full-width">
                            <span class="elegant-detail-label"><i class="fas fa-align-left"></i> Descripción</span>
                            <span id="modal-descripcion" class="elegant-detail-value"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FIN --}}

    {{-- MODAL PARA ACTUALIZAR EL ESTADO DE LA RESERVA --}}
    <div id="editModal" class="modal hidden modal-custom">
        <div class="modal-content modal-custom-content">
            <div class="modal-header modal-custom-header">
                <h5 class="modal-title">Editar Estado de Reserva</h5>
                <button class="close-modal btn-close-modal" onclick="closeEditModal()">&times;</button>
            </div>
            <div class="modal-body modal-custom-body">
                <form action="{{ route('reservas.update', $reserva->id) }}" id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group modal-form-group">
                        <label for="reservationStatus" class="modal-label">Estado de la Reserva</label>
                        <select id="reservationStatus" name="estado" class="modal-select">
                            <option value="Pendiente">Pendiente</option>
                            <option value="Confirmada">Confirmado</option>
                            <option value="Cancelada">Cancelado</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-submit">Actualizar</button>
                        <button type="button" class="btn btn-cancel" onclick="closeEditModal()">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- FIN --}}

</div>
@endsection