<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = ['nombre', 'horario_id'];

    public function horario()
    {
        return $this->belongsTo(horario::class);
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
