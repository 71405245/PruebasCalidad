@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-4">Lista de Ventas</h1>
            
            <!-- Filtros y búsqueda -->
            <div class="d-flex">
                <input type="text" id="searchInput" class="form-danger me-2" placeholder="Buscar ventas..." style="width: 250px;">
                <a href="{{ route('ventas.create') }}" class="btn btn-danger btn-lg">
                    <i class="bi bi-plus-circle"></i> Nueva Venta
                </a>
            </div>
        </div>
        
        <!-- Mensajes de estado -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <!-- Estadísticas resumidas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h5 class="card-title">Ventas Hoy</h5>
                        <p class="card-text display-6">{{ $ventasHoy->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h5 class="card-title">Total Hoy</h5>
                        <p class="card-text display-6">S/. {{ number_format($ventasHoy->sum('total'), 2) }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h5 class="card-title">Ventas Mes</h5>
                        <p class="card-text display-6">{{ $ventasMes->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-dark">
                    <div class="card-body">
                        <h5 class="card-title">Total Mes</h5>
                        <p class="card-text display-6">S/. {{ number_format($ventasMes->sum('total'), 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Tabla de Ventas -->
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0" id="ventasTable">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Productos</th>
                                <th>Cantidad Total</th>
                                <th>Subtotal</th>
                                <th>Descuentos</th>
                                <th>Total</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ventas as $venta)
                                @php
                                    $totalDescuentos = 0;
                                    $subtotal = 0;
                                    $cantidadTotal = 0;
                                    
                                    foreach($venta->productos as $producto) {
                                        $precioOriginal = $producto->pivot->precio_unitario;
                                        $precioFinal = $producto->precio_descuento && $producto->precio_descuento < $precioOriginal 
                                            ? $producto->precio_descuento 
                                            : $precioOriginal;
                                            
                                        $totalDescuentos += ($precioOriginal - $precioFinal) * $producto->pivot->cantidad;
                                        $subtotal += $precioFinal * $producto->pivot->cantidad;
                                        $cantidadTotal += $producto->pivot->cantidad;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                                    <td>{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                {{ $venta->productos->count() }} productos
                                            </button>
                                            <ul class="dropdown-menu">
                                                @foreach ($venta->productos as $producto)
                                                    <li class="dropdown-item">
                                                        {{ $producto->nombre }} ({{ $producto->pivot->cantidad }})
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </td>
                                    <td>{{ $cantidadTotal }}</td>
                                    <td>S/. {{ number_format($subtotal + $totalDescuentos, 2) }}</td>
                                    <td class="text-danger">-S/. {{ number_format($totalDescuentos, 2) }}</td>
                                    <td class="fw-bold">S/. {{ number_format($subtotal, 2) }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('ventas.voucher', $venta->id) }}" class="btn btn-sm btn-info" title="Voucher">
                                                <i class="bi bi-receipt"></i>
                                            </a>
                                            <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-sm btn-warning" title="Editar">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('ventas.destroy', $venta->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar esta venta?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Paginación -->
        <div class="d-flex justify-content-center mt-4">
            {{ $ventas->links() }}
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // Búsqueda en tiempo real
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const input = this.value.toLowerCase();
        const rows = document.querySelectorAll('#ventasTable tbody tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        });
    });
</script>
@endsection

@section('styles')
<style>
    .table th {
        white-space: nowrap;
    }
    .dropdown-menu {
        max-height: 300px;
        overflow-y: auto;
    }
    .table-responsive {
        min-height: 400px;
    }
</style>
@endsection