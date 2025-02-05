<?php

namespace App\Http\Controllers;

use App\Models\Habitacione;

use Illuminate\Http\Request;

class BuscarHabitacionesController extends Controller
{
    public function index() {
        $totalhabitaciones = Habitacione::count();
        $habitaciones = Habitacione::with('imagenes')->take(3)->get();
        return view ('cliente-habitaciones.index', compact('habitaciones', 'totalhabitaciones'));
    }

    public function buscar(Request $request)
    {
        $request->validate([
            'fecha_entrada' => 'required|date',
            'fecha_salida' => 'required|date|after:fecha_entrada',
        ]);

        $habitaciones = Habitacione::whereDoesntHave('reservas', function ($query) use ($request) {
            $query->where(function ($q) use ($request) {
                $q->whereBetween('fecha_entrada', [$request->fecha_entrada, $request->fecha_salida])
                  ->orWhereBetween('fecha_salida', [$request->fecha_entrada, $request->fecha_salida])
                  ->orWhereRaw('? BETWEEN fecha_entrada AND fecha_salida', [$request->fecha_entrada])
                  ->orWhereRaw('? BETWEEN fecha_entrada AND fecha_salida', [$request->fecha_salida]);
            });
        })->with('imagenes')->get();

        return view('cliente-habitaciones.index', compact('habitaciones'));
    }

    public function filtrarPorPrecio(Request $request)
    {
        $precios = $request->input('precios', []);
    
        if (empty($precios)) {
            // Si no hay filtros seleccionados, retornar todas las habitaciones
            $habitaciones = Habitacione::with('imagenes')->get();
        } else {
            $rango_precios = [
                '0-100' => [0, 100],
                '100-150' => [100, 150],
                '150-200' => [150, 200],
            ];
    
            $habitaciones = Habitacione::with('imagenes')->where(function ($query) use ($precios, $rango_precios) {
                foreach ($precios as $rango) {
                    if (isset($rango_precios[$rango])) {
                        [$min, $max] = $rango_precios[$rango];
                        $query->orWhereBetween('precio', [$min, $max]);
                    }
                }
            })->get();
        }
    
        return response()->json(['habitaciones' => $habitaciones]);
    }
    
    
}
