@extends('layouts.app')
@section('content')
<div>
    <h1>Nuevo grupo</h1>
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('grupos.store') }}" method="POST">
        @csrf
        <div>
            <label>Nombre del grupo</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}" required />
        </div>
        <button type="submit">Guardar grupo</button>
        <a href="{{ route('grupos.index') }}">Cancelar</a>
    </form>
</div>
@endsection
