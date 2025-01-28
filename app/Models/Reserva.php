<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Reserva extends Model
{
    use hasfactory;

    protected $fillable = [
        'habitacion_id',
        'cliente_id',
        'fecha_entrada',
        'fecha_salida',
        'estado',
        'dias_estadia',
        'costo',
    ];
    

    public function habitacion()
    {
        return $this->belongsTo(Habitacione::class, 'habitacion_id');
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

}
