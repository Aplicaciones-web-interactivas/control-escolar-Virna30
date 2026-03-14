@extends('layouts.app')
@section('content')
<div>
    <h1>Editar horario</h1>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('horarios.update', $horario) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Grupo</label>
            <select name="grupo_id" required>
                <option value="">Seleccione grupo</option>
                @foreach($grupos as $g)
                    <option value="{{ $g->id }}" {{ (old('grupo_id', $horario->grupo_id) == $g->id) ? 'selected' : '' }}>{{ $g->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Materia</label>
            <select name="materia_id" required>
                <option value="">Seleccione materia</option>
                @foreach($materias as $m)
                    <option value="{{ $m->id }}" {{ (old('materia_id', $horario->materia_id) == $m->id) ? 'selected' : '' }}>{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Profesor (Usuario)</label>
            <select name="user_id" required>
                <option value="">Seleccione profesor</option>
                @foreach($users as $u)
                    <option value="{{ $u->id }}" {{ (old('user_id', $horario->user_id) == $u->id) ? 'selected' : '' }}>{{ $u->name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label>Día</label>
            <input type="text" name="dia" value="{{ old('dia', $horario->dia) }}" required />
        </div>
        <div>
            <label>Hora inicio</label>
            <input type="text" name="hora_inicio" value="{{ old('hora_inicio', $horario->hora_inicio) }}" required />
        </div>
        <div>
            <label>Hora fin</label>
            <input type="text" name="hora_fin" value="{{ old('hora_fin', $horario->hora_fin) }}" required />
        </div>
        <button type="submit">Actualizar horario</button>
        <a href="{{ route('horarios.index') }}">Cancelar</a>
    </form>
</div>
@endsection
