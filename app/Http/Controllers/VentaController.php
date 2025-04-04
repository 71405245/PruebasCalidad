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
        // Obtener todas las ventas con sus productos asociados
        $ventas = Venta::with('productos')->get();
        return view('ventas.index', compact('ventas'));
    }

    public function create()
    {
        // Obtener todos los productos para el formulario de creación de ventas
        $productos = Producto::all();
        return view('ventas.create', compact('productos'));
    }

    public function store(Request $request)
{
    // Validación de la entrada
    $request->validate([
        'dni' => 'required|numeric',
        'nombre_cliente' => 'required|string',
        'apellido_cliente' => 'required|string',
        'producto_id' => 'required|array',
        'cantidad' => 'required|array',
    ]);

    // Crear la venta
    $venta = Venta::create([
        'dni' => $request->dni,
        'nombre_cliente' => $request->nombre_cliente,
        'apellido_cliente' => $request->apellido_cliente,
        'total' => 0, 
    ]);

    $total = 0;
    $productos = [];

    foreach ($request->producto_id as $index => $productoId) {
        $producto = Producto::findOrFail($productoId);
        $cantidad = $request->cantidad[$index];
        $subtotal = $producto->precio * $cantidad;
        $productos[$productoId] = ['cantidad' => $cantidad, 'subtotal' => $subtotal];
        $total += $subtotal;

        // Decrementar el stock del producto
        $producto->decrement('stock', $cantidad);
    }

    // Guardar la relación con los productos
    $venta->productos()->attach($productos);

    // Actualizar el total en la venta
    $venta->update(['total' => $total]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente');
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
