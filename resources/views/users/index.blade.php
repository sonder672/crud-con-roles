@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Usuarios') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @can('createUser')
                    <a href="{{ route('users.create') }}" class="btn btn-primary">Crear usuario</a>
                    @endcan     
                        <a href="{{ url('/home') }}" class="btn btn-primary">Volver</a>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">ID</th>
                                    <th scope="col">Rol</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $users)                         
                                <tr>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->id }}</td>
                                    <td>
                                    @if (!empty($users->getRoleNames()))
                                        @foreach ($users->getRoleNames() as $rolName)
                                            <h5>{{ $rolName }}</h5>
                                        @endforeach
                                    @endif
                                    </td>
                                    <td>
                                    @can ('editUser')
                                    <a href="{{ route('users.edit', $users->id) }}" class="btn btn-primary">Editar</a>
                                    @endcan
                                    @can ('deleteUser')
                                    <form action="{{ route('users.destroy', $users->id) }}" method="post">
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