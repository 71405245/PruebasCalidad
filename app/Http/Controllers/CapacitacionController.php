<?php

namespace App\Http\Controllers;

use App\Models\Capacitacion;
use Illuminate\Http\Request;

class CapacitacionController extends Controller
{
    public function index()
    {
        $capacitaciones = Capacitacion::where('activo', true)->get();
        return view('capacitaciones.index', compact('capacitaciones'));
    }

    public function create()
    {
        return view('capacitaciones.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'tipo' => 'required|in:video,documento,presentacion,curso',
            'duracion' => 'required|string',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'activo' => 'sometimes|boolean'
        ]);

        // Establecer valor por defecto para 'activo' si no viene en el request
        $validated['activo'] = $request->has('activo');

        Capacitacion::create($validated);

        return redirect()->route('capacitaciones.index')
            ->with('success', 'Capacitación creada exitosamente!');
    }
    public function show(Capacitacion $capacitacion)
    {
        return view('capacitaciones.show', compact('capacitacion'));
    }
    public function edit(Capacitacion $capacitacion)
    {
        return view('capacitaciones.edit', compact('capacitacion'));
    }
    // ... otros métodos (show, edit, update, destroy)
}
