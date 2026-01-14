<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //======================
        //CREACION DE LOS ROLES
        //======================

        $admin          = Role::create(['name' => 'admin']);
        $user_passenger = Role::create(['name' => 'user_passenger']);
        $user_payer     = Role::create(['name' => 'user_payer']);
    }
}
