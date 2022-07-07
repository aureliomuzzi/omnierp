<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioRequest extends FormRequest
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
            'nome' => 'required',
            'data_nascimento' => 'required',
            'data_admissao' => 'required',
            'cpf' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O Nome do Funcionário é obrigatório',
            'data_nascimento.required' => 'A Data de Nascimento é obrigatória',
            'data_admissao.required' => 'A Data de Admissão é obrigatória',
            'cpf.required' => 'O CPF do Funcionário é obrigatório'
        ];
    }
}
