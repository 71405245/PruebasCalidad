<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte de Ventas - {{ now()->format('d/m/Y') }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .chart-container {
            text-align: center;
            margin: 20px auto;
        }

        .chart-container img {
            max-width: 100%;
            height: auto;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }
    </style>
</head>

<body>
    <h1>Reporte de Ventas</h1>

    <div class="header-info">
        <p><strong>Fecha del reporte:</strong> {{ now()->format('d/m/Y H:i') }}</p>
        @if (request('desde') || request('hasta'))
            <p><strong>Período:</strong>
                {{ request('desde') ? \Carbon\Carbon::parse(request('desde'))->format('d/m/Y') : 'Inicio' }}
                al
                {{ request('hasta') ? \Carbon\Carbon::parse(request('hasta'))->format('d/m/Y') : 'Actual' }}
            </p>
        @endif
        @if (request('cliente'))
            <p><strong>Cliente:</strong> {{ request('cliente') }}</p>
        @endif
    </div>

    @if (!empty($grafico_base64))
        <div class="chart-container">
            <img src="{{ $grafico_base64 }}" alt="Gráfico de ventas">
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total (S/.)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ventas as $venta)
                <tr>
                    <td>{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</td>
                    <td>{{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</td>
                    <td>{{ $venta->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($venta->total, 2) }}</td>
                </tr>
            @endforeach
            <tr class="total-row">
                <td colspan="3" style="text-align: right;">TOTAL:</td>
                <td>{{ number_format($ventas->sum('total'), 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
