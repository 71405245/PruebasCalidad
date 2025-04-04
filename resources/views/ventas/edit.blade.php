@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="display-4 text-center mb-4">Lista de Ventas</h1>
        
        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Botón de Registrar Venta -->
        <div class="text-end mb-3">
            <a href="{{ route('ventas.create') }}" class="btn btn-success btn-lg rounded-pill px-4 py-2">
                <i class="bi bi-plus-circle"></i> Registrar Venta
            </a>
        </div>
        
        <!-- Tabla de Ventas -->
        <table class="table table-striped table-bordered table-hover shadow-sm rounded">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ optional($venta->productos->first())->nombre }}</td> <!-- Ajusté esto a 'productos' -->
                        <td>{{ $venta->productos->sum('pivot.cantidad') }}</td> <!-- Muestra la cantidad total de productos -->
                        <td>{{ $venta->total }}</td>
                        <td>
                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-warning btn-sm rounded-pill">
                                <i class="bi bi-pencil-square"></i> Editar
                            </a>
                            
                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" style="display:inline;">
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
