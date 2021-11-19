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
}
