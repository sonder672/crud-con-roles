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
                            <label for="">Título</label>
                            <input type="text" name="title" class="form-control" value="{{ isset($notes)?old('title', $notes->title):'' }}">      
                        </div>
                        <div class="form-group">
                            <label>Contenido</label>
                            <textarea class="form-control" name="content" rows="3">{{ isset($notes)?old('content', $notes->content):'' }}</textarea>
                          </div>
                    </div>
                        <div>              
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <a href="{{ route('notes.index') }}" class="btn btn-primary">Volver</a>
                        </div>
        </div>
    </div>
</div>
@endsection