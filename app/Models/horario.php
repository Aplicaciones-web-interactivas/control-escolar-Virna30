<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class horario extends Model
{
    protected $table = 'horarios';

    protected $fillable = [
        'materia_id',
        'user_id',
        'dias',
        'hora_inicio',
        'hora_fin',
    ];

    public function grupos()
    {
        return $this->hasMany(grupo::class);
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
