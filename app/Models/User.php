<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
<<<<<<< Updated upstream
        'nombre',
=======
        'nombre_user',
        'rol',
        'ci_user',
        'email',
>>>>>>> Stashed changes
        'password',
        'rol',
        'ci',
        'telefono',
        'fecha',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
<<<<<<< Updated upstream
            'fecha' => 'date', // Define el campo `fecha` como una fecha
        'password' => 'hashed', // Laravel se encargará de encriptar la contraseña
=======
            'email_verified_at' => 'datetime',
            'password' => 'hashed', //encripta comtraseña
>>>>>>> Stashed changes
        ];
    }
}
