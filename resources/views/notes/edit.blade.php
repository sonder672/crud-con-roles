<form action="{{ route('notes.update', $notes->id) }}" method="post">
    @csrf
    {{ method_field('PATCH') }}
    @include('notes/template')

</form>