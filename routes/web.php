<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReportesController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta para reportes (dashboard principal)
    Route::resource('/reportes', ReportesController::class)->names('reportes');

    // Rutas protegidas para las demás funcionalidades
    Route::resource('dashboard', ReservaController::class)->names('reservas');
    Route::resource('habitaciones', HabitacionController::class)->names('habitaciones');
    Route::resource('clientes', ClienteController::class)->names('clientes');
    Route::resource('restaurante', RestauranteController::class)->names('restaurante');
});
