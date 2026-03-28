<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = ['nombre'];

    public function horario()
    {
        return $this->hasOne(horario::class);
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
