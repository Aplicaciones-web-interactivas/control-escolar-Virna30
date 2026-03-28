<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $horarios = Horario::where('user_id', auth()->id())->with('grupo')->get();
        $grupos = $horarios->pluck('grupo')->unique('id')->filter();

        return view('grupos.index', compact('grupos', 'horarios'));
    }
}