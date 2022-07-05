@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-user"></i> Usuários
    <small class="text-muted">- Formulário</small>
</h1>
@stop

@section('content')

<div class="row">
    <div class="col-lg -12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Preencha as informções necessárias
                </h3>
            </div>

            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <p><strong>Erro ao realizar esta operação</strong></p>
                        <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                    </div>
                @endif

                @if (!isset($user))
	    			{!! Form::open(['url' => route('users.store'), 'files' => true]) !!}
                @else
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif

                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Dados do Usuário</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('name', 'Nome') !!}
                                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nome do Usuario']) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('email', 'Email') !!}
                                    {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => 'Email do Usuario']) !!}
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="password">Senha</label>
                                        <input type="password" id="password" name="password" placeholder="Digite a senha" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12">
                        @component('components.status', ['status' => isset($user) && $user->status == 1 ? 1 : 0])@endcomponent
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Salvar</button>
                    <a href="{{ route('users.index') }}" class="btn btn-danger"><i class="far fa-times-circle"></i> Cancelar</a>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
