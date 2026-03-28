@extends('layouts.app')

@section('title', 'Crear Tarea')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">Crear Nueva Tarea</h1>
        <p class="text-gray-600 mt-1">Llena el formulario para crear una nueva tarea</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white shadow-lg rounded-lg border border-gray-200 p-8">
        <form class="space-y-6" action="{{ route('assignments.store') }}" method="POST">
            @csrf
            
            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                    Título de la Tarea
                </label>
                <input id="title" 
                       name="title" 
                       type="text" 
                       value="{{ old('title') }}" 
                       required
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300"
                       placeholder="Ej: Examen Parcial 1">
                @error('title')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Description Field -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    Descripción
                </label>
                <textarea id="description" 
                          name="description" 
                          rows="5" 
                          required
                          class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300"
                          placeholder="Describe los detalles de la tarea...">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Due Date Field -->
            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-2">
                    Fecha y Hora de Entrega
                </label>
                <input id="due_date" 
                       name="due_date" 
                       type="datetime-local" 
                       required
                       class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300">
                @error('due_date')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Group Selection Field -->
            <div>
                <label for="grupo_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Grupo
                </label>
                <select id="grupo_id" 
                        name="grupo_id" 
                        required
                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-neon-pink focus:border-neon-pink sm:text-sm transition-all duration-300">
                    <option value="">Selecciona un grupo...</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
                @error('grupo_id')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                <a href="{{ route('assignments.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-300">
                    Cancelar
                </a>
                <button type="submit" 
                        class="px-6 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300">
                    Crear Tarea
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
