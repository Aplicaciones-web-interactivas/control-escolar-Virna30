@extends('layouts.app')
@section('content')
<div>
    <h2>Modificar Materia</h2>
    <form action="{{ route('update.materia', ['id' => $materia->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <input type="text" name="nombre" value="{{ $materia->nombre }}" placeholder="Nombre de la materia" required class="border p-2 rounded w-full" />
            <input type="text" name="codigo" value="{{ $materia->codigo }}" placeholder="Código de la materia" required class="border p-2 rounded w-full mt-2" />
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Actualizar Materia</button>
    </form>
</div>
@endsection