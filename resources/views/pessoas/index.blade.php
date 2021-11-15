@extends('adminlte::page')

@section('title', 'Pessoas')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-users"></i>  Pessoas </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Lista de Pessoas Físicas e Jurídicas
        </h3>
    </div>

    <div class="card-body">
        @if(session()->has('mensagem'))
            <div class="alert alert-success">
                {{ session()->get('mensagem') }}
            </div>
        @endif

        <a href="/pessoas/create" class="btn btn-primary mb-5">Novo Registro</a>

        <div class="row">
            <div class="col-sm-12">
                <table id="datatable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Ações</th>
                            <th>Nome</th>
                            <th>Documento</th>
                            <th>Cliente</th>
                            <th>Fornecedor</th>
                            <th>Transportador</th>
                            <th>Status</th>
                        </tr>
                    </thead>
        
                    <tbody>
                        @foreach ($pessoas as $pessoa)
                            <tr>
                                <td>
                                    <a href="/pessoa/{{ $pessoa->id }}/edit" class="btn btn-outline-secondary btn-sm" data-toggle="tooltip" data-placement="top" title="Editar Item"><i class="fas fa-pen"></i></a>
                                    <form action="/pessoa/{{ $pessoa->id }}" class="d-inline-block" method="POST" onSubmit="confirmarExclusao(event)">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" data-toggle="tooltip" data-placement="top" title="Excluir Item"><i class="fas fa-trash"></i></button>
                                    </form>
                                    <a href="/pessoa/{{ $pessoa->id }}" class="btn btn-outline-info btn-sm" data-toggle="tooltip" data-placement="top" title="Exibir Informações Completas"><i class="fas fa-eye"></i></a>
                                </td>
                                <td>{{ $pessoa->nome }}</td>
        
                                @if ($pessoa->tipo == "PF")
                                    <td class="isCPF">{{ $pessoa->cpf_cnpj }}</td>
                                @else
                                    <td class="isCNPJ">{{ $pessoa->cpf_cnpj }}</td>
                                @endif
        
                                @if ($pessoa->cliente)
                                    <td><span class="badge badge-primary">{{ $pessoa->cliente_formatado }}</span></td>
                                @else
                                    <td><span class="badge badge-danger">{{ $pessoa->cliente_formatado }}</span></td>
                                @endif
                                @if ($pessoa->fornecedor)
                                    <td><span class="badge badge-primary">{{ $pessoa->fornecedor_formatado }}</span></td>
                                @else
                                    <td><span class="badge badge-danger">{{ $pessoa->fornecedor_formatado }}</span></td>
                                @endif
                                @if ($pessoa->transportador)
                                    <td><span class="badge badge-primary">{{ $pessoa->transportador_formatado }}</span></td>
                                @else
                                    <td><span class="badge badge-danger">{{ $pessoa->transportador_formatado }}</span></td>
                                @endif
        
                                @switch($pessoa->status)
                                    @case(1)
                                        <td><span class="badge badge-success">{{ $pessoa->status_formatado }}</span></td>
                                        @break
                                    @case(0)
                                        <td><span class="badge badge-danger">{{ $pessoa->status_formatado }}</span></td>
                                        @break
                                @endswitch
        
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        
                <div class="pagination"> {{$pessoas->links() }} </div>
        
            </div>
        </div>
                

    </div>
</div>

@stop