<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\Calificacion;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->rol !== 'alumno') {
            abort(403);
        }

        // Obtener horarios de los grupos donde el alumno está inscrito
        $inscripciones = auth()->user()->inscripcions()->pluck('grupo_id');
        $horarios = \App\Models\Horario::whereIn('grupo_id', $inscripciones)
            ->with('grupo')
            ->get();

        return view('dashboard.student', compact('horarios'));
    }
}
