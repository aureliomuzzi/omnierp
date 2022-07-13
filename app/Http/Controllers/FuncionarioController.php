<?php

namespace App\Http\Controllers;

use App\Models\Funcionario;
use App\DataTables\FuncionarioDataTable;
use App\Helpers\FuncoesHelper;
use Illuminate\Http\Request;
use App\Http\Requests\FuncionarioRequest;
use App\Services\UploadService;
use App\Services\ValidadorService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(FuncionarioDataTable $dataTable)
    {
        return $dataTable->render('funcionarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('funcionarios.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuncionarioRequest $request)
    {
        try {
            $validador = new ValidadorService();
            $dados = $request->all();

            if ($validador->validaCPF($dados['cpf']) == false) {
                return redirect()->back()->with(['tipo'=>'danger', 'mensagem'=>'O Número de CPF é Inválido.']);
            }

            $dados['cpf'] = FuncoesHelper::removerCaracter($request->cpf);
            $dados['foto'] = isset($dados['foto']) ? UploadService::upload($dados['foto']) : null;

            Funcionario::create($dados);
            return redirect('/funcionarios')->with(['tipo'=>'success', 'mensagem'=>'Registro criado com sucesso!']);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->back()->withErrors(['tipo'=>'danger', 'mensagem'=>'Erro ao realizar operação.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function show(Funcionario $funcionario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function edit(Funcionario $funcionario)
    {

        return view('funcionarios.form', [
            'funcionario' => $funcionario,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funcionario $funcionario)
    {
        try {
            $validador = new ValidadorService();
            $dados = $request->all();

            if ($validador->validaCPF($dados['cpf']) == false) {
                return redirect()->back()->with(['tipo'=>'danger', 'mensagem'=>'O Número de CPF é Inválido.']);
            }

            $dados['cpf'] = FuncoesHelper::removerCaracter($request->cpf);
            $dados['foto'] = isset($request->foto) ? UploadService::upload($request->foto) : $funcionario->foto;

            $funcionario->update($dados);

            return redirect('/funcionarios')->with(['tipo'=>'success', 'mensagem'=>'Registro atualizado com sucesso!']);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->back()->withErrors(['tipo'=>'danger', 'mensagem'=>'Erro ao realizar operação.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Funcionario  $funcionario
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $funcionario = Funcionario::find($id);
        $funcionario->delete();
        return redirect('/funcionarios')->with(['tipo'=>'success', 'mensagem'=>'Registro excluído com sucesso!']);
    }

    public function demissaoRapida($id)
    {
        try {
            $funcionario = Funcionario::find($id);
            $funcionario->data_demissao = date(now());
            $funcionario->update();

            return redirect('/funcionarios')->with(['tipo'=>'success', 'mensagem'=>'Funcionário Demitido!']);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->back()->withErrors(['tipo'=>'danger', 'mensagem'=>'Erro ao realizar operação.']);
        }
    }

    public function readmissaoRapida($id)
    {
        try {
            $funcionario = Funcionario::find($id);
            $funcionario->data_admissao = date(now());
            $funcionario->data_demissao = null;
            $funcionario->update();

            return redirect('/funcionarios')->with(['tipo'=>'success', 'mensagem'=>'Funcionário Readmitido!']);
        } catch (Exception $exception) {
            Log::error($exception);
            return redirect()->back()->withErrors(['tipo'=>'danger', 'mensagem'=>'Erro ao realizar operação.']);
        }
    }
}
