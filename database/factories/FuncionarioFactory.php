<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Funcionario;

class FuncionarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Funcionario::class;

    public function definition()
    {
        return [
            'nome' => $this->faker->name,
            'data_nascimento' => $this->faker->randomElement(array('1978-02-04', '1964-12-05', '2004-08-28', '1977-09-03')),
            'data_admissao' => $this->faker->randomElement(array('2020-12-15', '2015-05-06', '2019-07-06', '2018-07-04')),
            'identidade' => $this->faker->randomElement(array('123456789', '987456321', '159753456', '963258741', '147568932')),
            'cpf' => $this->faker->randomElement(array('93108206400', '46777470670', '90502101806', '48618559776')),
        ];
    }
}
