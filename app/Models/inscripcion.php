<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class inscripcion extends Model
{
    protected $table = 'inscripcions';
    
    protected $fillable = ['user_id', 'grupo_id'];
    
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    
    public function grupo()
    {
        return $this->belongsTo(grupo::class);
    }
}
