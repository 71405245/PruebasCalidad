<<<<<<< HEAD

=======
sales-report.blade.php:
>>>>>>> 2350b95 (código 7)
@extends('layouts.app')

@section('title', 'Reporte de Ventas')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">📊 Reporte de Ventas</h1>

        <form method="GET" class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="date" name="desde" class="form-control" placeholder="Desde" value="{{ request('desde') }}">
            </div>
            <div class="col-md-3">
                <input type="date" name="hasta" class="form-control" placeholder="Hasta"
                    value="{{ request('hasta') }}">
            </div>
            <div class="col-md-3">
                <input type="text" name="cliente" class="form-control" placeholder="Cliente"
                    value="{{ request('cliente') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-outline-primary">Filtrar</button>
                <a href="{{ route('reportes.ventas') }}" class="btn btn-outline-secondary">Limpiar</a>
                <button type="button" id="exportPdfBtn" class="btn btn-danger">PDF</button>
                <a href="{{ route('reportes.ventas.excel') }}" class="btn btn-success">Excel</a>
            </div>
        </form>

        <form id="pdfForm" method="POST" action="{{ route('reportes.ventas.pdf') }}" style="display: none;">
            @csrf
            <input type="hidden" name="grafico_base64" id="grafico_base64">
            <input type="hidden" name="desde" value="{{ request('desde') }}">
            <input type="hidden" name="hasta" value="{{ request('hasta') }}">
            <input type="hidden" name="cliente" value="{{ request('cliente') }}">
        </form>




        <canvas id="ventasChart" height="100"></canvas>

        <table class="table table-bordered mt-4">
            <thead class="table-dark">
                <tr>
                    <th>ID Venta</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</td>
                        <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                        <td>S/. {{ number_format($venta->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('ventasChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($grafico_labels) !!},
                datasets: [{
                    label: 'Total diario (S/.)',
                    data: {!! json_encode($grafico_data) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
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

        document.getElementById('exportPdfBtn').addEventListener('click', function() {
            const canvas = document.getElementById('ventasChart');
            const imgData = canvas.toDataURL('image/png');
            document.getElementById('grafico_base64').value = imgData;

            document.getElementById('pdfForm').submit();
        });
    </script>
@endsection