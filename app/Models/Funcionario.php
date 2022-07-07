<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcionario extends Model
{
    use HasFactory;

    protected $garded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['data_nascimento', 'data_admissao', 'data_demissao', 'created_at', 'updated_at'];
}
