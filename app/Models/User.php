<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Assignment;
use App\Models\Submission;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'clave_institucional',
        'rol',
        'is_active',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'password' => 'hashed',
        ];
    }
    
    public function horarios()
    {
        return $this->hasMany(Horario::class);
    }
    
    public function inscripcions()
    {
        return $this->hasMany(Inscripcion::class);
    }
    
    public function calificacions()
    {
        return $this->hasMany(Calificacion::class);
    }
    
    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }
    
    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
