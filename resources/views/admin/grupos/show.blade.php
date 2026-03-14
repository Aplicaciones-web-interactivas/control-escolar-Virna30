@extends('layouts.app')
@section('content')
<div>
    <h1>Detalle del grupo: {{ $grupo->nombre }}</h1>
    <h2>Horarios de este grupo</h2>
    @if($grupo->horarios->isEmpty())
        <p>No hay horarios asignados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Materia</th>
                    <th>Profesor</th>
                    <th>Día</th>
                    <th>Hora inicio</th>
                    <th>Hora fin</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grupo->horarios as $h)
                <tr>
                    <td>{{ $h->materia?->nombre ?? '—' }}</td>
                    <td>{{ $h->user?->name ?? '—' }}</td>
                    <td>{{ $h->dia }}</td>
                    <td>{{ $h->hora_inicio }}</td>
                    <td>{{ $h->hora_fin }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    <p>
        <a href="{{ route('horarios.create') }}">Agregar horario</a>
        <a href="{{ route('grupos.edit', $grupo) }}">Editar grupo</a>
        <a href="{{ route('grupos.index') }}">Volver al listado</a>
    </p>
</div>
@endsection
