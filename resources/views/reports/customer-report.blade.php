@extends('layouts.app')

@section('title', 'Reporte de Clientes')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">👥 Reporte de Clientes</h1>

        <canvas id="clientesChart" height="100"></canvas>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Compras Realizadas</th>
                    <th>Última Compra</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente['nombre_completo'] }}</td>
                        <td>{{ $cliente['ventas_count'] }}</td>
                        <td>
                            @if (!empty($cliente['ultima_compra']))
                                {{ \Carbon\Carbon::parse($cliente['ultima_compra'])->format('d/m/Y') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @include('reports.partials.ai-assistant', ['reportContext' => 'customers'])
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const clientesChart = document.getElementById('clientesChart').getContext('2d');
        const chart = new Chart(clientesChart, {
            type: 'bar',
            data: {
                labels: {!! json_encode($clientes->pluck('nombre_cliente')) !!},
                datasets: [{
                    label: 'Compras Realizadas',
                    data: {!! json_encode($clientes->pluck('ventas_count')) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script>
        const clientesChart = document.getElementById('clientesChart').getContext('2d');
        const nombresClientes = {!! json_encode(array_column($clientes, 'nombre_completo')) !!};
        const ventasCounts = {!! json_encode(array_column($clientes, 'ventas_count')) !!};

        const chart = new Chart(clientesChart, {
            type: 'bar',
            data: {
                labels: nombresClientes,
                datasets: [{
                    label: 'Compras Realizadas',
                    data: ventasCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
