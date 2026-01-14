<?php

namespace Database\Seeders;

use App\Models\Airline;
use App\Models\Destinie;
use App\Models\Flight;
use App\Models\ModelPlane;
use App\Models\Origin;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $airlines = Airline::all();
        $planes = ModelPlane::all();
        $origins = Origin::all();
        $destinies = Destinie::all();

        $flights = [];

        for ($i = 1; $i <= 10; $i++) {
            // Evitar origen = destino
            $origin = $origins->random();
            do {
                $destiny = $destinies->random();
            } while ($destiny->id === $origin->id);

            $plane = $planes->random();
            $airline = $airlines->random();

            // Precio según tipo de avión
            $price = match(true) {
                $plane->capacidad <= 80  => rand(200000, 350000),
                $plane->capacidad <= 150 => rand(300000, 500000),
                default                  => rand(400000, 800000),
            };

            $flights[] = [
                'origin_id'      => $origin->id,
                'destinie_id'    => $destiny->id,
                'model_plane_id' => $plane->id,
                'airline_id'     => $airline->id,
                'positionValue'  => $price,
                'dateHour'       => Carbon::now()->addDays(rand(1, 30))->setTime(rand(5, 22), rand(0, 59)),
                'userPassenger'  => null,
                'cantCupos'      => $plane->capacidad,
                'estado'         => 'disponible',
                'created_at'     => now(),
                'updated_at'     => now(),
            ];
        }

        Flight::insert($flights);
    }
}

