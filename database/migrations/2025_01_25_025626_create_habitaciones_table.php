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
        Schema::create('habitaciones', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_habitacion', ['Simples', 'Dobles', 'Matrimoniales', 'Grupales']);
            $table->decimal('precio', 10, 2);
            $table->integer('capacidad_maxima');
            $table->text('descripcion');
            $table->integer('numero_habitacion')->unique(); // corregido a lowercase
            $table->enum('estado', ['disponible', 'ocupado', 'reservado'])->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('habitaciones');
    }
};