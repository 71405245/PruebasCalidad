<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function salesReport(Request $request)
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

        $agrupadas = $ventas->groupBy(fn($venta) => $venta->created_at->format('Y-m-d'));

        $grafico_labels = $agrupadas->keys();
        $grafico_data = $agrupadas->map(fn($group) => $group->sum('total'))->values();

        return view('reports.sales-report', compact('ventas', 'grafico_labels', 'grafico_data'));
    }

    public function inventoryReport()
    {
        $productos = Producto::with('categoria')->get();
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
