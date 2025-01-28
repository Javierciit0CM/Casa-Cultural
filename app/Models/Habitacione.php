<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitacione extends Model
{
    use HasFactory;

    protected $table = 'habitaciones';

    protected $fillable = [
        'tipo_habitacion',
        'precio',
        'capacidad_maxima',
        'descripcion',
        'numero_habitacion',
        'estado',
    ];

    // Relación con las imágenes
    public function imagenes()
    {
        return $this->hasMany(Imagenes::class, 'id_habitaciones');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'habitacion_id');
    }
}