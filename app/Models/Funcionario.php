<?php

namespace App\Models;

use App\Helpers\FuncoesHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Funcionario extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    
    protected $table = 'funcionarios';
    protected $garded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['data_nascimento', 'data_admissao', 'data_demissao', 'created_at', 'updated_at'];
    protected $fillable = ['nome', 'data_nascimento', 'data_admissao', 'data_demissao', 'identidade', 'cpf', 'foto'];

    public function getCpfFormatadoAttribute()
    {
        return FuncoesHelper::mascara($this->cpf, "cpf");
    }
}
