@extends("adminlte::page")

@section('title', 'Permisos')

@section('content_header')
    <h1>Lista de Permisos</h1>
@stop

@section('content')
    @php
        $heads = [
            '#',
            'Email/Usuario',
            ['label' => 'Permiso', 'width' => 20],
            ['label' => 'Estado', 'width' => 20],
            ['label' => 'Acciones', 'no-export' => true, 'width' => 20],
        ];

    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    
    <div class="card">
        <div class="card-header">
            <h3>Informacion de Permisos</h2>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name." ".$user->lastname}}</td>
                        <td>
                            @if ($user->hasRole("Administrador"))
                                <span class="badge badge-warning">Administrador</span>
                            @endif
                            @if ($user->hasRole("Maestro"))
                                <span class="badge badge-info">Maestro</span>
                            @endif
                            @if ($user->hasRole("Estudiante"))
                                <span class="badge badge-secondary">Estudiante</span>
                            @endif
                        </td>
                        <td>
                            @if ($user->state == "Activo")
                                <span class="badge badge-success">{{$user->state}}</span>
                            @elseif ($user->state == "Inactivo")
                                <span class="badge badge-danger">{{$user->state}}</span>
                            @endif
                        </td>
                        <td>
                            {{-- <x-adminlte-button label="Open Modal"  class="btn btn-link"/> --}}
                            <button data-toggle="modal" data-target="#editPermisoModal" class="edit-button btn" id="{{$user->id}}">
                                <span><img id="{{$user->id}}" src="{{asset("icons/edit.svg")}}"></span>
                            </button>
                            <button data-toggle="modal" data-target="#editPermisoModal" class="edit-button btn" id="{{$user->id}}">
                                <span><img id="{{$user->id}}" src="{{asset("icons/trash.svg")}}"></span>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            <x-adminlte-modal id="editPermisoModal" title="Editar Permisos" theme="minimal" size='md' disable-animations>
                <form action="{{route("permisos.update",[$user->id])}}" method="POST" id="edit-form">
                    @method("PUT")
                    @csrf
                    <div class="mb-3">
                        <label for="edit-email" class="form-label">Email del Usuario</label>
                        <input class="form-control" type="email" name="email" id="edit-email" value="{{$user->email}}"required>
                    </div>
                    <div class="mb-3">
                        <label for="edit-role" class="form-label">Rol del Usuario</label>
                        <select class="form-control" name="role" id="edit-role" required>
                            @foreach ($roles as $role)
                                @if ($user->getRoleNames()->first() == $role->name)
                                    <option class="text-black" value="{{$role->name}}" selected>{{$role->name}}</option>
                                @else
                                    <option class="text-black" value="{{$role->name}}">{{$role->name}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <div class="custom-control custom-switch">
                            @if ($user->state == "Activo")
                                <input type="checkbox" name="state" class="custom-control-input" id="active-switch" checked>
                            @else
                                <input type="checkbox" name="state" class="custom-control-input" id="active-switch">
                            @endif
                            <label class="custom-control-label" for="active-switch">Usuario Activo</label>
                        </div>     
                    </div>
                    <x-slot name="footerSlot">
                        <div>
                            <x-adminlte-button class="mr-auto" theme="secondary" label="Close" data-dismiss="modal"/>
                            <button form="edit-form" type="submit" class="btn btn-primary">
                                Guardar Cambios
                            </button>
                        </div>
                        
                    </x-slot>

                </form>
            </x-adminlte-modal>
            
        </div>
        
    </div>
   <script>
        let editButtons = document.querySelectorAll(".edit-button");
        editButtons.forEach(button => {
            button.addEventListener("click",e =>{
                console.log(e.target);
            });
        });
        console.log("Hola");
    </script> 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop