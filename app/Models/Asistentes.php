<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistentes extends Model
{
    use HasFactory;
    protected $table = 'asistentes';

    protected $primaryKey = 'id_asistente';
    protected $fillable = ['nombre_asistente', 'ci_asistente', 'telefono','id_evento','id_ubicacion'];

        // Relación con Evento (opcional)
        public function evento()
        {
            return $this->belongsTo(Evento::class, 'id_evento', 'id_evento');
        }
}
