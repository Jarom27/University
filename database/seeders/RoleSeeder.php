<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
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
        
        $p1 = Permission::create(["name" => "manage-permisos"]);
        $p2 = Permission::create(["name" => "manage-alumnos"]);
        $p3 = Permission::create(["name" => "manage-maestros"]);
        $p4 = Permission::create(["name" => "manage-cursos"]);

        $p5 = Permission::create(["name"=> "listado-alumno"]);
        $p6 = Permission::create(["name" => "ver-calificaciones"]);
        $p7 = Permission::create(["name"=> "administrar-cursos"]);
       
        $rol1->syncPermissions([$p1,$p2,$p3,$p4]);
        $rol2->syncPermissions([$p5]);
        $rol2->syncPermissions([$p6,$p7]);
    }
}
