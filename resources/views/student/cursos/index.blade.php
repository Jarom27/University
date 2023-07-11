@extends("adminlte::page")

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
@php
    $heads = [
        '#',
        'Nombre de la clase',
        'Darse de baja',
    ];

@endphp

    {{-- Minimal example / fill data using the component slot --}}
    <div class="d-flex gap-3">
        <div class="card">
            <div class="card-header">
                <h3>Clases del alumno</h3>
            </div>
            
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                    @foreach($student->courses as $course)
                        <tr>
                            <td>{{$course->id}}</td>
                            <td>{{$course->course_name}}</td>
                            <td>
                                <form action="{{route("cursos.delete")}}" method="post">
                                    @method("DELETE")
                                    @csrf
                                    <button type="submit">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                
            </x-adminlte-datatable>
        </div>
    </div>
        <div class="card">
            <div class="card-body">
                <form action="{{route("cursos.store",$student->id)}}"  method = "POST">
                    @csrf
                    <div class="form-group d-flex flex-column">
                        <label for="cursos-select">Cursos disponibles</label>
                        <select name="cursos" id="cursos-select" multiple>
                            @foreach($courses as $course)
                                <option value="{{$course->id}}">{{$course->course_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="submit" value="Enviar" class="btn btn-primary">
                    
                </form>
            </div>
        </div>
    </div>
    

        
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop