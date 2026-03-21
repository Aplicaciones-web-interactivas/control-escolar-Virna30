<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calificacion extends Model
{
    protected $table = 'calificacions';

    protected $fillable = [
        'grupo_id',
        'user_id',
        'calificacion',
    ];

    public function grupo()
    {
        return $this->belongsTo(grupo::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
