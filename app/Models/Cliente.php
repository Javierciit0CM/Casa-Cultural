<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cliente extends Model
{

    use hasfactory;

    protected $fillable = [
        'dni',
        'nombre',
        'apellidos',
        'telefono',
        'edad',
        'procedencia',
        'condicion',
        'email',
        'password',
    ];
}
