<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voucher de Venta #{{ $venta->id }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            width: 100%;
            background-color: white;
        }
        .voucher {
            border: 2px solid #000;
            padding: 25px;
            max-width: 80mm;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            border-bottom: 1px dashed #000;
            padding-bottom: 10px;
        }
        .header h1 {
            font-size: 20px;
            margin: 5px 0;
            text-transform: uppercase;
        }
        .header p {
            font-size: 12px;
            margin: 3px 0;
        }
        .info {
            margin-bottom: 15px;
        }
        .info p {
            margin: 5px 0;
            font-size: 13px;
        }
        .table {
            width: 100%;
            margin: 15px 0;
            border-collapse: collapse;
            font-size: 12px;
        }
        .table th {
            background-color: #f2f2f2;
            text-align: left;
            padding: 5px;
            border-bottom: 1px solid #ddd;
        }
        .table td {
            padding: 5px;
            border-bottom: 1px solid #eee;
        }
        .totals {
            margin-top: 15px;
            font-size: 14px;
        }
        .totals p {
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
        }
        .total-final {
            font-weight: bold;
            font-size: 16px;
            border-top: 1px dashed #000;
            padding-top: 8px;
            margin-top: 8px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 11px;
            border-top: 1px dashed #000;
            padding-top: 10px;
        }
        @media print {
            body {
                padding: 0;
                background: white;
            }
            .voucher {
                border: none;
                box-shadow: none;
                max-width: 100%;
                padding: 10px;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="voucher">
        <!-- Encabezado del voucher -->
        <div class="header">
            <h1>Tienda de Ropa</h1>
            <p>RUC: 12345678901</p>
            <p>Av. Principal 123 - Lima</p>
            <p>Teléfono: (01) 123-4567</p>
        </div>

        <!-- Información de la venta -->
        <div class="info">
            <p><strong>VOUCHER:</strong> #{{ str_pad($venta->id, 6, '0', STR_PAD_LEFT) }}</p>
            <p><strong>FECHA:</strong> {{ $venta->created_at->format('d/m/Y H:i') }}</p>
            <p><strong>CLIENTE:</strong> {{ $venta->nombre_cliente }} {{ $venta->apellido_cliente }}</p>
            <p><strong>DNI:</strong> {{ $venta->dni }}</p>
            <p><strong>ATENDIDO POR:</strong> {{ auth()->user()->name ?? 'Sistema' }}</p>
        </div>

        <!-- Detalle de productos -->
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cant.</th>
                    <th>P.Unit.</th>
                    <th>Desc.</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($venta->productos as $producto)
                    @php
                        $precio_original = $producto->pivot->precio_unitario;
                        $precio_final = $producto->pivot->precio_unitario;
                        $descuento = 0;
                        
                        // Calcular descuento si existe precio con descuento
                        if($producto->precio_descuento && $producto->precio_descuento < $precio_original) {
                            $precio_final = $producto->precio_descuento;
                            $descuento = $precio_original - $precio_final;
                        }
                    @endphp
                    <tr>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->pivot->cantidad }}</td>
                        <td>S/. {{ number_format($precio_original, 2) }}</td>
                        <td>
                            @if($descuento > 0)
                                -S/. {{ number_format($descuento * $producto->pivot->cantidad, 2) }}
                            @else
                                -
                            @endif
                        </td>
                        <td>S/. {{ number_format($precio_final * $producto->pivot->cantidad, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totales -->
        <div class="totals">
            @php
                $subtotal = 0;
                $total_descuentos = 0;
                
                foreach($venta->productos as $producto) {
                    $precio_original = $producto->pivot->precio_unitario;
                    $precio_final = $producto->pivot->precio_unitario;
                    
                    if($producto->precio_descuento && $producto->precio_descuento < $precio_original) {
                        $precio_final = $producto->precio_descuento;
                        $total_descuentos += ($precio_original - $precio_final) * $producto->pivot->cantidad;
                    }
                    
                    $subtotal += $precio_final * $producto->pivot->cantidad;
                }
                
                $igv = $subtotal * 0.18;
                $total = $subtotal;
            @endphp
            
            <p><span>Subtotal:</span> <span>S/. {{ number_format($subtotal, 2) }}</span></p>
            @if($total_descuentos > 0)
                <p><span>Descuentos:</span> <span>-S/. {{ number_format($total_descuentos, 2) }}</span></p>
            @endif
            <p><span>IGV (18%):</span> <span>S/. {{ number_format($igv, 2) }}</span></p>
            <p class="total-final"><span>TOTAL:</span> <span>S/. {{ number_format($total, 2) }}</span></p>
        </div>

        <!-- Pie de página -->
        <div class="footer">
            <p>¡Gracias por su compra!</p>
            <p>Vuelva pronto</p>
            <p>Conserve este voucher para cualquier reclamo</p>
            <p class="no-print">Para imprimir: Ctrl+P o Cmd+P</p>
        </div>
    </div>

    <div class="no-print" style="text-align: center; margin-top: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer;">
            Imprimir Voucher
        </button>
        <a href="{{ route('ventas.index') }}" style="padding: 10px 20px; background: #f44336; color: white; text-decoration: none; border-radius: 4px; margin-left: 10px;">
            Volver a Ventas
        </a>
    </div>
</body>
</html>