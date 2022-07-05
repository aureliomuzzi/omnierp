@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-industry"></i> Departamentos
    <small class="text-muted">- Formulário</small>
</h1>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Preencha as informções necessárias
                </h3>
            </div>

            <div class="card-body">
                @if(session()->has('mensagem'))
                    <div class="alert alert-danger">
                        {{ session()->get('mensagem') }}
                    </div>
                @endif

                @if (!isset($departamento))
                    {!! Form::open(['url' => route('departamentos.store'), 'files' => true]) !!}
                @else
                    {!! Form::model($departamento, ['route' => ['departamentos.update', $departamento->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Dados Principais</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('descricao', 'Descrição do Departamento') !!}
                                        {!! Form::text('descricao', isset($departamento) ? $departamento->descricao : null, ['class' => 'form-control', 'placeholder' => 'Informe o nome do Departamento']) !!}
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('departamentos.index') }}" class="btn btn-outline-dark"><i class="fas fa-list"></i> Listar</a>
                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Salvar</button>
                    </div>

                {!! Form::close() !!}
                <hr>
            </div>
        </div>
    </div>
</div>
@stop
