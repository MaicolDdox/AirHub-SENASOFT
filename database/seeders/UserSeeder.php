<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Usuario administrador
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'], 
            [
                'first_name' => 'Administrador',
                'middle_name' => 'admin',
                'first_surname' => 'admin',
                'middle_surname' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin123456'), 
                'type_document' => 'CC',
                'number_document' => '1000000000',
                'number_phone' => '3000000000',
                'rol' => 'admin',
            ]
        );

        //Asignamos rol admin
        $admin->assignRole('admin');

    }
}
