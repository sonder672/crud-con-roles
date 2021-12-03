
<form action="{{ route('roles.store') }}" method="post">
    @csrf
    @include('roles/template')
</form>
