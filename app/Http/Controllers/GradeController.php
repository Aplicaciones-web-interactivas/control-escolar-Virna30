<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use App\Models\calificacion;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function store(Request $request, Submission $submission)
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        // Verificar que el maestro pueda calificar esta tarea
        if ($submission->assignment->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'calificacion' => 'required|numeric|min:0|max:10',
        ]);

        // Crear o actualizar calificación
        calificacion::updateOrCreate(
            [
                'user_id' => $submission->user_id,
                'grupo_id' => $submission->assignment->user_id, // Temporal, necesitaríamos grupo_id en assignments
            ],
            [
                'calificacion' => $request->calificacion,
            ]
        );

        return back()->with('success', 'Calificación asignada correctamente');
    }
}
