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
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            //Relaciones con tabla vuelo, pasajero y pagador
            $table->foreignId('user_payer_id')->nullable()->constrained('user_payers')->onDelete('cascade');
            $table->foreignId('user_passenger_id')->nullable()->constrained('user_passengers')->onDelete('cascade');
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');

            //Demas campos de la tabla
            $table->string('seat_number')->nullable();
            $table->enum('estado', ['disponible', 'ocupado'])->default('disponible');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
