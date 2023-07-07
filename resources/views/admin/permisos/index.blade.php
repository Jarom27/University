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
                        <td>{{$user->name}}</td>
                        <td>
                            @if ($user->hasRole("Administrador"))
                                <span class="badge rounded-pill text-bg-warning">Administrador</span>
                            @endif
                            @if ($user->hasRole("Maestro"))
                                <span class="badge rounded-pill text-bg-info">Maestro</span>
                            @endif
                            @if ($user->hasRole("Estudiante"))
                                <span class="badge rounded-pill text-bg-secondary">Estudiante</span>
                            @endif
                        </td>
                        <td>
                            <x-adminlte-button label="Open Modal" data-toggle="modal" data-target="#editPermisoModal" class="bg-purple"/>
                        </td>
                    </tr>
                @endforeach
            </x-adminlte-datatable>
            <x-adminlte-modal id="editPermisoModal" title="Editar Permisos" theme="minimal" size='lg' disable-animations>
                This is a purple theme modal without animations.
            </x-adminlte-modal>
            
        </div>
        
    </div>
    
    
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop