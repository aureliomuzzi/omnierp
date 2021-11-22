<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Pessoa extends Model
{
    use HasFactory;

    protected $table = 'pessoas';
    protected $guarded = ['id', 'created_at', 'updated_at'];
    protected $dates = ['created_at', 'updated_at'];

    const PF = "PF";
    const PJ = "PJ";
    const TIPO = [
        Pessoa::PF => "Pessoa Física",
        Pessoa::PJ => "Pessoa Jurídica"
    ];

    const STATUS_ATIVO = 1;
    const STATUS_INATIVO = 0;
    const STATUS = [
        Pessoa::STATUS_ATIVO => "Ativo",
        Pessoa::STATUS_INATIVO => "Inativo"
    ];

    public function getTipoFormatadoAttribute()
    {
        return Pessoa::TIPO[$this->tipo];
    }

    public function getStatusFormatadoAttribute()
    {
        return Pessoa::STATUS[$this->status];
    }

}
