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

                @if (isset($pessoa))
                    <form action="/pessoas/{{ $pessoa->id }}" method="POST">
                    @method('PUT')
                @else
                    <form action="/pessoas" method="POST" enctype="multipart/form-data">
                @endif

                    @csrf

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
                                        <label for="nome">Nome da Pessoa</label>
                                        <input type="text" name="nome" placeholder="Digite o nome da pessoa" class="form-control" value="{{ isset($pessoa) ? $pessoa->nome : null }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="fantasia">Nome Fantasia</label>
                                        <input type="text" id="fantasia" name="fantasia" placeholder="Digite o nome fantasia" class="form-control" value="{{ isset($pessoa) ? $pessoa->fantasia : null }}">
                                    </div>
                                    <div class="form-group">
                                        <label id="lbDoc" for="cpf_cnpj">CPF ou CNPJ</label>
                                        <input type="text" id="cpf_cnpj" name="cpf_cnpj" placeholder="Numero de CPF ou CNPJ" class="form-control" value="{{ isset($pessoa) ? $pessoa->cpf_cnpj : null }}">
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
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">Ativar ou Inativar Pessoa</h3>
                                </div>
                                <div class="card-body text-center">
                                    <input  type="checkbox"
                                        data-handle-width="100"
                                        id="status"
                                        name="status"
                                        data-onstyle="success"
                                        data-offstyle="danger"
                                        value= "1", {{ isset($pessoa) && $pessoa->status == 1 ? 'checked' : 0  }}
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Salvar</button>

                </form>
                <hr>
            </div>
        </div>
    </div>
</div>
@stop
