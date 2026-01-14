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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            //Relaciones
            $table->foreignId('origin_id')->constrained('origins')->onDelete('cascade');
            $table->foreignId('destinie_id')->constrained('destinies')->onDelete('cascade');
            $table->foreignId('model_plane_id')->constrained('model_planes')->onDelete('cascade');
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');

            //Demas campos de la tabla
            $table->bigInteger('positionValue');
            $table->datetime('dateHour');
            $table->integer('userPassenger')->nullable();
            $table->integer('cantCupos')->nullable();
            $table->enum('estado', ['disponible', 'lleno'])->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
