@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <h1>Bienvenido, {{ Auth::user()->name }}</h1>
            <p class="text-muted">Panel de Control del Profesor</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Mis Clases</h5>
                    <h2 class="text-primary">5</h2>
                    <a href="#" class="btn btn-sm btn-primary">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Estudiantes</h5>
                    <h2 class="text-success">128</h2>
                    <a href="#" class="btn btn-sm btn-success">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Tareas Pendientes</h5>
                    <h2 class="text-warning">12</h2>
                    <a href="#" class="btn btn-sm btn-warning">Ver</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body text-center">
                    <h5 class="card-title">Calificaciones</h5>
                    <h2 class="text-info">Registrar</h2>
                    <a href="#" class="btn btn-sm btn-info">Ir</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection