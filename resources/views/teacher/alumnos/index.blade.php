@extends("adminlte::page")

@section('title', 'Dashboard')

@section('content_header')
    @if(count($teacher->courses)!=0)
        <h1>Alumnos de la clase de {{$teacher->courses[0]->course_name}}</h1>
    @else
        <h1>No tiene una clase asignada aún</h1>
    @endif
@stop

@section('content')
@php
    $heads = [
        '#',
        'Nombre del Alumno',
        'Calificacion',
        'Mensajes',
        ['label' => 'Acciones', 'no-export' => true],
    ];

@endphp

    {{-- Minimal example / fill data using the component slot --}}
    @if(count($teacher->courses)!= 0)
    <div class="card">
        <div class="card-header">
            <h3>Alumnos de la clase {{$teacher->courses[0]->course_name}}</h3>
        </div>
        
    <div class="card-body">
        @if(count($alumnos) == 0)
                <p>No hay alumnos inscritos a está clase aún</p>
        @else
        <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($alumnos as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->user->name." ".$user->user->lastname}}</td>
                        <td>
                            {{$user->calificacion}}
                        </td>
                        <td>
                        </td>
                        <td>
                            
                        </td>
                    </tr>
                @endforeach
            
        </x-adminlte-datatable>
        @endif
    </div>
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
@endif