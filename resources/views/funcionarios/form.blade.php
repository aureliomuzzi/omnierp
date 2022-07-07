@extends('adminlte::page')

@section('title', 'Funcionarios')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-chalkboard-teacher"></i> Funcionarios
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
                @include('includes.alerts')

                @if (!isset($funcioario))
	    			{!! Form::open(['url' => route('funcionarios.store'), 'files' => true]) !!}
                @else
                    {!! Form::model($funcioario, ['route' => ['funcionarios.update', $funcioario->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif

                <div class="row">
                    <div class="col-lg-7 col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Informações da Funcionário</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    {!! Form::label('nome', 'Nome do Funcionário') !!}
                                    {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Nome do Funcionário']) !!}
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('identidade', 'Número de Identidade') !!}
                                            {!! Form::text('identidade', null, ['class' => 'form-control', 'placeholder' => 'Número de Identidade']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('cpf', 'Número do CPF') !!}
                                            {!! Form::text('cpf', null, ['class' => 'form-control isCPF', 'placeholder' => 'Número do CPF']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('data_nascimento', 'Data de Nascimento') !!}
                                            {!! Form::date('data_nascimento', isset($funcionario) ? $funcionario->data_nascimento->format('Y-m-d') : null, ['class' => 'form-control', 'placeholder' => 'Data de Nascimento']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('data_admissao', 'Data de Admissão') !!}
                                            {!! Form::date('data_admissao', isset($funcionario) ? $funcionario->data_admissao->format('Y-m-d') : null, ['class' => 'form-control', 'placeholder' => 'Data de Admissão']) !!}
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="form-group">
                                            {!! Form::label('data_demissao', 'Data de Demissão') !!}
                                            {!! Form::date('data_demissao', isset($funcionario) ? $funcionario->data_demissao->format('Y-m-d') : null, ['class' => 'form-control', 'placeholder' => 'Data de Demissão']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Foto do Funcionário</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group" align="center">
                                    @if (isset($funcionario) && $funcionario->foto)
                                        <img src="{{ $funcionario->foto }}" alt="" height="250px" class="d-block img-rounded">
                                    @else
                                        <img src="/images/avatar.png" alt="" height="250px" class="d-block img-rounded">
                                    @endif
                                    <label for="foto">Foto do Funcionário</label>
                                    <input type="file" name="foto"/>
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    @component('components.botoes', ['cancelar' => route('funcionarios.index'), 'listar' => route('funcionarios.index')])@endcomponent
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop
