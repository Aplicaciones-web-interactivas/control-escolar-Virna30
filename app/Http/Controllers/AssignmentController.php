<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\grupo;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    public function create()
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        // Obtener grupos donde el maestro tiene horarios
        $grupos = grupo::whereHas('horario', function($query) {
            $query->where('user_id', auth()->id());
        })->get();

        return view('assignments.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date|after:now',
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        // Verificar que el grupo pertenezca al maestro
        $grupo = Grupo::find($request->grupo_id);
        if (!$grupo || !$grupo->horario || $grupo->horario->user_id !== auth()->id()) {
            return back()->with('error', 'No tienes permisos para crear tareas en este grupo');
        }

        Assignment::create([
            'user_id' => auth()->id(),
            'grupo_id' => $request->grupo_id, // ¡ESTO ES VITAL!
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
        ]);

        return redirect()->route('assignments.index')->with('success', 'Tarea creada correctamente');
    }

    public function show(Assignment $assignment)
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        if ($assignment->user_id !== auth()->id()) {
            abort(403);
        }

        $assignment->load('submissions.user');

        return view('assignments.show', compact('assignment'));
    }

    public function index()
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        $assignments = Assignment::where('user_id', auth()->id())
            ->orderBy('due_date', 'desc')
            ->get();

        return view('assignments.index', compact('assignments'));
    }
}
