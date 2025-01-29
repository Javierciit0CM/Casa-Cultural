<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacione;
use App\Models\Cliente;
use App\Models\Reserva;
use Carbon\Carbon;

class ReportesController extends Controller
{
    

    public function index() {
        $clientes = Cliente::all();
    
        // Obtener todas las habitaciones
        $habitaciones = Habitacione::all();
        $totalHabitaciones = $habitaciones->count();
    
        // Calcular habitaciones ocupadas y disponibles
        $ocupadas = $habitaciones->where('estado', 'ocupado')->count();
        $disponibles = $totalHabitaciones - $ocupadas;
    
        // Calcular porcentaje de ocupación
        $porcentajeOcupadas = $totalHabitaciones > 0 ? ($ocupadas / $totalHabitaciones) * 100 : 0;
    
        // Calcular ingresos diarios solo para reservas confirmadas
        $hoy = Carbon::today();
        $reservasHoy = Reserva::whereDate('created_at', $hoy)
                              ->where('estado', 'Confirmada') // Filtrar solo las reservas confirmadas
                              ->get();
        $ingresosHoy = $reservasHoy->sum('costo');
    
        $reservas = Reserva::all();
    
        // Pasar datos a la vista
        return view('reportes.index', compact('ocupadas', 'disponibles', 'porcentajeOcupadas', 'ingresosHoy', 'clientes', 'reservas'));
    }
    
    
    
}
