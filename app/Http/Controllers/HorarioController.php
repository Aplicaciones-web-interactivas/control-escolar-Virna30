<?php

namespace App\Http\Controllers;

use App\Models\horario;
use App\Models\grupo;
use App\Models\materia;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = horario::with(['grupo', 'materia', 'user'])->get();
        return view('admin.horarios.index', compact('horarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $grupos = grupo::orderBy('nombre')->get();
        $materias = materia::orderBy('nombre')->get();
        $users = User::orderBy('name')->get();
        return view('admin.horarios.create', compact('grupos', 'materias', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'materia_id' => 'required|exists:materias,id',
            'user_id' => 'required|exists:users,id',
            'dia' => 'required|string|max:50',
            'hora_inicio' => 'required|string|max:20',
            'hora_fin' => 'required|string|max:20',
        ]);

        horario::create($validated);
        return redirect()->route('horarios.index')->with('message', 'Horario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(horario $horario)
    {
        $horario->load(['grupo', 'materia', 'user']);
        return view('admin.horarios.show', compact('horario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(horario $horario)
    {
        $grupos = grupo::orderBy('nombre')->get();
        $materias = materia::orderBy('nombre')->get();
        $users = User::orderBy('name')->get();
        return view('admin.horarios.edit', compact('horario', 'grupos', 'materias', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, horario $horario)
    {
        $validated = $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'materia_id' => 'required|exists:materias,id',
            'user_id' => 'required|exists:users,id',
            'dia' => 'required|string|max:50',
            'hora_inicio' => 'required|string|max:20',
            'hora_fin' => 'required|string|max:20',
        ]);

        $horario->update($validated);
        return redirect()->route('horarios.index')->with('message', 'Horario actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('message', 'Horario eliminado correctamente.');
    }
}
