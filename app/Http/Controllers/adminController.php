<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\materia;

class adminController extends Controller
{
    public function indexMaterias()
    {
        return view('admin.materias');
    }
    public function indexMaterasAll()
    {
        $materias = materia::all();
        return view('admin.materias', compact('materias'));
    }
    public function saveMateria(Request $request)
    {
        $newMateria = new materia();
        $newMateria->nombre = $request->nombre;
        $newMateria->codigo = $request->codigo;
        $newMateria->save();
        return redirect()->route('index.materias')->with('message', 'Materia guardada correctamente');
    }
    public function deleteMateria(Request $request)
    {
        $materia = materia::find($request->id);
        if ($materia) {
            $materia->delete();
            return redirect()->route('index.materias')->with('message', 'Materia eliminada correctamente');
        }
        return redirect()->route('index.materias')->with('error', 'Materia no encontrada');
    }
    public function editMateria($id)
    {
        $materia = materia::find($id);
        if ($materia) {
            return view('admin.modificamateria')->with('materia', $materia);
        }
        return redirect()->route('index.materias')->with('error', 'Materia no encontrada');
    }
    
    public function updateMateria(Request $request)
    {
        $materia = materia::find($request->id);
        if ($materia) {
            $materia->nombre = $request->nombre;
            $materia->codigo = $request->codigo;
            $materia->save();
            return redirect()->route('index.materias')->with('message', 'Materia actualizada correctamente');
        }
        return redirect()->route('index.materias')->with('error', 'Materia no encontrada');
    }
}
