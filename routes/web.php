<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\adminController;
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

