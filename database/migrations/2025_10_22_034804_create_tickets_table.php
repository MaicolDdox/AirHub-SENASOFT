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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            //Relaciones con tabla usuario pasagero y vuelo y usuario pagador
            $table->foreignId('flight_id')->constrained('flights')->onDelete('cascade');
            $table->foreignId('user_payer_id')->constrained('user_payers')->onDelete('cascade');

            $table->string('cantPasajeros');
            $table->string('token');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
