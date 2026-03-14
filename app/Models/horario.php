<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = [
        'grupo_id',
        'materia_id',
        'user_id',
        'dia',
        'hora_inicio',
        'hora_fin',
    ];

    public function grupo()
    {
        return $this->belongsTo(grupo::class);
    }

    public function materia()
    {
        return $this->belongsTo(materia::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
