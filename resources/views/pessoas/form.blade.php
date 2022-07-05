@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-users"></i> Pessoas
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

                @if (!isset($pessoa))
                    {!! Form::open(['url' => route('pessoas.store'), 'files' => true]) !!}
                @else
                    {!! Form::model($pessoa, ['route' => ['pessoas.update', $pessoa->id], 'method' => 'PUT', 'files' => true]) !!}
                @endif

                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Selecione o Tipo de Pessoa</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="icheck-primary">
                                                <input type="radio" id="tipoPF" name="tipo" value="PF", {{ isset($pessoa) && $pessoa->tipo == "PF" ? 'checked' : '' }} />
                                                <label for="tipoPF">Pessoa Física</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="icheck-warning">
                                                <input type="radio" id="tipoPJ" name="tipo" value="PJ", {{ isset($pessoa) && $pessoa->tipo == "PJ" ? 'checked' : '' }} />
                                                <label for="tipoPJ">Pessoa Jurídica</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Escolha uma Classificação</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="icheck-primary">
                                                <input type="radio" id="clMatriz" name="classificacao" value="MATRIZ", {{ isset($pessoa) && $pessoa->classificacao == "MATRIZ" ? 'checked' : '' }} />
                                                <label for="clMatriz">MATRIZ</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="icheck-secondary">
                                                <input type="radio" id="clFilial" name="classificacao" value="FILIAL", {{ isset($pessoa) && $pessoa->classificacao == "FILIAL" ? 'checked' : '' }} />
                                                <label for="clFilial">FILIAL</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="icheck-warning">
                                                <input type="radio" id="clMei" name="classificacao" value="MEI", {{ isset($pessoa) && $pessoa->classificacao == "MEI" ? 'checked' : '' }} />
                                                <label for="clMei">MEI</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="icheck-danger">
                                                <input type="radio" id="clOng" name="classificacao" value="ONG", {{ isset($pessoa) && $pessoa->classificacao == "ONG" ? 'checked' : '' }} />
                                                <label for="clOng">ONG</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="icheck-info">
                                                <input type="radio" id="clIndividual" name="classificacao" value="INDIVIDUAL", {{ isset($pessoa) && $pessoa->classificacao == "INDIVIDUAL" ? 'checked' : '' }} />
                                                <label for="clIndividual">INDIVIDUAL</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-8 col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Dados Principais</h3>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        {!! Form::label('nome', 'Nome da Pessoa') !!}
                                        {!! Form::text('nome', isset($pessoa) ? $pessoa->nome : null, ['class' => 'form-control', 'placeholder' => 'Digite o nome da pessoa']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('fantasia', 'Nome fantasia') !!}
                                        {!! Form::text('fantasia', isset($pessoa) ? $pessoa->fantasia : null, ['class' => 'form-control', 'placeholder' => 'Digite o nome fantasia']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('cpf_cnpj', 'Documento Oficial') !!}
                                        @if (isset($pessoa) && $pessoa->tipo == "PF")
                                            {!! Form::text('cpf_cnpj', isset($pessoa) ? $pessoa->cpf_cnpj : null, ['class' => 'form-control isCPF' , 'placeholder' => 'Número de CPF ou CNPJ']) !!}
                                        @else
                                            {!! Form::text('cpf_cnpj', isset($pessoa) ? $pessoa->cpf_cnpj : null, ['class' => 'form-control isCNPJ' , 'placeholder' => 'Número de CPF ou CNPJ']) !!}
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Escolha as Opções</h3>
                                </div>
                                <div class="card-body">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="cliente" name="cliente" value= "1", {{ isset($pessoa) && $pessoa->cliente == 1 ? 'checked' : 0 }} />
                                        <label for="cliente">Cliente</label>
                                    </div>
                                    <div class="icheck-warning">
                                        <input type="checkbox" id="fornecedor" name="fornecedor" value= "1", {{ isset($pessoa) && $pessoa->fornecedor == 1 ? 'checked' : 0 }} />
                                        <label for="fornecedor">Fornecedor</label>
                                    </div>
                                    <div class="icheck-success">
                                        <input type="checkbox" id="transportador" name="transportador" value= "1", {{ isset($pessoa) && $pessoa->transportador == 1 ? 'checked' : 0  }} />
                                        <label for="transportador">Transportador</label>
                                    </div>
                                </div>
                            </div>
                            @component('components.status', ['status' => isset($pessoa) && $pessoa->status == 1 ? 1 : 0])@endcomponent
                        </div>
                    </div>
                    <div class="mt-5">
                        @if (isset($pessoa))
                            <a href="#modalEndereco" data-toggle="modal" data-target="#modalEndereco" class="btn btn-outline-secondary"><i class="fas fa-address-card"></i> Endereço</a>
                            <a href="#modalContato" data-toggle="modal" data-target="#modalContato" class="btn btn-outline-warning"><i class="fas fa-phone"></i> Contato</a>
                        @endif
                        <a href="{{ route('pessoas.index') }}" class="btn btn-outline-dark"><i class="fas fa-list"></i> Listar</a>
                        <button type="submit" class="btn btn-outline-success"><i class="fas fa-save"></i> Salvar</button>
                    </div>

                {!! Form::close() !!}
                <hr>
            </div>
        </div>
    </div>
</div>
@if (isset($pessoa))
    @include('modais.add-endereco', ['pessoa_id' => $pessoa->id])
    @include('modais.add-contato', ['pessoa_id' => $pessoa->id])
@endif

@stop
