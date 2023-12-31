@extends("adminlte::page")

@section('title', 'Maestros')

@section('content_header')
    <h1>Informacion de Maestro</h1>
@stop

@section('content')

    
    <div class="card">
        <div class="card-header">
            <h3>Editar Maestro</h3>
        </div>
        <div class="card-body">
            <form action="{{route("maestros.update",$user->id)}}" method="POST">
                @method("PUT")
                @csrf
                <div class="form-group mb-3">
                    <label for="edit-email">Email:</label>
                    <input type="email" name="email" class="form-control" id="edit-email" value="{{$user->user->email}}" readonly>
                </div>
                <div class="form-group mb-3">
                    <label for="edit-name">Nombre: </label>
                    <input type="text" name="name" id="edit-name" class="form-control" value="{{$user->user->name}}">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-lastname">Apellidos: </label>
                    <input type="text" name="lastname" id="edit-lastname" class="form-control" value="{{$user->user->lastname}}">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-address">Direccion: </label>
                    <input type="text" name="address" id="edit-address" class="form-control" value="{{$user->user->address}}">
                </div>
                <div class="form-group mb-3">
                    <label for="edit-birthday">Fecha de Nacimiento: </label>
                    <input type="date" name="birthday" id="edit-birthday" class="form-control" value="{{$user->user->birthday}}">
                </div>
                <div class="form-group mb-3">
                    
                    <select name="course" id="edit-clase" class="form-control">
                            <option value="Sin asignar">Sin Asignar</option>
                        @foreach($courses as $course)
                            <option value="{{$course->course_name}}">{{$course->course_name}}</option>
                        @endforeach
                            

                    </select>

                </div>
                
                <a href="{{route("maestros.index")}}" class="btn btn-secondary">Cancelar</a>
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