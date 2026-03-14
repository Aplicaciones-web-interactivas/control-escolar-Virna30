@extends('layouts.app')
@section('content')
<div>
    <h1>Grupos</h1>
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <p><a href="{{ route('grupos.create') }}">Nuevo grupo</a></p>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Horarios</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($grupos as $grupo)
            <tr>
                <td>{{ $grupo->nombre }}</td>
                <td>{{ $grupo->horarios->count() }}</td>
                <td>
                    <a href="{{ route('grupos.show', $grupo) }}">Ver</a>
                    <a href="{{ route('grupos.edit', $grupo) }}">Editar</a>
                    <form action="{{ route('grupos.destroy', $grupo) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
