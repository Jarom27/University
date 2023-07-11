<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::all();
        return view("admin.courses.index")->with(compact("courses"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $teachers = Teacher::all();
        $teachers_filtered = array();
        foreach($teachers as $teacher){
            if(count($teacher->courses) == 0){
                array_push($teachers_filtered, $teacher);
            }
        }       
        return view("admin.courses.add")->with("teachers",$teachers_filtered);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate(["nombre" => "required","teacher"]);
        $course = new Course();
        $course->course_name = $request->nombre;
        $course->save();
        foreach(Teacher::all() as $teacher){
            if($request->teacher == $teacher->user->name." ".$teacher->user->lastname){
                $course->teachers()->attach($teacher->id);
                return redirect()->route("clases.index");
            }
        }

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
        $course = Course::find($id);
        $teachers = Teacher::all();
        $teachers_filtered = array();
        foreach($teachers as $teacher){
            if(count($teacher->courses) == 0){
                array_push($teachers_filtered, $teacher);
            }
        }       
        return view("admin.courses.edit")->with(compact("course"))->with("teachers",$teachers_filtered);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate(["nombre" => "required","teacher"]);
        $course = Course::find($id);
        $course->course_name = $request->nombre;
        $course->save();
        if(count($course->teachers) != 0){
            $course->teachers()->detach($course->teachers[0]->id);
        }
        $teacher = Teacher::find($id);
        if(count($teacher->courses) == 0){
            $course->teachers()->attach($teacher->id);
        }
        return redirect()->route("clases.index");
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $course = Course::find($id);
        if(count($course->teachers) == 0){
            $course->delete();
        }
        return redirect()->route("clases.index");
    }
}
