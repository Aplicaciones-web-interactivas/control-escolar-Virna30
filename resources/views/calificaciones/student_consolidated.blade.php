@extends('layouts.app')

@section('title', 'Mis Calificaciones')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Mis Calificaciones</h1>
        <p class="text-gray-600 mt-1">Revisa tus calificaciones por grupo</p>
    </div>

    @if(isset($misCalificaciones) && $misCalificaciones->isNotEmpty())
        <!-- Calificaciones por Grupo -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                <table class="min-w-full divide-y divide-gray-300">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-l-4 border-neon-pink">
                                Grupo
                            </th>
                            <th scope="col" class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Promedio Final
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php
                            $gruposNotas = [];
                            foreach($misCalificaciones as $calificacion) {
                                $grupo = $calificacion->assignment->grupo->nombre;
                                if (!isset($gruposNotas[$grupo])) {
                                    $gruposNotas[$grupo] = [];
                                }
                                $gruposNotas[$grupo][] = $calificacion->calificacion;
                            }
                        @endphp
                        
                        @foreach($gruposNotas as $grupo => $notas)
                            @php
                                $promedio = array_sum($notas) / count($notas);
                            @endphp
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-gray-900">
                                    @if($grupo !== 'Sin Grupo')
                                        <span class="text-neon-pink font-semibold">{{ $grupo }}</span>
                                    @else
                                        <span class="text-gray-400 italic">Sin Grupo asignado</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 whitespace-nowrap">
                                    @if($promedio >= 9)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            {{ number_format($promedio, 1) }}
                                        </span>
                                    @elseif($promedio >= 7)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            {{ number_format($promedio, 1) }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            {{ number_format($promedio, 1) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <!-- Empty State -->
        <div class="text-center py-12">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No tienes calificaciones registradas aún.</h3>
            <p class="mt-1 text-sm text-gray-500">Entrega tus tareas para ver tus calificaciones aquí.</p>
        </div>
    @endif
</div>
@endsection
