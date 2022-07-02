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
            'tipo' => $this->faker->randomElement(array('PF','PJ')),
            'nome' => $this->faker->name,
            'cpf_cnpj' => $this->faker->randomElement(array('93108206400', '46777470670', '62776873000148', '11238512000107')),
            'classificacao' => $this->faker->randomElement(array('MATRIZ', 'FILIAL', 'MEI', 'ONG', 'INDIVIDUAL')),
            'status' => $this->faker->randomElement(array(1,0))
        ];
    }
}
