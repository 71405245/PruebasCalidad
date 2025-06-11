<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function dashboard()
    {
        // Datos para el gráfico del dashboard
        $ventasDashboard = Venta::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('SUM(total) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $grafico_labels = $ventasDashboard->pluck('date')
            ->map(fn($date) => \Carbon\Carbon::parse($date)->format('d M'))
            ->toArray();

        $grafico_data = $ventasDashboard->pluck('total')->toArray();

        // Obtener datos para las secciones del dashboard
        $ventasTotales = Venta::sum('total');
        $ventasRecientes = Venta::with('productos')->latest()->take(5)->get();
        $productos = Producto::with('categoria')->orderBy('stock')->take(10)->get();
        $clientes = $this->getClientesData();
        $productosBajoStock = Producto::where('stock', '<', 10)->count();
        $totalProductos = Producto::count();
        $clientesNuevos = Venta::distinct('nombre_cliente', 'apellido_cliente')->count();

        return view('reports.dashboard', compact(
            'grafico_labels',
            'grafico_data',
            'ventasRecientes',
            'productos',
            'clientes',
            'ventasTotales',
            'clientesNuevos',
            'totalProductos',
            'productosBajoStock'
        ));
    }
    private function getClientesData()
    {
        return Venta::select(
            DB::raw("CONCAT(nombre_cliente, ' ', apellido_cliente) as nombre_completo"),
            DB::raw('COUNT(*) as ventas_count'),
            DB::raw('MAX(created_at) as ultima_compra')
        )
            ->groupBy('nombre_cliente', 'apellido_cliente')
            ->get()
            ->map(function ($item) {
                return (object)[ // Convertimos a objeto
                    'nombre_completo' => $item->nombre_completo,
                    'ventas_count' => $item->ventas_count,
                    'ultima_compra' => $item->ultima_compra
                ];
            }); // Sin toArray()
    }
    public function salesReport(Request $request)
    {
        // Consulta base con eager loading
        $query = Venta::with('productos');

        // Aplicar filtros
        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        if ($request->filled('cliente')) {
            $query->where(DB::raw("CONCAT(nombre_cliente, ' ', apellido_cliente)"), 'like', '%' . $request->cliente . '%');
        }

        // Datos para la tabla (paginados)
        $ventas = $query->latest()->paginate(15);

        // Datos para el gráfico (sin paginación)
        $ventasParaGrafico = (clone $query)->get()
            ->groupBy(fn($venta) => $venta->created_at->format('Y-m-d'));

        $grafico_labels = $ventasParaGrafico->keys()
            ->map(fn($fecha) => \Carbon\Carbon::parse($fecha)->format('d M'))
            ->toArray();

        $grafico_data = $ventasParaGrafico->map(fn($group) => $group->sum('total'))->values()->toArray();

        return view('reports.sales-report', [
            'ventas' => $query->paginate(15),
            'grafico_labels' => $grafico_labels,
            'grafico_data' => $grafico_data
        ]);
    }

    public function inventoryReport()
    {
        $productos = Producto::with('categoria') // Carga la relación categoría
            ->orderBy('nombre') // Orden alfabético
            ->get();

        return view('reports.inventory-report', compact('productos'));
    }

    public function customerReport()
    {
        $clientes = Venta::select('nombre_cliente', 'apellido_cliente')
            ->groupBy('nombre_cliente', 'apellido_cliente')
            ->get()
            ->map(function ($cliente) {
                $ventas = Venta::where('nombre_cliente', $cliente->nombre_cliente)
                    ->where('apellido_cliente', $cliente->apellido_cliente)
                    ->get();
                $cliente->ventas_count = $ventas->count();
                $cliente->ultima_venta = $ventas->sortByDesc('created_at')->first();
                return $cliente;
            });

        return view('reports.customer-report', compact('clientes'));
    }
    public function salesReportPdf(Request $request)
    {
        $query = Venta::query();

        if ($request->filled('desde')) {
            $query->whereDate('created_at', '>=', $request->desde);
        }

        if ($request->filled('hasta')) {
            $query->whereDate('created_at', '<=', $request->hasta);
        }

        if ($request->filled('cliente')) {
            $query->where(DB::raw("CONCAT(nombre_cliente, ' ', apellido_cliente)"), 'like', '%' . $request->cliente . '%');
        }

        $ventas = $query->latest()->get();

        $pdf = Pdf::loadView('reports.exports.sales-pdf', [
            'ventas' => $ventas,
            'grafico_base64' => null // No enviar el gráfico
        ]);

        return $pdf->download('reporte_ventas.pdf');
    }
}
