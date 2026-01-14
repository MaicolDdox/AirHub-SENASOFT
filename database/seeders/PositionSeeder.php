<?php

namespace Database\Seeders;

use App\Models\Flight;
use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flights = Flight::with('model_plane')->get();

        foreach ($flights as $flight) {
            $capacity = $flight->model_plane->capacidad;

            // Generar filas dinámicas (A..Z, AA..AZ, BA..BZ, etc.)
            $rows = [];
            foreach (range('A', 'Z') as $first) {
                $rows[] = $first; // A-Z
            }
            foreach (range('A', 'Z') as $first) {
                foreach (range('A', 'Z') as $second) {
                    $rows[] = $first.$second; // AA, AB, AC...
                }
            }

            $seatCount = 1;
            $seatsPerRow = 6; // puedes ajustar según el avión

            for ($r = 0; $seatCount <= $capacity; $r++) {
                for ($s = 1; $s <= $seatsPerRow; $s++) {
                    if ($seatCount > $capacity) {
                        break;
                    }

                    $seatNumber = $rows[$r].$s;

                    Position::create([
                        'flight_id' => $flight->id,
                        'seat_number' => $seatNumber,
                        'estado' => 'disponible',
                        'user_payer_id' => null,
                        'user_passenger_id' => null,
                    ]);

                    $seatCount++;
                }
            }
        }
    }
}
