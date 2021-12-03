            @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
            @endif
<form action="{{ route('users.update', $user->id) }}" method="post">
    @csrf
    {{ method_field('PATCH') }}
    @include('users/template')
</form>