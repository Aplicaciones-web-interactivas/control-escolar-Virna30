<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\CalificacionController;
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
    Route::get('/calificaciones', [CalificacionController::class, 'index'])->name('calificaciones.index');
    Route::get('/calificaciones/grupo/{grupo_id}', [CalificacionController::class, 'showGrupo'])->name('calificaciones.grupo');
    Route::post('/calificaciones', [CalificacionController::class, 'store'])->name('calificaciones.store');
});

