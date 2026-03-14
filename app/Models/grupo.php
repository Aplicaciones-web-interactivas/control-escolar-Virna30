<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grupo extends Model
{
    protected $table = 'grupos';

    protected $fillable = ['nombre'];

    public function horarios()
    {
        return $this->hasMany(horario::class);
    }
}
