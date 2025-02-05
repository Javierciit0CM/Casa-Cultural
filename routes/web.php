<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HabitacionController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\RestauranteController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\BuscarHabitacionesController;

use App\Http\Controllers\HomeController;




route::get('/', [HomeController::class, 'index'])->name('/');
route::get('/reservar', [BuscarHabitacionesController::class, 'index'])->name('reservar');
route::get('/buscar-habitaciones', [BuscarHabitacionesController::class, 'buscar'])->name('buscar-habitaciones');
Route::get('/habitaciones/filtrar', [BuscarHabitacionesController::class, 'filtrarPorPrecio'])->name('habitaciones.filtrar');





Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Ruta para reportes (dashboard principal)
    Route::resource('/dashboard', ReportesController::class)->names('reportes');

    // Rutas protegidas para las demás funcionalidades
    Route::resource('reservas', ReservaController::class)->names('reservas');


    Route::resource('habitaciones', HabitacionController::class)->names('habitaciones');
    Route::resource('clientes', ClienteController::class)->names('clientes');
    Route::resource('restaurante', RestauranteController::class)->names('restaurante');
});
