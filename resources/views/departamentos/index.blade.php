@extends('adminlte::page')

@section('title', 'Departamentos')

@section('content_header')
<h1 class="m-0 text-dark"><i class="fas fa-industry"></i>  Departamentos </h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            Lista de Departamentos
        </h3>
    </div>

    <div class="card-body">
        @if(session()->has('mensagem'))
            <div class="alert alert-success">
                {{ session()->get('mensagem') }}
            </div>
        @endif

        <div class="table-responsive">
            {{ $dataTable->table(['class'=>'table table-striped','style' => 'width: 100%']) }}
        </div>


    </div>
</div>

@stop

@push('js')
    {{ $dataTable->scripts() }}
@endpush
