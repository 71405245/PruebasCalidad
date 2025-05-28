@extends('layouts.app')

@section('title', 'Reporte de Inventario')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">📦 Reporte de Inventario</h1>

        <canvas id="stockChart" height="100"></canvas>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID Producto</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Stock</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->id }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td class="fw-bold {{ $producto->stock == 0 ? 'text-danger' : 'text-success' }}">
                            {{ $producto->stock == 0 ? 'Agotado' : 'Disponible' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const stockChart = document.getElementById('stockChart').getContext('2d');
        const chart = new Chart(stockChart, {
            type: 'pie',
            data: {
                labels: ['Disponibles', 'Agotados'],
                datasets: [{
                    data: [
                        {{ $productos->where('stock', '>', 0)->count() }},
                        {{ $productos->where('stock', '=', 0)->count() }}
                    ],
                    backgroundColor: ['#28a745', '#dc3545']
                }]
            }
        });
    </script>
@endsection
