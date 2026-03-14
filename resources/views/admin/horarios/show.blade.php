@extends('layouts.app')
@section('content')
<div>
    <h1>Detalle del horario</h1>
    <p><strong>Grupo:</strong> {{ $horario->grupo?->nombre ?? '—' }}</p>
    <p><strong>Materia:</strong> {{ $horario->materia?->nombre ?? '—' }}</p>
    <p><strong>Profesor:</strong> {{ $horario->user?->name ?? '—' }}</p>
    <p><strong>Día:</strong> {{ $horario->dia }}</p>
    <p><strong>Hora inicio:</strong> {{ $horario->hora_inicio }}</p>
    <p><strong>Hora fin:</strong> {{ $horario->hora_fin }}</p>
    <p>
        <a href="{{ route('horarios.edit', $horario) }}">Editar</a>
        <a href="{{ route('horarios.index') }}">Volver al listado</a>
    </p>
</div>
@endsection
