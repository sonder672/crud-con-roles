<form action="{{ route('notes.store') }}" method="post">
    @csrf
    @include('notes/template')
</form>