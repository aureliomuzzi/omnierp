<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pessoa;

class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Pessoa::class;

    public function definition()
    {
        return [
            'tipo' => 'PF',
            'nome' => $this->faker->name,
            'cpf_cnpj' => $this->faker->randomElement(array('93108206400', '46777470670', '90502101806', '48618559776')),
            'classificacao' => 'INDIVIDUAL',
            'status' => $this->faker->randomElement(array(1,0)),
            'cliente' => $this->faker->randomElement(array(1,0)),
            'fornecedor' => $this->faker->randomElement(array(1,0)),
            'transportador' => $this->faker->randomElement(array(1,0)),
        ];
    }
}
