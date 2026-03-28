<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\Submission;
use App\Models\User;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->rol === 'alumno') {
            $misCalificaciones = Submission::where('user_id', $user->id)
                ->whereNotNull('calificacion')
                ->with('assignment.grupo')
                ->get();
            
            return view('calificaciones.student_consolidated', compact('misCalificaciones'));
        }
        
        if ($user->rol === 'maestro') {
            $horarios = Horario::where('user_id', $user->id)->with('grupo')->get();
            $grupos = $horarios->pluck('grupo')->unique('id')->filter();
            
            return view('calificaciones.teacher_index', compact('grupos'));
        }
    }

    public function showGrupo($grupo_id)
    {
        $user = auth()->user();
        if ($user->rol !== 'maestro') abort(403);

        $grupo = Grupo::findOrFail($grupo_id);
        $assignments = Assignment::where('grupo_id', $grupo_id)->get();
        $userIds = Inscripcion::where('grupo_id', $grupo_id)->pluck('user_id');
        $alumnos = User::whereIn('id', $userIds)->get();
        
        $todasLasSubmissions = Submission::whereIn('assignment_id', $assignments->pluck('id'))
            ->whereIn('user_id', $userIds)
            ->get();

        $alumnosConCalificaciones = $alumnos->map(function($alumno) use ($assignments, $todasLasSubmissions) {
            $calificacionesPorAssignment = [];
            foreach ($assignments as $assignment) {
                $submission = $todasLasSubmissions->where('user_id', $alumno->id)
                    ->where('assignment_id', $assignment->id)
                    ->first();
                $calificacionesPorAssignment[$assignment->id] = $submission ? $submission->calificacion : null;
            }

            return [
                'id' => $alumno->id,
                'nombre' => $alumno->name,
                'email' => $alumno->email,
                'calificaciones' => $calificacionesPorAssignment,
                'assignments' => $assignments
            ];
        });
        
        return view('calificaciones.teacher_grupo', compact('grupo', 'alumnosConCalificaciones'));
    }
    public function store(Request $request)
    {
        $user = auth()->user();
        
        // Validación de seguridad
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'grupo_id' => 'required|exists:grupos,id',
            'assignment_id' => 'required|exists:assignments,id',
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);

        // Guardamos o actualizamos la nota en la tabla submissions
        \App\Models\Submission::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'assignment_id' => $request->assignment_id,
            ],
            [
                'calificacion' => $request->calificacion,
                // Mantenemos el file_path si ya existe, si no, marcamos entrada manual
                'file_path' => \App\Models\Submission::where('user_id', $request->user_id)
                                ->where('assignment_id', $request->assignment_id)
                                ->value('file_path') ?? 'entrega_presencial'
            ]
        );

        return back()->with('success', 'Calificación guardada correctamente.');
    }
}