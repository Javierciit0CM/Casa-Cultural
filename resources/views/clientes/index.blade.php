@extends('layouts.dashboard')

@section('title', 'Dashboard | Clientes')

@section('content')
<div class="cm-container">
    <header class="cm-header">
        <h1 class="cm-title">Gestión de Clientes</h1>
    </header>
    
    <main class="cm-main">
        <div class="cm-actions">
            <form method="GET" action="{{ route('clientes.index') }}" class="cm-search-form">
                <div class="cm-search-group">
                    <input type="text" name="search" id="search" class="cm-search-input" placeholder="Buscar cliente...">
                    <button class="cm-btn cm-btn-search" type="submit">
                        <i class="fas fa-search"></i>
                        <span class="cm-btn-text">Buscar</span>
                    </button>
                </div>
            </form>
            <a href="{{ route('clientes.create') }}" class="cm-btn cm-btn-primary">
                <i class="fas fa-plus"></i>
                <span class="cm-btn-text">Registrar Cliente</span>
            </a>
        </div>

        <div class="cm-table-container">
            <table class="cm-table" id="cmClientesTable">
                <thead>
                    <tr>
                        <th scope="col">DNI</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Edad</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Procedencia</th>
                        <th scope="col">Condición</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody id="cliente-table-body">
                    @foreach($clientes as $cliente)
                        <tr>
                            <td>{{ $cliente->dni }}</td>
                            <td>{{ $cliente->nombre }}</td>
                            <td>{{ $cliente->apellidos }}</td>
                            <td>{{ $cliente->edad }}</td>
                            <td>{{ $cliente->telefono }}</td>
                            <td>{{ $cliente->procedencia }}</td>
                            <td>{{ $cliente->condicion }}</td>
                            <td>
                                <div class="cm-btn-group">
                                    <button class="cm-btn cm-btn-icon cm-btn-info" onclick="openViewModal({{ $cliente->id }}, '{{ $cliente->nombre }}', '{{ $cliente->apellidos }}', '{{ $cliente->edad }}', '{{ $cliente->telefono }}', '{{ $cliente->procedencia }}', '{{ $cliente->condicion }}')" title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="cm-btn cm-btn-icon cm-btn-warning" onclick="openEditModal({{ $cliente->id }}, '{{ $cliente->nombre }}', '{{ $cliente->apellidos }}', '{{ $cliente->edad }}', '{{ $cliente->telefono }}', '{{ $cliente->procedencia }}', '{{ $cliente->condicion }}')" title="Editar cliente">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST" class="cm-delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cm-btn cm-btn-icon cm-btn-danger" title="Eliminar cliente">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>
@endsection
