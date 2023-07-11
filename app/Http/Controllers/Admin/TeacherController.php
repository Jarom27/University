<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseTeacher;
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
        
        return redirect()->route("maestros.index");

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
        $courses = Course::where("available","1")->get();
        // $course_teachers = CourseTeacher::all();
        $user = Teacher::where("id",$id)->first();
        
        return view("admin.teachers.edit",compact("user"))->with("courses",$courses);
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
            "course" => "required"
        ]);
        $teacher = Teacher::where("id",$id)->first();
        //Si esta asignado lo elimina para añadirlo a otro.
        if(CourseTeacher::where("teacher_id",$teacher->id)->exists()){
            $course_teacher = CourseTeacher::where("teacher_id",$teacher->id)->first();
            $course = Course::find($course_teacher->id);
            $course->available = true;
            $course->save();
            $course_teacher->delete();
        }
        
        $teacher->user->name = $request->name;
        $teacher->user->lastname = $request->lastname;
        $teacher->user->address = $request->address;
        $teacher->user->birthday = $request->birthday;
        $teacher->user->save();
        
        if($request->course != "Sin Asignar"){
            $course = Course::where("course_name",$request->course)->first();
            $course->available = false;
            $teacher->courses()->attach($course->id);
            $course->save();
            
        }
        echo "<a href ='".route("maestros.index")."'>redireccionar</a>";
        return redirect()->route("maestros.index");
       
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
        return redirect()->route("maestros.index");
    }
}
