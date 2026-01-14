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
        Schema::create('user_passengers', function (Blueprint $table) {
            $table->id();
            //Relaciones tabla vuelos y tabla user_payers
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->foreignId('user_payer_id')->constrained('user_payers')->onDelete('cascade');

            //Demas campos de la tabla
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('first_surname');
            $table->string('middle_surname');
            $table->date('fecha_nacimiento');
            $table->string('genero');
            $table->string('email')->nullable();
            $table->string('type_document');
            $table->string('number_document');
            $table->string('number_phone');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_passengers');
    }
};
