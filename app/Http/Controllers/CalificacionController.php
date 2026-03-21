<?php

namespace App\Http\Controllers;

use App\Models\calificacion;
use App\Models\grupo;
use App\Models\inscripcion;
use App\Models\User;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        if ($user->rol === 'maestro') {
            $grupos = grupo::whereHas('horario', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })->get();
            
            return view('calificaciones.teacher_index', compact('grupos'));
        }
        
        if ($user->rol === 'alumno') {
            $calificaciones = calificacion::where('user_id', $user->id)
                ->with('grupo.horario.materia')
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
        
        $grupo = grupo::with(['horario.materia', 'inscripcions.user'])
            ->whereHas('horario', function($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->findOrFail($grupo_id);
        
        $alumnos = $grupo->inscripcions->map(function($inscripcion) use ($grupo) {
            $calificacion = calificacion::where('grupo_id', $grupo->id)
                ->where('user_id', $inscripcion->user_id)
                ->first();
                
            return [
                'user' => $inscripcion->user,
                'calificacion' => $calificacion ? $calificacion->calificacion : null,
                'calificacion_id' => $calificacion ? $calificacion->id : null
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
        
        $grupo = grupo::whereHas('horario', function($query) use ($user) {
            $query->where('user_id', $user->id);
        })->findOrFail($request->grupo_id);
        
        $inscrito = inscripcion::where('grupo_id', $request->grupo_id)
            ->where('user_id', $request->user_id)
            ->exists();
            
        if (!$inscrito) {
            return back()->with('error', 'El alumno no está inscrito en este grupo');
        }
        
        calificacion::updateOrCreate(
            [
                'grupo_id' => $request->grupo_id,
                'user_id' => $request->user_id
            ],
            [
                'calificacion' => $request->calificacion
            ]
        );
        
        return back()->with('success', 'Calificación guardada correctamente');
    }
}
