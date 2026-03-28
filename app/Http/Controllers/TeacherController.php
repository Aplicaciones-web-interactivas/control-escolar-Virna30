<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function dashboard()
    {
        if (auth()->user()->rol !== 'maestro') {
            abort(403);
        }

        $horarios = Horario::where('user_id', auth()->id())
            ->with('grupo')
            ->get();

        // Extraemos los grupos únicos de esos horarios para las tarjetas
        $grupos = $horarios->pluck('grupo')->unique('id')->filter();

        return view('dashboard.teacher', compact('grupos', 'horarios'));
    }
}