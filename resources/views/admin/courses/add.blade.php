@extends("adminlte::page")

@section('title', 'Clases')

@section('content_header')
    <h1>Informacion de Clases</h1>
@stop

@section('content')
    
    <div class="card">
        <div class="card-header">
            <h3>Añadir Clase</h2>
        </div>
        <div class="card-body">
            <form action="{{route("clases.store")}}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="edit-nombre">Nombre de la clase</label>
                    <input type="text" name="nombre" class="form-control" id="edit-nombre" value="">
                </div>
                <div class="form-group mb-3">
                    <select name="course" id="edit-clase" class="form-control">
                        <option value="Sin asignar">Sin Asignar</option>
                        @foreach($teachers as $teacher)
                            <option value="{{$teacher->id}}">{{$teacher->user->name." ".$teacher->user->lastname}}</option>
                        @endforeach
                    </select>
                </div>
                
                <a href="{{route("clases.index")}}" class="btn btn-secondary">Cancelar</a>
                <input type="submit" name="submit" class="btn btn-primary" value="Añadir">
                
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