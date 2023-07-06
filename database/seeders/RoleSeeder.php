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
        $rol1 = Role::create(["name" => "Administrador"]);
        $rol2 = Role::create(["name" => "Maestro"]);
        $rol3 = Role::create(["name" => "Estudiante"]);
        
    }
}
