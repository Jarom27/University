<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view("admin.permisos.index")->with(compact("users"))->with(compact("roles"));
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
        $user = User::find($id);
        $roles = Role::all();
        return view("admin.permisos.edit")->with(compact("user"))->with(compact("roles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Validar datos de entrada del usuario
        $request->validate([
            "email" => ["required","email"],
            "role" => "required",
        ]);
        $user = User::all()->find($id);
        $user->email = $request->email;
        $user->state = $request->state == "on" ? "Activo" : "Inactivo";
        //Validar si el rol existe
        $roles = Role::all();
        $role_exists = false;
        foreach ($roles as $rol) {
            if($rol->name ==  $request->role){
                $role_exists = true;
                break;
            }
        }
        if($role_exists){
            $roles = $user->getRoleNames();
            foreach($roles as $rol){
                $user->removeRole($rol);
            }
            $user->assignRole($request->role);
            $user->save();
            redirect()->route("permisos.index")->with("status","Usuario actualizado exitosamente");
        }
        return redirect()->route("permisos.index")->with("status","No se actualizo el usuario");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
