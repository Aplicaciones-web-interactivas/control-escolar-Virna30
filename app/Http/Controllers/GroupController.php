<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function create()
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }
        
        return view('groups.create');
    }
    
    public function store(Request $request)
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        $request->validate([
            'nombre' => 'required|string|max:255',
            'dias' => 'required|string|max:255',
            'hora_inicio' => 'required|string|max:255',
            'hora_fin' => 'required|string|max:255',
            'alumnos_emails' => 'nullable|string'
        ]);

        // Crear grupo
        $grupo = Grupo::create([
            'nombre' => $request->nombre,
        ]);

        // Crear horario asociado
        Horario::create([
            'user_id' => auth()->id(),
            'grupo_id' => $grupo->id,
            'dias' => $request->dias,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
        ]);

        // Procesar inscripciones de alumnos
        if ($request->alumnos_emails) {
            $emails = array_map('trim', explode(',', $request->alumnos_emails));
            
            foreach ($emails as $email) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $alumno = User::where('email', $email)->first();
                    if ($alumno && $alumno->rol === 'alumno') {
                        Inscripcion::firstOrCreate([
                            'user_id' => $alumno->id,
                            'grupo_id' => $grupo->id,
                        ]);
                    }
                }
            }
        }
        
        return back()->with('success', 'Grupo creado y alumnos inscritos correctamente');
    }
    
    public function index()
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }
        
        // Obtener grupos donde el maestro tiene horarios
        $grupos = Grupo::whereHas('horario', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['inscripcions.user', 'horario'])->get();
        
        return view('groups.index', compact('grupos'));
    }
}
