@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Home') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h5 class="card-title">Bienvenido</h5>
                    <p class="card-text">Recuerde que para acceder como superUser debe registrarse con el correo electrónico <b>sonder672@hotmail.com</b></p>
                    <p class="card-text">Puede cambiar el superUser en App > Providers > AuthServiceProvider</p>
                    <div class="card-body">
                        <a href="{{ route('users.index') }}" class="card-link btn btn-primary">Usuarios</a>
                        <a href="{{ route('roles.index') }}" class="card-link btn btn-primary">Roles</a>
                        <a href="{{ route('notes.index') }}" class="card-link btn btn-primary">Notas</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
