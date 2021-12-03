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
                            <div>
                                <a href="{{ route('users.index') }}" class="btn btn-primary">Atrás</a>
                            </div>
                                <div class="form-row">
                                    <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" name="name" class="form-control" value="{{ isset($user)?old('name', $user->name):'' }}" placeholder="Santiago">
                                    </div>
                                    <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" value="{{ isset($user)?old('name', $user->email):' ' }}">
                                    </div>                
                                        <div class="form-group col-md-4">
                                        <label for="password">Contraseña</label>
                                        <input type="password" name="password" class="form-control" placeholder="contraseña123">
                                        <small class="text-muted">
                                            Must be 8-20 characters long.
                                          </small>
                                        </div>
                                            <div class="form-group col-md-4">
                                            <label for="ConfirmPass">Confirmar contraseña</label>
                                            <input type="password" name="confirm-password" class="form-control" placeholder="contraseña123">
                                            </div>
                                                <div class="form-group col-md-4">
                                                <label for="rol">Roles</label>          
                                                    <select name="roles[]" class="form-control">
                                                    @foreach($roles as $rol)
                                                    <option value="{{ $rol }}" 
                                                    @if (isset($userRol))
                                                    {{ (in_array($rol, $userRol))?'selected':'' }}>
                                                    @else
                                                    >
                                                    @endif 
                                                    {{ $rol }}</option>
                                                    @endforeach
                                                    </select>                
                                                </div>
                                    <button type="submit" class="btn btn-success">Enviar</button>
                                    <a href="{{ route('users.index') }}" class="btn btn-warning">Cancelar</a>       
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
        