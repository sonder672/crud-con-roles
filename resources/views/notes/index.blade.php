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
                    @can ('createNote')
                <a href="{{ route('notes.create') }}" class="btn btn-primary">Crear nota</a>     
                    @endcan
                <a href="{{ url('/home') }}" class="btn btn-primary">Volver</a>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Contenido</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notes as $note)                                                 
                        <tr>
                            <td>{{ $note->title }}</td>
                            <td>{{ $note->content }}</td>
                            <td>
                                @can('editNote')
                                <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-primary">Editar</a>
                                @endcan
                                @can ('deleteNote')
                                <form action="{{ route('notes.destroy', $note->id) }}" method="post">
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