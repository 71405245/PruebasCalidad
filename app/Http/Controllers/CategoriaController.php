<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('orden')->get();
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'orden' => 'nullable|integer'
        ]);

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('categorias', 'public');
            $validated['imagen'] = $path;
        }

        $validated['slug'] = Str::slug($request->nombre);
        $validated['es_activa'] = $request->has('es_activa');

        Categoria::create($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'orden' => 'nullable|integer'
        ]);

        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($categoria->imagen) {
                Storage::disk('public')->delete($categoria->imagen);
            }
            $path = $request->file('imagen')->store('categorias', 'public');
            $validated['imagen'] = $path;
        }

        $validated['slug'] = Str::slug($request->nombre);
        $validated['es_activa'] = $request->has('es_activa');

        $categoria->update($validated);

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy(Categoria $categoria)
    {
        // Verificar si hay productos asociados
        if ($categoria->productos()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: existen productos asociados');
        }

        // Eliminar imagen si existe
        if ($categoria->imagen) {
            Storage::disk('public')->delete($categoria->imagen);
        }

        $categoria->delete();

        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada correctamente');
    }
}