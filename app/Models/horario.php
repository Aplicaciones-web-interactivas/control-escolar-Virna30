<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';

    protected $fillable = [
        'user_id',
        'grupo_id',
        'dias',
        'hora_inicio',
        'hora_fin',
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
