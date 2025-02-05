<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Habitacione;

class HomeController extends Controller
{
    public function index() {
        $habitaciones = Habitacione::with('imagenes')->take(3)->get();
        return view('cliente-index.cliente-index', compact('habitaciones'));
    }
}