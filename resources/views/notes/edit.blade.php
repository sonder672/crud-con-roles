<form action="{{ route('notes.index') }}" method="post">
    @csrf
    {{ method_field('PATCH') }}
    @include('notes/template')

</form>