<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurante extends Model
{
    use HasFactory;

    protected $table = 'restaurantes';

    protected $fillable = ['tipo', 'nombre', 'precio', 'disponibilidad'];

    public function imagenes()
    {
        return $this->hasMany(ImagenRestaurante::class, 'restaurante_id');
    }
}
