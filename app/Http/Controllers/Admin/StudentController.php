<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = Student::all();
        return view("admin.alumnos.index")->with(compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.alumnos.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            "dni" => "required",
            "name" => "required",
            "lastname" => "required",
            "email" => ["required","email"],
            "address" => "required",
            "birthday" => "required",
        ]);
        $user = new User();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->password = Hash::make("password");
        $user->lastname = $request->lastname;
        $user->address = $request->address;
        $user->birthday = $request->birthday;
        $user->state = "Activo";
        $user->assignRole("Estudiante");
        $user->save();
        $student = new Student();
        $student->DNI = $request->DNI;
        $student->user()->associate($user);
        $student->save();
        
        return redirect()->route("alumnos.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        redirect()->route("alumnos.index");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = Student::where("id",$id)->first();
        return view("admin.alumnos.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "dni" => "required",
            "name" => "required",
            "lastname" => "required",
            "email" => ["required","email"],
            "address" => "required",
            "birthday" => "required",
        ]);
        $student = Student::where("id",$id)->first();
        $student->DNI = $request->dni;
        $student->user->name = $request->name;
        $student->user->lastname = $request->lastname;
        $student->user->address = $request->address;
        $student->user->birthday = $request->birthday;
        $student->save();
        $student->user->save();
        return redirect()->route("alumnos.index");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $student = Student::where("id",$id)->first();
        $user = User::where("id",$student->user->id);
        $student->delete();
        $user->delete();
        return redirect()->route("alumnos.index");
    }
}
