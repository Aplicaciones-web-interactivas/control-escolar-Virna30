@extends('layouts.app')
@section('content')
<div>
    <h1>Horarios</h1>
    @if(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    <p><a href="{{ route('horarios.create') }}">Nuevo horario</a></p>
    <table>
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Materia</th>
                <th>Profesor</th>
                <th>Día</th>
                <th>Hora inicio</th>
                <th>Hora fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($horarios as $horario)
            <tr>
                <td>{{ $horario->grupo?->nombre ?? '—' }}</td>
                <td>{{ $horario->materia?->nombre ?? '—' }}</td>
                <td>{{ $horario->user?->name ?? '—' }}</td>
                <td>{{ $horario->dia }}</td>
                <td>{{ $horario->hora_inicio }}</td>
                <td>{{ $horario->hora_fin }}</td>
                <td>
                    <a href="{{ route('horarios.show', $horario) }}">Ver</a>
                    <a href="{{ route('horarios.edit', $horario) }}">Editar</a>
                    <form action="{{ route('horarios.destroy', $horario) }}" method="POST" style="display: inline;">
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
