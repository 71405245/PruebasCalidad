<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        return view('admin.marcas.index', compact('marcas'));
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'nullable|url'
        ]);

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('marcas', 'public');
            $validated['logo'] = $path;
        }

        $validated['slug'] = Str::slug($request->nombre);
        $validated['es_activa'] = $request->has('es_activa');

        Marca::create($validated);

        return redirect()->route('marcas.index')->with('success', 'Marca creada correctamente');
    }

    public function show(Marca $marca)
    {
        return view('marcas.show', compact('marca'));
    }

    public function edit(Marca $marca)
    {
        return view('admin.marcas.edit', compact('marca'));
    }

    public function update(Request $request, Marca $marca)
    {
        $validated = $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'nullable|url'
        ]);

        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe
            if ($marca->logo) {
                Storage::disk('public')->delete($marca->logo);
            }
            $path = $request->file('logo')->store('marcas', 'public');
            $validated['logo'] = $path;
        }

        $validated['slug'] = Str::slug($request->nombre);
        $validated['es_activa'] = $request->has('es_activa');

        $marca->update($validated);

        return redirect()->route('marcas.index')->with('success', 'Marca actualizada correctamente');
    }

    public function destroy(Marca $marca)
    {
        // Verificar si hay productos asociados
        if ($marca->productos()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: existen productos asociados');
        }

        // Eliminar logo si existe
        if ($marca->logo) {
            Storage::disk('public')->delete($marca->logo);
        }

        $marca->delete();

        return redirect()->route('marcas.index')->with('success', 'Marca eliminada correctamente');
    }
}