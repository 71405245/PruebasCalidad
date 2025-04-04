<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        Producto::create($request->all());
        return redirect()->route('productos.index');
    }
    public function edit($id)
    {
    // Obtener el producto a editar
    $producto = Producto::findOrFail($id);

    // Pasar el producto a la vista de edición
    return view('productos.edit', compact('producto'));
    }
    public function update(Request $request, $id)
    {
    // Validación de los datos
    $request->validate([
        'nombre' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
    ]);

    // Obtener el producto y actualizarlo
    $producto = Producto::findOrFail($id);
    $producto->update([
        'nombre' => $request->nombre,
        'precio' => $request->precio,
        'stock' => $request->stock,
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente');
    }
    public function destroy($id)
    {
    // Obtener y eliminar el producto
    $producto = Producto::findOrFail($id);
    $producto->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente');
    }

}
