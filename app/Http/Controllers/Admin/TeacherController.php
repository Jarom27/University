<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

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
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

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
        return view("admin.alumnos.edit",compact("user"));
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
        $student = Teacher::where("id",$id)->first();
        $student->user()->name = $request->name;
        $student->user()->lastname = $request->lastname;
        $student->user()->address = $request->address;
        $student->user()->birthday = $request->birthday;
        $student->save();
        echo "Exito";
        redirect()->route("maestros.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = Teacher::where("id",$id)->first();
        $user->delete();
        redirect()->route("maestros.index");
    }
}
