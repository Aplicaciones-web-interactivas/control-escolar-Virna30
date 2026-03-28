<?php

namespace App\Http\Controllers;

use App\Models\grupo;
use App\Models\horario;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        // Obtener grupos donde el maestro tiene horarios
        $grupos = grupo::whereHas('horario', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['inscripcions.user', 'horario'])->get();

        return view('dashboard.teacher', compact('grupos'));
    }
}
