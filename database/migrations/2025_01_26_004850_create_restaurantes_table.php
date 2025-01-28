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
         Schema::create('restaurantes', function (Blueprint $table) {
            $table->id();
            $table->string('tipo'); // Tipo de plato (entrante, principal, postre, etc.)
            $table->string('nombre'); // Nombre del plato
            $table->decimal('precio', 8, 2); // Precio del plato
            $table->boolean('disponibilidad')->default(true); // Disponibilidad: true = disponible, false = no disponible
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};
