<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = Teacher::all();
        return view("admin.teachers.index")->with(compact("users"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("admin.teachers.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
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
        $teacher = new Teacher();
        $teacher->user()->associate($user);
        $teacher->save();
        
        redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $user = Teacher::where("id",$id)->first();
        return view("admin.teachers.edit",compact("user"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            "name" => "required",
            "lastname" => "required",
            "email" => ["required","email"],
            "address" => "required",
            "birthday" => "required",
        ]);
        $teacher = Teacher::where("id",$id)->first();
        $teacher->user->name = $request->name;
        $teacher->user->lastname = $request->lastname;
        $teacher->user->address = $request->address;
        $teacher->user->birthday = $request->birthday;
        $teacher->user->save();
        echo "Exito";
        redirect()->route("maestros.index");
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $teacher = Teacher::where("id",$id)->first();
        $user = User::where("id",$teacher->user->id);
        $teacher->delete();
        $user->delete();
        redirect()->back();
    }
}
