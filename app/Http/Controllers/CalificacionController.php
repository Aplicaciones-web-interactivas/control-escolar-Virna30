<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->rol === 'maestro') {
            $grupos = Grupo::whereHas('horario', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
            
            return view('calificaciones.teacher_index', compact('grupos'));
        }
        
        if ($user->rol === 'alumno') {
            // Obtener calificaciones a través de submissions con sus assignments y grupos
            $calificaciones = \App\Models\Submission::where('user_id', $user->id)
                ->whereNotNull('calificacion')
                ->with(['assignment', 'assignment.grupo']) // Carga explícita de ambos
                ->get();
            
            return view('calificaciones.student_index', compact('calificaciones'));
        }
    }

    public function showGrupo($grupo_id)
    {
        $user = auth()->user();
        
        if ($user->rol !== 'maestro') {
            abort(403);
        }
        
        $grupo = Grupo::with(['horario', 'inscripcions.user'])
            ->whereHas('horario', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->findOrFail($grupo_id);
        
        $alumnos = $grupo->inscripcions->map(function($inscripcion) use ($grupo) {
            // Buscar la tarea del grupo
            $assignment = \App\Models\Assignment::where('grupo_id', $grupo->id)->first();
            
            // Buscar la calificación en la tabla 'submissions' (que es la que estamos usando)
            $submission = \App\Models\Submission::where('user_id', $inscripcion->user_id)
                ->where('assignment_id', $assignment->id) // Asegúrate de que este ID sea el correcto
                ->first();

            return [
                'id' => $inscripcion->user->id,
                'nombre' => $inscripcion->user->name, // ¡Esto es lo que falta!
                'email' => $inscripcion->user->email,
                'calificacion' => $submission ? $submission->calificacion : null,
                'submission_id' => $submission ? $submission->id : null
            ];
        });
        
        return view('calificaciones.teacher_grupo', compact('grupo', 'alumnos'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        if ($user->rol !== 'maestro') {
            abort(403);
        }
        
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id' => 'required|exists:users,id',
            'calificacion' => 'required|numeric|min:0|max:100'
        ]);
        
        $grupo = Grupo::whereHas('horario', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($request->grupo_id);
        
        $inscrito = Inscripcion::where('grupo_id', $request->grupo_id)
            ->where('user_id', $request->user_id)
            ->exists();
            
        if (!$inscrito) {
            return back()->with('error', 'El alumno no está inscrito en este grupo');
        }
        
        // Depuración de IDs recibidos
        \Log::info('Intentando guardar calificación:', [
            'user_id' => $request->user_id,
            'grupo_id' => $request->grupo_id,
            'calificacion' => $request->calificacion
        ]);
        
        // 1. Buscamos la tarea del grupo
        $assignment = \App\Models\Assignment::where('grupo_id', $request->grupo_id)->first();
        
        // Si no hay tarea para este grupo, no permitir guardar
        if (!$assignment) {
            return back()->with('error', 'No hay tareas creadas para este grupo. Por favor, cree una tarea primero.');
        }
        
        // 2. Buscamos la entrega que YA TIENE el archivo (no crear una nueva)
        $submission = \App\Models\Submission::where('user_id', $request->user_id)
            ->where('assignment_id', $assignment->id)
            ->first();

        if ($submission) {
            // 3. Actualizamos SOLO la calificación del registro existente
            $submission->calificacion = $request->calificacion;
            $success = $submission->save(); 

            \Log::info("Calificación {$request->calificacion} guardada en la entrega ID: {$submission->id} que ya tenía archivo.");
        } else {
            // Si por alguna razón no hay archivo, crear una entrada base
            $submission = \App\Models\Submission::create([
                'user_id' => $request->user_id,
                'assignment_id' => $assignment->id,
                'calificacion' => $request->calificacion,
                'file_path' => 'sin_archivo_previo'
            ]);
            
            \Log::info("Creada nueva entrega ID: {$submission->id} sin archivo previo.");
        }
        
        return back()->with('success', 'Calificación guardada correctamente');
    }
}
