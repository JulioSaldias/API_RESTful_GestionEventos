<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    use HasFactory;
    protected $table = 'ubicacion';

    public function asistentes()
    {
        return $this->hasMany(Asistentes::class, 'id_ubicacion');
    }

    protected $primaryKey = 'id_ubicacion';
    protected $fillable = ['nombre_ubicacion', 'capacidad', 'descripcion'];
}
