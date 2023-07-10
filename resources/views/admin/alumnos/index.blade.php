@extends("adminlte::page")

@section('title', 'Alumnos')

@section('content_header')
    <h1>Lista de Alumnos</h1>
@stop

@section('content')
    @php
        $heads = [
            '#',
            "DNI",
            'Nombre',
            'Email',
            'Direccion',
            'Fec. de Nacimiento',
            ['label' => 'Acciones', 'no-export' => true],
        ];

    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Informacion de Alumnos</h3>
                <a href="{{route("alumnos.create")}}" class="btn btn-primary">Añadir Alumno</a>
            </div>
            
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->DNI}}</td>
                        <td>{{$user->user->name." ".$user->user->lastname}}</td>
                        <td>
                           {{$user->user->email}}
                        </td>
                        <td>
                            {{$user->user->address}}
                        </td>
                        <td>
                            {{$user->user->birthday}}
                        </td>
                        <td>
                            {{-- <x-adminlte-button label="Open Modal"  class="btn btn-link"/> --}}
                            <div class="d-flex justify-content-center">
                                <a href="{{route("alumnos.edit",$user->id)}}" class="btn btn-primary">Editar</a>
                                <form action="{{route("alumnos.destroy",$user->id)}}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('content')

@stop