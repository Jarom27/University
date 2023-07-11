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
                            <a href="{{route("permisos.edit",$user->id)}}" class = "btn btn-primary">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            
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