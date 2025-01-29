<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id(); // ID único de la reserva
            $table->unsignedBigInteger('habitacion_id'); // Relación con habitaciones
            $table->unsignedBigInteger('cliente_id'); // Relación con clientes
            $table->date('fecha_entrada'); // Fecha de entrada
            $table->date('fecha_salida'); // Fecha de salida
            $table->enum('estado', ['Pendiente', 'Confirmada', 'Cancelada', 'Finalizada'])->default('Pendiente'); // Estado de la reserva
            $table->timestamps(); // Created_at y updated_at

            // Claves foráneas
            $table->foreign('habitacion_id')->references('id')->on('habitaciones')->onDelete('cascade');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
