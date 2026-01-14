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
        Schema::create('user_payers', function (Blueprint $table) {
            $table->id();
            //Relaciones con tabla user y tabla vuelos (flight)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');

            //Demas campos de la tabla
            $table->string('rol');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payers');
    }
};
