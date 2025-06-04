@extends('layouts.app')

@section('title', 'Reporte de Ventas')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">📊 Reporte de Ventas</h1>

        <!-- Filtros -->
        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="date" name="desde" class="form-control" placeholder="Desde" value="{{ request('desde') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="hasta" class="form-control" placeholder="Hasta" value="{{ request('hasta') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="cliente" class="form-control" placeholder="Cliente" value="{{ request('cliente') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-primary">Filtrar</button>
                <a href="{{ route('reportes.ventas') }}" class="btn btn-outline-secondary">Limpiar</a>
                <button type="button" id="exportPdfBtn" class="btn btn-danger">PDF</button>
                <a href="{{ route('reportes.ventas.excel') }}" class="btn btn-success">Excel</a>
            </div>
        </form>

        <!-- Formulario oculto para PDF -->
        <form id="pdfForm" method="POST" action="{{ route('reportes.ventas.pdf') }}" style="display: none;">
            @csrf
            <input type="hidden" name="grafico_base64" id="grafico_base64">
            <input type="hidden" name="desde" value="{{ request('desde') }}">
            <input type="hidden" name="hasta" value="{{ request('hasta') }}">
            <input type="hidden" name="cliente" value="{{ request('cliente') }}">
        </form>

        <!-- Gráfico -->
        @if(isset($grafico_labels) && isset($grafico_data))
            <div class="chart-container mb-4" style="position: relative; height:300px;">
                <canvas id="ventasChart"></canvas>
            </div>
        @endif

        <!-- Tabla de ventas -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>ID Venta</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($ventas as $venta)
                        <tr>
                            <td>{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</td>
                            <td>{{ $venta->created_at->format('d/m/Y H:i') }}</td>
                            <td class="text-end">S/. {{ number_format($venta->total, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron ventas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Paginación -->
        @if($ventas->hasPages())
            <div class="d-flex justify-content-center mt-3">
                {{ $ventas->links() }}
            </div>
        @endif

        <!-- Asistente IA -->
        @include('reports.partials.ai-assistant', ['reportContext' => 'sales'])
    </div>

    <!-- Scripts -->
    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if(isset($grafico_labels) && isset($grafico_data))
                    // Configuración del gráfico
                    const ctx = document.getElementById('ventasChart').getContext('2d');
                    const ventasChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: @json($grafico_labels),
                            datasets: [{
                                label: 'Total diario (S/.)',
                                data: @json($grafico_data),
                                backgroundColor: 'rgba(220, 53, 69, 0.6)',
                                borderColor: 'rgba(220, 53, 69, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        callback: function(value) {
                                            return 'S/.' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return 'S/.' + context.raw.toLocaleString();
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Exportar a PDF
                    document.getElementById('exportPdfBtn').addEventListener('click', function() {
                        const canvas = document.getElementById('ventasChart');
                        const imgData = canvas.toDataURL('image/png');
                        document.getElementById('grafico_base64').value = imgData;
                        document.getElementById('pdfForm').submit();
                    });
                @endif
            });
        </script>
    @endsection
@endsection