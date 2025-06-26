<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $data = $this->getDashboardData();
        return view('dashboard', $data);
    }

    private function getDashboardData()
    {
        // Estadísticas básicas de ventas (usaremos ventas como proxy para clientes)
        $totalVentas = Venta::count();
        $ventasMesPasado = Venta::whereBetween('created_at', [
            now()->subMonth()->startOfMonth(), 
            now()->subMonth()->endOfMonth()
        ])->count();

        $ventasMesActual = Venta::whereBetween('created_at', [
            now()->startOfMonth(), 
            now()->endOfMonth()
        ])->count();

        $tasaCrecimiento = $ventasMesPasado > 0
            ? round(($ventasMesActual - $ventasMesPasado) / $ventasMesPasado * 100, 2)
            : 100;

        // Como no tenemos planes, usaremos el total de ventas como proxy
        $distribucionPlanes = [
            'Basico' => $ventasMesActual * 0.6, // Ejemplo: 60% básico
            'Premium' => $ventasMesActual * 0.3, // 30% premium
            'Gold' => $ventasMesActual * 0.1 // 10% gold
        ];

        // Datos de "sucursales" (en este caso, simularemos con datos de ejemplo)
        $sucursales = [
            'Lima' => ['activos' => rand(50, 100), 'inactivos' => rand(10, 30)],
            'Arequipa' => ['activos' => rand(30, 80), 'inactivos' => rand(5, 20)],
            'Trujillo' => ['activos' => rand(20, 60), 'inactivos' => rand(3, 15)]
        ];

        // Ventas recientes (usaremos las ventas reales)
        $ventasRecientes = Venta::with('productos')
                                ->orderBy('created_at', 'desc')
                                ->limit(5)
                                ->get();

        // Movimiento de ventas (simulado)
        $movimientoVentas = Venta::select([
                                    'id',
                                    'nombre_cliente',
                                    'apellido_cliente',
                                    'created_at',
                                    'total'
                                ])
                                ->orderBy('created_at', 'desc')
                                ->limit(10)
                                ->get();

        // Datos para el gráfico de movimiento (últimos 12 meses)
        $graficoMovimientoLabels = [];
        $graficoMovimientoAltas = [];
        $graficoMovimientoBajas = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthStart = $date->copy()->startOfMonth();
            $monthEnd = $date->copy()->endOfMonth();

            $graficoMovimientoLabels[] = $date->format('M Y');
            
            $graficoMovimientoAltas[] = Venta::whereBetween('created_at', [$monthStart, $monthEnd])
                                          ->count();
            
            // Como no tenemos cancelaciones, usaremos un porcentaje aleatorio
            $graficoMovimientoBajas[] = round($graficoMovimientoAltas[11 - $i] * 0.2);
        }

        return [
            'clientesActivos' => $totalVentas, // Usamos total de ventas como proxy
            'clientesInactivos' => 0, // No tenemos este dato
            'tasaCrecimiento' => $tasaCrecimiento,
            'clientesMesActual' => $ventasMesActual,
            'clientesMesPasado' => $ventasMesPasado,
            'distribucionPlanes' => $distribucionPlanes,
            'sucursales' => $sucursales,
            'clientesRecientes' => $ventasRecientes,
            'movimientoClientes' => $movimientoVentas,
            'graficoMovimientoLabels' => $graficoMovimientoLabels,
            'graficoMovimientoAltas' => $graficoMovimientoAltas,
            'graficoMovimientoBajas' => $graficoMovimientoBajas
        ];
    }

    public function exportPdf(Request $request)
    {
        $data = $this->getDashboardData();
        
        $pdf = Pdf::loadView('dashboard-pdf', array_merge($data, [
            'grafico_clientes_base64' => $request->grafico_clientes_base64,
            'grafico_planes_base64' => $request->grafico_planes_base64,
            'grafico_movimiento_base64' => $request->grafico_movimiento_base64,
            'desde' => $request->desde,
            'hasta' => $request->hasta
        ]));

        return $pdf->download('reporte_dashboard.pdf');
    }
}