<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
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
        $user->name = "Jarom";
        $user->lastname = "Mariscal";
        $user->email="admin@admin.com";
        $user->password = Hash::make("admin");
        $user->state = "Activo";
        $user->address = "Paseo del Torreon 257";
        $user->birthday = "2000-10-1";
        $user->assignRole("Administrador");
        $user->save();

        $maestro = new User();
        $maestro->email = "maestro@maestro.com";
        $maestro->password = Hash::make("maestro");
        $maestro->name = fake()->firstName();
        $maestro->lastname = fake()->lastName();
        $maestro->state = "Activo";
        $maestro->address = fake()->streetAddress();
        $maestro->birthday = fake()->date();
        $maestro->save();

        Teacher::factory(1)->for($maestro)->create();

        $alumno = new User();
        $alumno->email = "alumno@alumno.com";
        $alumno->password = Hash::make("alumno");
        $alumno->name = fake()->firstName();
        $alumno->lastname = fake()->lastName();
        $alumno->state = "Activo";
        $alumno->address = fake()->streetAddress();
        $alumno->birthday = fake()->date();
        $alumno->save();
        Student::factory(1)->for($alumno)->create();

        $users = User::factory(50)->create();
        $courses = Course::factory(10)->create();
        foreach($users as $person){
            $person->assignRole(fake()->randomElement(["Administrador","Maestro","Estudiante"]));
            if($person->hasRole("Maestro")){
                $teacher = Teacher::factory(1)->for($person)->create();
            }
            else if($person->hasRole("Estudiante")){
                $student = Student::factory(1)->for($person)->create();
                
            }
        }

    }
}
