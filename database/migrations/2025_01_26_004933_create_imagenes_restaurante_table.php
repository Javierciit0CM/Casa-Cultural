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
        Schema::create('imagenes_restaurante', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('restaurante_id'); // Relación con la tabla restaurantes
            $table->string('ruta_imagen'); // Ruta donde se almacena la imagen
            $table->timestamps(); // Campos created_at y updated_at

            // Clave foránea para asegurar integridad referencial
            $table->foreign('restaurante_id')
                  ->references('id')
                  ->on('restaurantes')
                  ->onDelete('cascade'); // Eliminar imágenes asociadas si se elimina el restaurante
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_restaurante');
    }
};
