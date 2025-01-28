@extends('layouts.dashboard')

@section('title', 'Dashboard | Restaurante')

@section('content')
<div class="rd-dashboard-container">
    <h1 class="rd-title"><i class="fas fa-utensils"></i> Dashboard de Restaurante</h1>
    
    <div class="rd-actions">
        <form id="searchForm" class="rd-search-form">
            <div class="rd-search-group">
                <input type="text" id="searchInput" class="rd-search-input" placeholder="Buscar por nombre o tipo">
                <button type="submit" class="rd-btn rd-search-btn">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
        </form>

        <a href="{{ route('restaurante.create') }}" id="addDishBtn" class="rd-btn rd-btn-add">
            <i class="fas fa-plus"></i> Registrar nuevo plato
        </a>
    </div>

    <div class="rd-table-container">
        <table class="rd-restaurante-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Disponibilidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="dishTableBody">
                @foreach ($restaurantes as $restaurante)
                    <tr>
                        <td>{{ $restaurante->id }}</td>
                        <td>{{ $restaurante->tipo }}</td>
                        <td>{{ $restaurante->nombre }}</td>
                        <td>S/ {{ number_format($restaurante->precio, 2) }}</td>
                        <td>
                            <span class="rd-status {{ $restaurante->disponibilidad ? 'rd-status-available' : 'rd-status-unavailable' }}">
                                {{ $restaurante->disponibilidad ? 'Disponible' : 'Agotado' }}
                            </span>
                        </td>
                        <td class="rd-actions-cell">
                            <a href="{{ route('restaurante.show', $restaurante->id) }}" class="rd-btn rd-btn-view" >
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('restaurante.edit', $restaurante->id) }}" class="rd-btn rd-btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>

                            <form action="{{ route('restaurante.destroy', $restaurante->id) }}" class="rd-btn rd-btn-delete" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="rd-btn rd-btn-delete" style="background: none; border: none; padding: 0; cursor: pointer;">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
