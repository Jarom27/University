@extends("adminlte::page")

@section('title', 'Maestros')

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
            <h3>Informacion de Permisos</h2>
        </div>
        <div class="card-body">
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->user->name}}</td>
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
                                {{$user->courses->course_name}}
                            @endif
                        </td>
                        <td>
                            {{-- <x-adminlte-button label="Open Modal"  class="btn btn-link"/> --}}
                            <button data-toggle="modal" data-target="#editPermisoModal" class="edit-button" id="{{$user->id}}">
                                <span><img id="{{$user->id}}" src="{{public_path("icons/edit.svg")}}"></span>
                            </button>
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