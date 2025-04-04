@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="display-4 text-center mb-4">Lista de Productos</h1>
        
        <!-- Botón de Agregar Producto -->
        <div class="text-end mb-3">
            <a href="{{ route('productos.create') }}" class="btn btn-success btn-lg rounded-pill px-4 py-2">
                <i class="bi bi-plus-circle"></i> Agregar Producto
            </a>
        </div>
        
        <!-- Tabla de Productos -->
        <table class="table table-striped table-bordered table-hover shadow-sm rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm rounded-pill">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm rounded-pill">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
