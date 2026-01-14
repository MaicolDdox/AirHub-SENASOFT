<?php

namespace Database\Seeders;

use App\Models\Destinie;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $destinies = [
            ['destinie' => 'Bogotá - Aeropuerto El Dorado (BOG)'],
            ['destinie' => 'Medellín - José María Córdova (MDE)'],
            ['destinie' => 'Cali - Alfonso Bonilla Aragón (CLO)'],
            ['destinie' => 'Cartagena - Rafael Núñez (CTG)'],
            ['destinie' => 'Barranquilla - Ernesto Cortissoz (BAQ)'],
            ['destinie' => 'Bucaramanga - Palonegro (BGA)'],
            ['destinie' => 'Santa Marta - Simón Bolívar (SMR)'],
            ['destinie' => 'Pereira - Matecaña (PEI)'],
            ['destinie' => 'Cúcuta - Camilo Daza (CUC)'],
            ['destinie' => 'San Andrés - Gustavo Rojas Pinilla (ADZ)'],
        ];

        foreach ($destinies as $destiny) {
            Destinie::create($destiny);
        }
    }
}
