<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(RoleSeeder::class);

        $user = new User();
        $user->name = "Jarom Mariscal";
        $user->email="admin@admin.com";
        $user->password = Hash::make("admin");
        $user->state = "Activo";
        $user->assignRole("Administrador");
        $user->save();

        User::factory(50)->create();
    }
}
