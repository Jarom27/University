@extends("adminlte::page")

@section('title', 'Clases')

@section('content_header')
    <h1>Lista de Clases</h1>
@stop

@section('content')
    @php
        $heads = [
            '#',
            "Clase",
            'Maestro',
            'Alumnos Inscritos',
            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
        ];

    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between gap-2">
                <h3>Informacion de Clases</h3>
                <a href="{{route("clases.create")}}" class="btn btn-primary ">Añadir Clase</a>
            </div>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($courses as $course)
                    <tr>
                        <td>{{$course->id}}</td>
                        <td>{{$course->course_name}}</td>
                        <td>
                            @if(count($course->teachers) == 0)
                                <span class="badge badge-warning">Sin Asignacion</span>
                            @else
                                {{$course->teachers[0]->user->name." ".$course->teachers[0]->user->lastname}}
                            @endif
                        </td>
                        <td>
                            {{count($course->students)}}
                        </td>
                        <td>
                            <div class="d-flex ">
                                <a href="{{route("clases.edit",$course->id)}}" class="btn btn-primary">Editar</a>
                                @if(count($course->teachers) == 0)
                                <form action="{{route("clases.destroy",$course->id)}}" method = "POST">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                    
                                @endif
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