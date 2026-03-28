@extends('layouts.app')

@section('title', 'Alumnos del Grupo')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Grupo: {{ $grupo->nombre }}</h1>
        <p class="text-gray-600 mt-1">Gestiona las calificaciones de los alumnos</p>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <p class="text-green-800">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <p class="text-red-800">{{ session('error') }}</p>
        </div>
    @endif

    <!-- Students Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
            <table class="min-w-full divide-y divide-gray-300">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-bold text-gray-500 uppercase tracking-wider border-l-4 border-neon-pink">
                            Alumno
                        </th>
                        @foreach($alumnosConCalificaciones[0]['assignments'] as $assignment)
                            <th class="px-4 py-2 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">
                                {{ $assignment->title }}
                            </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($alumnosConCalificaciones as $alumno)
                    <tr>
                        <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $alumno['nombre'] }}
                        </td>
                        @foreach($alumno['assignments'] as $assignment)
                            <td class="px-4 py-3 whitespace-nowrap text-center text-sm">
                                @php $nota = $alumno['calificaciones'][$assignment->id] ?? null; @endphp
                                @if($nota !== null)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-neon-pink text-white shadow-sm">
                                        {{ number_format($nota, 1) }}
                                    </span>
                                @else
                                    <span class="text-gray-400 italic text-xs">-</span>
                                @endif
                            </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex justify-center">
        <a href="{{ route('calificaciones.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7l7 7"/>
            </svg>
            Volver a Mis Grupos
        </a>
    </div>
</div>
@endsection
