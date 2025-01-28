<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagenes extends Model
{
    use HasFactory;

    protected $table = 'imagenes_habitaciones';

    protected $fillable = [
        'id_habitaciones',
        'img',
    ];

    // Relación con la tabla Habitaciones
    public function habitacion()
    {
        return $this->belongsTo(Habitacione::class, 'id_habitaciones');
    }
}