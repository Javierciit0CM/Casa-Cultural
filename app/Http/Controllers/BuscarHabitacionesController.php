<?php

namespace App\Http\Controllers;

use App\Models\Habitacione;

use Illuminate\Http\Request;

class BuscarHabitacionesController extends Controller
{
    public function index() {
        $habitaciones = Habitacione::with('imagenes')->take(3)->get();
        return view ('cliente-habitaciones.index', compact('habitaciones'));
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
}
