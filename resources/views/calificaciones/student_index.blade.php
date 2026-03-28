@extends('layouts.app')

@section('title', 'Mis Calificaciones')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Mis Calificaciones</h1>
        <p class="text-gray-600 mt-1">Historial completo de tus calificaciones</p>
    </div>

    <!-- Calificaciones Table -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        @if(isset($calificaciones) && $calificaciones->count() > 0)
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-l-4 border-neon-pink">
                                Materia / Grupo
                            </th>
                            <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Calificación
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($calificaciones as $calificacion)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <span class="text-neon-pink font-semibold">{{ $calificacion->assignment->grupo->nombre }}</span>
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($calificacion->calificacion >= 9)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ $calificacion->calificacion }}
                                        </span>
                                    @elseif($calificacion->calificacion >= 7)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ $calificacion->calificacion }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ $calificacion->calificacion }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v1a1 1 0 001 1h4a1 1 0 001-1v-1m3-2V8a2 2 0 00-2-2H8a2 2 0 00-2 2v7m3 2h6"/>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes calificaciones registradas</h3>
                <p class="mt-1 text-sm text-gray-500">Tu maestro aún no ha calificado tus entregas.</p>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="flex justify-center">
        <a href="{{ route('dashboard.student') }}" 
           class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-neon-pink hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-neon-pink transition-all duration-300">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7l7 7"/>
            </svg>
            Volver al Dashboard
        </a>
    </div>
</div>
@endsection
