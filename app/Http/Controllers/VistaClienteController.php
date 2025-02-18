<?php

namespace App\Http\Controllers;

use App\Models\Habitacione;
use Illuminate\Http\Request;

class VistaClienteController extends Controller
{
    public function show($id) {
        $habitacion = Habitacione::with('imagenes')->findOrFail($id);
        return view('cliente-habitaciones.show', compact('habitacion'));
    }
}