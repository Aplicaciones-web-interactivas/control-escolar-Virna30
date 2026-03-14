@extends('layouts.app')
@section('content')
<div>
    <h1>Editar grupo</h1>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('grupos.update', $grupo) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Nombre del grupo</label>
            <input type="text" name="nombre" value="{{ old('nombre', $grupo->nombre) }}" required />
        </div>
        <button type="submit">Actualizar grupo</button>
        <a href="{{ route('grupos.index') }}">Cancelar</a>
    </form>
</div>
@endsection
