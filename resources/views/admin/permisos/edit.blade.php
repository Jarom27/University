@extends("adminlte::page")

@section('title', 'Permisos')

@section('content_header')
    <h1>Informacion de Permiso</h1>
@stop

@section('content')

    {{-- Minimal example / fill data using the component slot --}}
    
    <div class="card">
        <div class="card-header">
            <h3>Editar Permiso</h2>
        </div>
        <div class="card-body">
            <form action="{{route("permisos.update",[$user->id])}}" method="POST" id="edit-form">
                @method("PUT")
                @csrf
                <div class="mb-3">
                    <label for="edit-email" class="form-label">Email del Usuario</label>
                    <input class="form-control" type="email" name="email" id="edit-email" value="{{$user->email}}"required>
                </div>
                <div class="mb-3">
                    <label for="edit-role" class="form-label">Rol del Usuario</label>
                    <select class="form-control" name="role" id="edit-role" required>
                        @foreach ($roles as $role)
                            @if ($user->getRoleNames()->first() == $role->name)
                                <option class="text-black" value="{{$role->name}}" selected>{{$role->name}}</option>
                            @else
                                <option class="text-black" value="{{$role->name}}">{{$role->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <div class="custom-control custom-switch">
                        @if ($user->state == "Activo")
                            <input type="checkbox" name="state" class="custom-control-input" id="active-switch" checked>
                        @else
                            <input type="checkbox" name="state" class="custom-control-input" id="active-switch">
                        @endif
                        <label class="custom-control-label" for="active-switch">Usuario Activo</label>
                    </div>     
                </div>
                <div>
                    <a href="{{route("permisos.index")}}">Cancelar</a>
                    <button form="edit-form" type="submit" class="btn btn-primary">
                        Guardar Cambios
                    </button>
                </div>
                    

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