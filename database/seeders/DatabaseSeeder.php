<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //Llamamos el seeder para los roles
        $this->call(RoleSeeder::class);

        ////Llamamos a los usuarios con Rol Creados
        $this->call(UserSeeder::class);

        ////LLamamos a todos los seeder que manejan datos de las tablas
        $this->call(AirlineSeeder::class);
        $this->call(ModelPlaneSeeder::class);
        $this->call(OriginSeeder::class);
        $this->call(DestinySeeder::class);
        $this->call(FlightSeeder::class);
        $this->call(PositionSeeder::class);
    }
}
