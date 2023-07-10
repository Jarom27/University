@extends("adminlte::page")

@section('title', 'Alumnos')

@section('content_header')
    <h1>Informacion de Alumno</h1>
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
            ['label' => 'Acciones', 'no-export' => true, 'width' => 5],
        ];

    @endphp

    {{-- Minimal example / fill data using the component slot --}}
    
    <div class="card">
        <div class="card-header">
            <h3>Añadir Alumno</h2>
        </div>
        <div class="card-body">
            <form action="{{route("alumnos.store")}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="edit-dni">DNI:</label>
                    <input type="text" name="dni" class="form-control" id="edit-dni" value="">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-email">Email:</label>
                    <input type="email" name="email" class="form-control" id="edit-email" value="">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-name">Nombre: </label>
                    <input type="text" name="name" id="edit-name" class="form-control" value="">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-lastname">Apellidos: </label>
                    <input type="text" name="lastname" id="edit-lastname" class="form-control" value="">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-address">Direccion: </label>
                    <input type="text" name="address" id="edit-address" class="form-control" value="">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-birthday">Fecha de Nacimiento: </label>
                    <input type="date" name="birthday" id="edit-birthday" class="form-control" value="">
                </div>
                
                <a href="{{route("alumnos.index")}}" class="btn btn-secondary">Cancelar</a>
                <input type="submit" name="submit" class="btn btn-primary" value="Editar">
                
            </form>
        </div>
    </div>
            
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop

@section('content')

@stop