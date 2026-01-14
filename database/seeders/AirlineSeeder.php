<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = [
            'Avianca',
            'LATAM Airlines Colombia',
            'Viva Air Colombia',
            'SATENA',
            'Wingo',
            'EasyFly',
            'Ultra Air',
            'Clic Air (antes EasyFly)',
            'Aer Caribe',
            'Helicol',
            'Servicios Aéreos Panamericanos (Searca)',
            'Searca Charter',
            'SARPA',
            'Aerotaxi Guaymaral',
        ];

        foreach ($airlines as $name) {
            Airline::firstOrCreate(['airline' => $name]);
        }
    }
}
