<?php

namespace Database\Seeders;

use App\Models\ModelPlane;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModelPlaneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            ['marca' => 'Airbus A320', 'capacidad' => 180],
            ['marca' => 'Airbus A321neo', 'capacidad' => 220],
            ['marca' => 'Boeing 737-800', 'capacidad' => 189],
            ['marca' => 'Embraer 190', 'capacidad' => 96],
            ['marca' => 'ATR 72-600', 'capacidad' => 72],
            ['marca' => 'Boeing 787 Dreamliner', 'capacidad' => 242],
            ['marca' => 'Airbus A319', 'capacidad' => 144],
            ['marca' => 'Embraer 175', 'capacidad' => 88],
        ];

        foreach ($models as $model) {
            ModelPlane::create($model);
        }
    }
}
