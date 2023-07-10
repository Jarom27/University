@extends("adminlte::page")

@section('title', 'Maestros')
@section('content_header')
    <h1>Lista de Maestros</h1>
@stop
@section('content')
    @php
        $heads = [
            '#',
            'Nombre',
            'Email',
            'Direccion',
            'Fec. de Nacimiento',
            ['label' => 'Clase Asignada', 'width' => 20],
            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
        ];

    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3>Informacion de Maestros</h3>
                <a href="{{route("maestros.create")}}" class="btn btn-primary">Añadir Maestro</a>
            </div>
        </div>
        
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
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
                            @if(count($user->courses) == 0)
                                <span class="badge badge-warning">Sin Asignacion</span>
                            @else
                                {{$user->courses[0]->course_name}}
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center">
                                <a href="{{route("maestros.edit",$user->id)}}" class="btn btn-primary">Editar</a>
                                <form action="{{route("maestros.destroy",$user->id)}}" method="post">
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