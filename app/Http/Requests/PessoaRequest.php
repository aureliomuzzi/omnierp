<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'tipo' => 'required',
            'classificacao' => 'required',
            'nome' => 'required',
            'cpf_cnpj' => 'required',
            'status' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'tipo.required' => 'O Tipo de Pessoa é obrigatório',
            'classificacao.required' => 'A Classificacao de Pessoa é obrigatório',
            'nome.required' => 'O campo Nome da Pessoa é obrigatório',
            'cpf_cnpj.required' => 'O número de CPF ou CNPJ é obrigatório',
            'status.required' => 'O campo Status é obrigatório',
        ];
    }
}
