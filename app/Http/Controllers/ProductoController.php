<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Marca;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        // Iniciar consulta
        $query = Producto::with(['categoria', 'marca'])
                    ->latest();
        
        // Aplicar filtros
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('sku', 'like', "%{$search}%")
                  ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }
        
        if ($request->filled('categoria')) {
            $query->where('categoria_id', $request->input('categoria'));
        }
        
        if ($request->filled('marca')) {
            $query->where('marca_id', $request->input('marca'));
        }
        
        if ($request->filled('genero')) {
            $query->where('genero', $request->input('genero'));
        }
        
        // Obtener productos paginados
        $productos = $query->paginate(10);
        
        // Obtener categorías y marcas para los filtros
        $categorias = Categoria::orderBy('nombre')->get();
        $marcas = Marca::orderBy('nombre')->get();
        
        return view('productos.index', compact('productos', 'categorias', 'marcas'));
    }

    public function create()
    {
        $categorias = Categoria::where('es_activa', true)->get();
        $marcas = Marca::where('es_activa', true)->get();
        $tallas = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colores = ['Blanco', 'Negro', 'Rojo', 'Azul', 'Verde', 'Amarillo', 'Rosa', 'Gris'];
        $generos = ['Masculino', 'Femenino', 'Unisex'];
        
        return view('productos.create', compact('categorias', 'marcas', 'tallas', 'colores', 'generos'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'precio_descuento' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|string|unique:productos',
            'marca_id' => 'required|exists:marcas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'talla' => 'required|string',
            'color' => 'required|string',
            'material' => 'required|string',
            'genero' => 'required|in:hombre,mujer,unisex,niño,niña',
            'temporada' => 'nullable|string',
            'imagen_principal' => 'required|image|max:2048',
            'imagenes_adicionales.*' => 'nullable|image|max:2048',
            'peso' => 'nullable|integer|min:0',
            'origen' => 'nullable|string',
            'es_destacado' => 'sometimes|boolean',
            'es_nuevo' => 'sometimes|boolean'
        ]);

        // Procesar imagen principal
        $validated['imagen_principal'] = $request->file('imagen_principal')->store('productos', 'public');

        // Procesar imágenes adicionales
        if ($request->hasFile('imagenes_adicionales')) {
            $imagenes = [];
            foreach ($request->file('imagenes_adicionales') as $imagen) {
                $imagenes[] = $imagen->store('productos/adicionales', 'public');
            }
            $validated['imagenes_adicionales'] = json_encode($imagenes);
        }

        // Convertir checkboxes a boolean
        $validated['es_destacado'] = $request->has('es_destacado');
        $validated['es_nuevo'] = $request->has('es_nuevo');

        // Crear el producto
        Producto::create($validated);

        return redirect()->route('productos.index')
                         ->with('success', 'Producto creado exitosamente');
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'marca'])->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::active()->get();
        $marcas = Marca::active()->get();
        $tallas = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];
        $colores = ['Blanco', 'Negro', 'Rojo', 'Azul', 'Verde', 'Amarillo', 'Rosa', 'Gris'];
        $generos = ['Masculino', 'Femenino', 'Unisex'];
        
        return view('productos.edit', compact('producto', 'categorias', 'marcas', 'tallas', 'colores', 'generos'));
    }

    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'precio_descuento' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|unique:productos,sku,'.$producto->id,
            'codigo_barras' => 'nullable|string|unique:productos,codigo_barras,'.$producto->id,
            'marca_id' => 'required|exists:marcas,id',
            'categoria_id' => 'required|exists:categorias,id',
            'talla' => 'required|string',
            'color' => 'required|string',
            'material' => 'nullable|string',
            'genero' => 'required|string',
            'edad' => 'nullable|string',
            'temporada' => 'nullable|string',
            'imagen_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'imagenes_adicionales.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'es_destacado' => 'boolean',
            'es_nuevo' => 'boolean',
            'es_promocion' => 'boolean',
        ]);

        // Procesar imagen principal si se actualiza
        if ($request->hasFile('imagen_principal')) {
            // Eliminar imagen anterior si existe
            if ($producto->imagen_principal) {
                Storage::disk('public')->delete($producto->imagen_principal);
            }
            $validated['imagen_principal'] = $request->file('imagen_principal')->store('productos', 'public');
        }

        // Procesar imágenes adicionales si se actualizan
        if ($request->hasFile('imagenes_adicionales')) {
            // Eliminar imágenes anteriores si existen
            if ($producto->imagenes_adicionales) {
                foreach ($producto->imagenes_adicionales as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $additionalImages = [];
            foreach ($request->file('imagenes_adicionales') as $image) {
                $additionalImages[] = $image->store('productos/additional', 'public');
            }
            $validated['imagenes_adicionales'] = $additionalImages;
        }

        $producto->update($validated);

        return redirect()->route('productos.index')
                         ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

        // Eliminar imágenes asociadas
        if ($producto->imagen_principal) {
            Storage::disk('public')->delete($producto->imagen_principal);
        }
        
        if ($producto->imagenes_adicionales) {
            foreach ($producto->imagenes_adicionales as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $producto->delete();

        return redirect()->route('productos.index')
                         ->with('success', 'Producto eliminado exitosamente.');
    }
}