@extends('layouts.app')
@section('content')
<div>
    <div>
        <form action="{{ route('save.materia') }}" method="POST">
            @csrf
            <div>
                <input type="text" name="nombre" placeholder="Nombre de la materia" required class="border p-2 rounded w-full" />
                <input type="text" name="codigo" placeholder="Código de la materia" required class="border p-2 rounded w-full mt-2" />
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Agregar Materia</button>
    </div>
    <div>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($materias as $materia)
                <tr>
                    <td>{{ $materia->nombre }}</td>
                    <td>{{ $materia->clave }}</td>
                    <td>
                        <form action="{{ route('delete.materia', ['id' => $materia->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Eliminar</button>
                        </form>
                        <a href="{{ route('update.materia', ['id' => $materia->id]) }}" class="bg-yellow-500 text-white px-2 py-1 rounded">Modificar</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection