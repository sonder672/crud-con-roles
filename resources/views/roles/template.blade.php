@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif                
                    <div class="form-row"> 
                        <div class="form-group col-md-6">
                            <label for="">Nombre del rol</label>
                            <input type="text" name="name" class="form-control" value="{{ isset($roles)?old('name', $roles->name):'' }}">      
                        </div>
                        <div>
                            <br>
                        <label for="permissions">Permisos para este rol</label>
                        <br> <br>
                    @foreach ($permission as $permissions)
                    <div>
                        <input type="checkbox"  name="permission[]" value="{{ $permissions->id }}" 
                {{-- in_array comprueba que $permissions->id esté dentro del array rolesPermissions --}}         
                        @if (isset($rolesPermissions))
                        {{ in_array($permissions->id, $rolesPermissions)?'checked':'' }}
                        @endif>
                        {{ $permissions->name }}
                        <br>   
                    @endforeach
                    </div>      
                    
                        </div>                               
                    </div>
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <a href="{{ route('roles.index') }}" class="btn btn-primary">Volver</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
