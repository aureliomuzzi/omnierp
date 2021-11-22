<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use App\Http\Requests\PessoaRequest;
use App\Helpers\FuncoesHelper;
use App\DataTables\PessoaDataTable;

class PessoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PessoaDataTable $dataTable)
    {
        return $dataTable->render('pessoas.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pessoas.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PessoaRequest $request)
    {
        $dados = [
            'tipo' => $request->tipo,
            'nome' => $request->nome,
            'fantasia' => $request->fantasia,
            'cpf_cnpj' => FuncoesHelper::removerCaracter($request->cpf_cnpj),
            'classificacao' => $request->classificacao,
            'cliente' => $request->cliente,
            'fornecedor' => $request->fornecedor,
            'transportador' => $request->transportador,
            'status' => $request->status
        ];

        Pessoa::create($dados);

        return redirect('/pessoas')->with('mensagem', 'Registro criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function show(Pessoa $pessoa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function edit(Pessoa $pessoa)
    {
        return view('pessoas.form', [
            'pessoa' => $pessoa
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function update(PessoaRequest $request, Pessoa $pessoa)
    {
        $dados = [
            'tipo' => $request->tipo,
            'nome' => $request->nome,
            'fantasia' => $request->fantasia,
            'cpf_cnpj' => FuncoesHelper::removerCaracter($request->cpf_cnpj),
            'classificacao' => $request->classificacao,
            'cliente' => $request->cliente == '' ? 0 : 1,
            'fornecedor' => $request->fornecedor == '' ? 0 : 1,
            'transportador' => $request->transportador == '' ? 0 : 1,
            'status' => $request->status == '' ? 0 : 1
        ];

        $pessoa->update($dados);

        return redirect('/pessoas')->with('mensagem', 'Registro criado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pessoa  $pessoa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pessoa $pessoa)
    {
        $pessoa->delete();

        return redirect('/pessoas')->with('mensagem', 'Registro excluído com sucesso!');
    }

    // $codigos = [
    //     4001, 4006, 4007, 4023, 4029, 4033, 4034, 4056, 4061, 4063, 4071, 4085, 4086, 4088, 4091,
    //     4092, 4093, 4096, 4100, 4103, 4117, 4118, 4120, 4121, 4122, 4123, 4131, 4135, 4150, 4151,
    //     4152, 4153, 4155, 4156, 4158, 4162, 4164, 4165, 4168, 4169, 4173, 4174, 4178, 4180, 4185,
    //     4186, 4187, 4188, 4189, 4191, 4192, 4193, 4195, 4198, 4199, 4200, 4201, 4202, 4203, 4206,
    //     4209, 4213, 4218, 4219, 4223, 4224, 4225, 4226, 4227, 4228, 4235, 4236, 4241, 4242, 4249,
    //     4253, 4254, 4259, 4265, 4065, 4076, 4107, 4255, 4108, 4237, 4244, 4145, 4239, 4177, 512,
    //     523, 559, 580, 598, 670, 788
    // ];
}
