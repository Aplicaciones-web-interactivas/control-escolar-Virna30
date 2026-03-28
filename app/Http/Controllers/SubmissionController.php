<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function index()
    {
        if (auth()->user()->rol !== 'alumno') {
            abort(403);
        }

        // Obtener tareas de los grupos donde el alumno está inscrito
        $studentGroups = auth()->user()->inscripcions->pluck('grupo_id');
        
        $assignments = Assignment::with(['submissions' => function($query) {
            $query->where('user_id', auth()->id());
        }])->whereIn('user_id', function($query) use ($studentGroups) {
            $query->select('user_id')
                  ->from('horarios')
                  ->whereIn('grupo_id', $studentGroups);
        })->orderBy('due_date', 'desc')->get();

        return view('submissions.index', compact('assignments'));
    }

    public function store(Request $request, Assignment $assignment)
    {
        if (auth()->user()->rol !== 'alumno') {
            abort(403);
        }

        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
        ]);

        $existingSubmission = Submission::where('assignment_id', $assignment->id)
            ->where('user_id', auth()->id())
            ->first();

        if ($existingSubmission) {
            // Si existe entrega y la fecha no ha vencido, permitir edición
            if ($assignment->due_date >= now()) {
                // Borrar archivo antiguo físicamente
                Storage::disk('public')->delete($existingSubmission->file_path);
                
                // Subir nuevo archivo
                $fileName = 'assignment_' . $assignment->id . '_user_' . auth()->id() . '_' . time() . '.pdf';
                $filePath = $request->file('file')->storeAs('submissions', $fileName, 'public');
                
                // Actualizar registro existente (no crear nuevo)
                $existingSubmission->update([
                    'file_path' => $filePath
                ]);
                
                return back()->with('success', 'Entrega actualizada correctamente');
            } else {
                return back()->with('error', 'La fecha de entrega ha vencido');
            }
        }

        if ($assignment->due_date < now()) {
            return back()->with('error', 'La fecha de entrega ha vencido');
        }

        $fileName = 'assignment_' . $assignment->id . '_user_' . auth()->id() . '_' . time() . '.pdf';
        $filePath = $request->file('file')->storeAs('submissions', $fileName, 'public');

        Submission::create([
            'assignment_id' => $assignment->id,
            'user_id' => auth()->id(),
            'file_path' => $filePath,
        ]);

        return back()->with('success', 'Tarea entregada correctamente');
    }

    public function download(Submission $submission)
    {
        // Permitir descarga si es el dueño del archivo O si es maestro
        if (auth()->user()->rol !== 'maestro' && $submission->user_id !== auth()->id()) {
            abort(403);
        }

        return Storage::disk('public')->download($submission->file_path);
    }
}
