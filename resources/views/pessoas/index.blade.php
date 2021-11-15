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

    </div>
</div>

@stop