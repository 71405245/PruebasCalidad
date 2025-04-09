<?php


namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::with('productos')->latest()->paginate(15);
        $ventasHoy = Venta::whereDate('created_at', today())->get();
        $ventasMes = Venta::whereMonth('created_at', now()->month)->get();
        
        return view('ventas.index', compact('ventas', 'ventasHoy', 'ventasMes'));

    }

    public function create()
    {
        // Obtener todos los productos para el formulario de creación de ventas
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|string|max:8',
            'nombre_cliente' => 'required|string|max:255',
            'apellido_cliente' => 'required|string|max:255',
            'producto_id' => 'required|array',
            'producto_id.*' => 'exists:productos,id',
            'cantidad' => 'required|array',
            'cantidad.*' => 'integer|min:1'
        ]);

        // Crear la venta
        $venta = Venta::create([
            'dni' => $request->dni,
            'nombre_cliente' => $request->nombre_cliente,
            'apellido_cliente' => $request->apellido_cliente,
            'total' => 0 // Inicializar en 0
        ]);

        $total = 0;

        // Procesar cada producto vendido
        foreach ($request->producto_id as $key => $producto_id) {
            $producto = Producto::findOrFail($producto_id);
            $cantidad = $request->cantidad[$key];

            // Verificar stock disponible
            if ($producto->stock < $cantidad) {
                return back()->with('error', "No hay suficiente stock para {$producto->nombre}");
            }

            $precio_unitario = $producto->precio;
            $subtotal = $precio_unitario * $cantidad;

            // Agregar producto a la venta
            $venta->productos()->attach($producto_id, [
                'cantidad' => $cantidad,
                'precio_unitario' => $precio_unitario,
                'subtotal' => $subtotal
            ]);

            // Actualizar stock
            $producto->decrement('stock', $cantidad);

            $total += $subtotal;
        }

        // Actualizar el total de la venta
        $venta->update(['total' => $total]);

        return redirect()->route('ventas.voucher', $venta->id)
            ->with('success', 'Venta registrada correctamente');
    }

    public function generateVoucher($id)
    {
        // Obtiene la venta por el ID
        $venta = Venta::with('productos')->findOrFail($id);

        // Genera el PDF con la vista del voucher
        $pdf = Pdf::loadView('ventas.voucher', compact('venta'));

        // Devuelve el PDF para descarga
        return $pdf->download('voucher_venta_' . $venta->id . '.pdf');
    }
    public function edit($id)
    {
        // Obtener la venta junto con los productos
        $venta = Venta::with('productos')->findOrFail($id);
        $productos = Producto::all(); // Obtener todos los productos para el formulario

        return view('ventas.edit', compact('venta', 'productos'));
    }
    public function update(Request $request, $id)
    {
        // Validar los datos
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
        ]);

        // Obtener la venta
        $venta = Venta::findOrFail($id);

        // Actualizar la venta con los nuevos datos
        $venta->productos()->sync([$request->producto_id => ['cantidad' => $request->cantidad]]);
        $venta->total = $request->total;
        $venta->save();

        return redirect()->route('ventas.index')->with('success', 'Venta actualizada con éxito');
    }

    public function destroy($id)
    {
        // Buscar y eliminar la venta
        $venta = Venta::findOrFail($id);
        $venta->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('ventas.index')->with('success', 'Venta eliminada correctamente');
    }
}
