@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('tipo'))
    <div class="alert alert-{{session('tipo')}}">
        {!! session('mensagem') !!}
    </div>
@endif
