<?php

namespace Database\Seeders;

use App\Models\Origin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $origins = [
            ['origin' => 'Bogotá - Aeropuerto El Dorado (BOG)'],
            ['origin' => 'Medellín - José María Córdova (MDE)'],
            ['origin' => 'Cali - Alfonso Bonilla Aragón (CLO)'],
            ['origin' => 'Cartagena - Rafael Núñez (CTG)'],
            ['origin' => 'Barranquilla - Ernesto Cortissoz (BAQ)'],
            ['origin' => 'Bucaramanga - Palonegro (BGA)'],
            ['origin' => 'Santa Marta - Simón Bolívar (SMR)'],
            ['origin' => 'Pereira - Matecaña (PEI)'],
            ['origin' => 'Cúcuta - Camilo Daza (CUC)'],
            ['origin' => 'San Andrés - Gustavo Rojas Pinilla (ADZ)'],
        ];

        foreach ($origins as $origin) {
            Origin::create($origin);
        }
    }
}
