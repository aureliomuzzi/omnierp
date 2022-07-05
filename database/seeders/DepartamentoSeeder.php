<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departamentos = [
            'RH',
            'TI',
            'FINANCEIRO',
            'CONTABILIDADE',
            'MARKETING',
            'ENGENHARIA',
            'LIMPEZA',
            'LOGISTICA',
            'ADMINISTRATIVO',
            'GERENCIA',
            'DIRETORIA',
            'DESENVOLVIMENTO'
        ];

        foreach($departamentos as $d) {
            Departamento::create(['descricao'=>$d]) ;
        }
    }
}
