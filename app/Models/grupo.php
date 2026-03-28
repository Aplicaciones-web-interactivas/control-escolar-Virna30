<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = ['nombre', 'user_id'];

    public function horarios()
    {
        return $this->hasMany(horario::class, 'grupo_id');
    }

    public function inscripcions()
    {
        return $this->hasMany(inscripcion::class);
    }

    public function calificacions()
    {
        return $this->hasMany(calificacion::class);
    }
}
