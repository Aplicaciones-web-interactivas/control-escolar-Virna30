<?php

namespace App\Http\Controllers;

use App\Models\grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $grupos = grupo::with('horarios')->orderBy('nombre')->get();
        return view('admin.grupos.index', compact('grupos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.grupos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        grupo::create($validated);
        return redirect()->route('grupos.index')->with('message', 'Grupo creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(grupo $grupo)
    {
        $grupo->load('horarios.materia', 'horarios.user');
        return view('admin.grupos.show', compact('grupo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(grupo $grupo)
    {
        return view('admin.grupos.edit', compact('grupo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, grupo $grupo)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        $grupo->update($validated);
        return redirect()->route('grupos.index')->with('message', 'Grupo actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index')->with('message', 'Grupo eliminado correctamente.');
    }
}
