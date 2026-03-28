<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\materia;
use App\Models\horario;
use App\Models\grupo;
use App\Models\inscripcion;
use App\Models\calificacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear usuarios de demostración
        $teacher = User::firstOrCreate(
            ['clave_institucional' => 'maestro@maestro.com'],
            [
                'name' => 'Profesor Demo',
                'rol' => 'maestro',
                'is_active' => true,
                'password' => null,
            ]
        );

        $student = User::firstOrCreate(
            ['clave_institucional' => 'alumno@alumno.com'],
            [
                'name' => 'Alumno Demo',
                'rol' => 'alumno',
                'is_active' => true,
                'password' => null,
            ]
        );

        // Crear materias
        $materia1 = materia::firstOrCreate(
            ['clave' => 'MAT101'],
            [
                'nombre' => 'Matemáticas',
            ]
        );

        $materia2 = materia::firstOrCreate(
            ['clave' => 'FIS101'],
            [
                'nombre' => 'Física',
            ]
        );

        $materia3 = materia::firstOrCreate(
            ['clave' => 'QUI101'],
            [
                'nombre' => 'Química',
            ]
        );

        // Crear grupos primero (sin horario_id)
        $grupo1 = grupo::firstOrCreate([
            'nombre' => 'Grupo A - Matemáticas',
        ]);

        $grupo2 = grupo::firstOrCreate([
            'nombre' => 'Grupo B - Física',
        ]);

        $grupo3 = grupo::firstOrCreate([
            'nombre' => 'Grupo C - Química',
        ]);

        // Crear horarios para el maestro (ahora con grupo_id)
        $horario1 = horario::firstOrCreate([
            'materia_id' => $materia1->id,
            'user_id' => $teacher->id,
            'grupo_id' => $grupo1->id,
            'dias' => 'Lunes, Miércoles, Viernes',
            'hora_inicio' => '08:00',
            'hora_fin' => '09:30',
        ]);

        $horario2 = horario::firstOrCreate([
            'materia_id' => $materia2->id,
            'user_id' => $teacher->id,
            'grupo_id' => $grupo2->id,
            'dias' => 'Martes, Jueves',
            'hora_inicio' => '10:00',
            'hora_fin' => '11:30',
        ]);

        $horario3 = horario::firstOrCreate([
            'materia_id' => $materia3->id,
            'user_id' => $teacher->id,
            'grupo_id' => $grupo3->id,
            'dias' => 'Lunes, Miércoles',
            'hora_inicio' => '14:00',
            'hora_fin' => '15:30',
        ]);

        // Inscribir alumno en los grupos
        inscripcion::firstOrCreate([
            'user_id' => $student->id,
            'grupo_id' => $grupo1->id,
        ]);

        inscripcion::firstOrCreate([
            'user_id' => $student->id,
            'grupo_id' => $grupo2->id,
        ]);

        inscripcion::firstOrCreate([
            'user_id' => $student->id,
            'grupo_id' => $grupo3->id,
        ]);

        // Asignar calificaciones
        calificacion::firstOrCreate([
            'user_id' => $student->id,
            'grupo_id' => $grupo1->id,
            'calificacion' => 9.5,
        ]);

        calificacion::firstOrCreate([
            'user_id' => $student->id,
            'grupo_id' => $grupo2->id,
            'calificacion' => 8.0,
        ]);

        calificacion::firstOrCreate([
            'user_id' => $student->id,
            'grupo_id' => $grupo3->id,
            'calificacion' => 7.5,
        ]);
    }
}
