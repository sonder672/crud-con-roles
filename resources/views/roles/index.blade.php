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
                    @can ('createRol')
                <a href="{{ route('roles.create') }}" class="btn btn-primary">Crear rol</a>
                <a href="{{ route('roles.index') }}" class="btn btn-primary">Volver</a>
                    @endcan
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre del rol</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)                                                 
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>
                                @can('editRol')
                                <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Editar</a>
                                @endcan
                                @can ('deleteRol')
                                <form action="{{ route('roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
