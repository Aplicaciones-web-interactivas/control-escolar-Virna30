<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\CalificacionController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login',[LoginController::class,'showLoginForm'])->name('login');
Route::post('/login',[LoginController::class,'login'])->name('login.post');

Route::get('/alumno/dashboard', function(){
    return view('welcome');
});

Route::get('/profesor/dashboard', function(){
    return view('welcome');
});

Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register'])->name('register.post');


Route::post('/logout',[LoginController::class,'logout'])->name('logout');

Route::get('/materias', [adminController::class,'indexMaterias'])->name('index.materias');
Route::post('/materia',[adminController::class,'saveMateria'])->name('save.materia');

Route::delete('/eliminarmateria/{id}',[adminController::class,'deleteMateria'])->name('delete.materia');
Route::post('/modificarmateria/{id}',[adminController::class,'updateMateria'])->name('update.materia');

Route::resource('horarios', HorarioController::class);
Route::resource('grupos', GrupoController::class);

Route::middleware('auth')->group(function () {
    // Dashboard routes
    Route::get('/dashboard/teacher', [TeacherController::class, 'dashboard'])->name('dashboard.teacher')->middleware('role:teacher');
    
    Route::get('/dashboard/student', [StudentController::class, 'dashboard'])->name('dashboard.student')->middleware('role:student');

    Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
    Route::get('/calificaciones/grupo/{grupo_id}', [CalificacionController::class, 'showGrupo'])->name('calificaciones.grupo');
    Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
    
    // Rutas de Tareas para Maestros
    Route::middleware('role:teacher')->group(function () {
        Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
        Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
        Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
        Route::get('/assignments/{assignment}', [AssignmentController::class, 'show'])->name('assignments.show');
        
        // Rutas de gestión de grupos
        Route::get('/groups', [GrupoController::class, 'index'])->name('groups.index');
        Route::get('/groups/create', [GrupoController::class, 'create'])->name('groups.create');
        Route::post('/groups', [GrupoController::class, 'store'])->name('groups.store');
    });
    
    // Rutas de Entregas para Alumnos
    Route::middleware('role:student')->group(function () {
        Route::get('/submissions', [SubmissionController::class, 'index'])->name('submissions.index');
        Route::post('/submissions/{assignment}', [SubmissionController::class, 'store'])->name('submissions.store');
    });
    
    // Rutas de Descarga (ambos roles)
    Route::get('/submissions/{submission}/download', [SubmissionController::class, 'download'])->name('submissions.download');
});

