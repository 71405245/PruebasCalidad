<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher de Venta</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            width: 100%;
        }
        .voucher {
            border: 1px solid #000;
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background-color: #f8f8f8;
        }
        .voucher h1 {
            text-align: center;
            font-size: 24px;
            margin-bottom: 20px;
        }
        .voucher p {
            font-size: 16px;
            margin: 5px 0;
        }
        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .table th {
            background-color: #f2f2f2;
        }
        .total {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="voucher">
        <h1>Voucher de Venta</h1>

        <p><strong>Cliente:</strong> {{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</p>
        <p><strong>DNI:</strong> {{ $venta->dni }}</p>
        <p><strong>ID de Venta:</strong> {{ $venta->id }}</p>

        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->productos as $producto)
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->pivot->cantidad }}</td>
                        <td>S/. {{ number_format($producto->pivot->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <p class="total">Total: S/. {{ number_format($venta->total, 2) }}</p>
    </div>
</body>
</html>
