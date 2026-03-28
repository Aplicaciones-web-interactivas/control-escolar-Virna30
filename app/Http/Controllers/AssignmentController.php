<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->rol !== 'maestro') {
            abort(403);
        }

        $misGruposIds = Horario::where('user_id', $user->id)->pluck('grupo_id');
        
        // Traemos las tareas que pertenecen a esos grupos
        $assignments = Assignment::whereIn('grupo_id', $misGruposIds)
            ->with('grupo')
            ->get();

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        // Para el formulario de crear tarea, solo mostramos los grupos del maestro
        $horarios = Horario::where('user_id', auth()->id())->with('grupo')->get();
        $grupos = $horarios->pluck('grupo')->unique('id')->filter();

        return view('assignments.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'due_date' => 'required|date',
            'grupo_id' => 'required|exists:grupos,id'
        ]);

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'grupo_id' => $request->grupo_id,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Tarea creada con éxito');
    }
    public function show($id)
    {
        $user = auth()->user();
        
        // Buscamos la tarea y nos aseguramos de que pertenezca a un grupo del maestro
        $assignment = Assignment::with('grupo')->findOrFail($id);
        
        // Verificamos que el maestro tenga acceso a este grupo a través de un horario
        $tieneAcceso = Horario::where('user_id', $user->id)
            ->where('grupo_id', $assignment->grupo_id)
            ->exists();

        if (!$tieneAcceso && $user->rol !== 'admin') {
            abort(403, 'No tienes permiso para ver esta tarea.');
        }

        $submissions = \App\Models\Submission::where('assignment_id', $id)
            ->with('user')
            ->get();

        return view('assignments.show', compact('assignment', 'submissions'));
    }
}