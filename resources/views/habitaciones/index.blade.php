@extends('layouts.dashboard')

@section('title', 'Dashboard | Habitaciones')

@section('content')
<div class="rm-container">
    <header class="rm-header">
        <h1 class="rm-title">Gestión de Habitaciones</h1>
    </header>
    
    <main class="rm-main">
        <div class="rm-actions">
            <form method="GET" action="{{ route('habitaciones.index') }}" class="rm-search-form">
                <div class="rm-search-group">
                    <input type="text" name="search" class="rm-search-input" placeholder="Buscar por nombre o número">
                    <button class="rm-btn rm-btn-search" type="submit">
                        <i class="fas fa-search"></i>
                        <span class="rm-btn-text">Buscar</span>
                    </button>
                </div>
            </form>
            <a href="{{ route('habitaciones.create') }}" class="rm-btn rm-btn-primary">
                <i class="fas fa-plus"></i>
                <span class="rm-btn-text">Registrar Habitación</span>
            </a>
        </div>

        <div class="rm-table-container">
            <table class="rm-table" id="rmHabitacionesTable">
                <thead>
                    <tr>
                        <th scope="col">Número</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Capacidad</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($habitaciones) && $habitaciones->isNotEmpty())
                        @foreach ($habitaciones as $habitacion)
                            <tr>
                                <td>{{ $habitacion->numero_habitacion }}</td>
                                <td>{{ ucfirst($habitacion->tipo_habitacion) }}</td>
                                <td>{{ $habitacion->capacidad_maxima }}</td>
                                <td>S/ {{ number_format($habitacion->precio, 2) }}</td>
                                <td>{{ Str::limit($habitacion->descripcion, 50) }}</td>
                                <td>{{ $habitacion->comodidades}}</td>
                                <td>
                                    <span class="rm-badge rm-badge-{{ 
                                        $habitacion->estado == 'ocupado' ? 'danger' : 
                                        ($habitacion->estado == 'reservado' ? 'warning' : 
                                        ($habitacion->estado == 'disponible' ? 'success' : '')) }}">
                                        <i class="fas fa-{{ 
                                            $habitacion->estado == 'ocupado' ? 'times-circle' : 
                                            ($habitacion->estado == 'reservado' ? 'minus-circle' : 
                                            ($habitacion->estado == 'disponible' ? 'check-circle' : '')) }}">
                                        </i>
                                        {{ ucfirst($habitacion->estado) }}
                                    </span>                                                                                                                                                                                                            
                                </td>
                                <td>
                                    <div class="rm-btn-group">
                                        <a href="{{ route('habitaciones.show', $habitacion->id) }}" class="rm-btn-i rm-btn-icon rm-btn-info" title="Ver detalles">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('habitaciones.edit', $habitacion->id) }}" class="rm-btn-i rm-btn-icon rm-btn-warning" title="Editar Habitación">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('habitaciones.destroy', $habitacion->id) }}" method="POST" class="rm-delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rm-btn-i rm-btn-icon rm-btn-danger" title="Eliminar Habitación">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="7" class="rm-no-results">No hay habitaciones registradas.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </main>
</div>  
@endsection
