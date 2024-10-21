<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'evento';

    public function asistentes()
    {
        return $this->hasMany(Asistentes::class, 'id_evento', 'id_evento');
    }

    protected $primaryKey = 'id_evento';
    protected $fillable = ['nombre_evento', 'tipo_evento', 'descripcion', 'fecha_conclusion'];
    
    
    public function evento()
    {
        return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
    }
}
