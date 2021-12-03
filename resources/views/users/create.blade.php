            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
<form action="{{ route('users.store') }}" method="post">
    @csrf
    @include('users/template')
</form>