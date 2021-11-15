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

    const IS_CLIENTE = 1;
    const NOT_CLIENTE = 0;
    const CLIENTE = [
        Pessoa::IS_CLIENTE => "Sim",
        Pessoa::NOT_CLIENTE => "Não"
    ];

    const IS_FORNECEDOR = 1;
    const NOT_FORNECEDOR = 0;
    const FORNECEDOR = [
        Pessoa::IS_FORNECEDOR => "Sim",
        Pessoa::NOT_FORNECEDOR => "Não"
    ];

    const IS_TRANSPORTADOR = 1;
    const NOT_TRANSPORTADOR = 0;
    const TRANSPORTADOR = [
        Pessoa::IS_TRANSPORTADOR => "Sim",
        Pessoa::NOT_TRANSPORTADOR => "Não"
    ];

    public function getTipoFormatadoAttribute()
    {
        return Pessoa::TIPO[$this->tipo];
    }

    public function getStatusFormatadoAttribute()
    {
        return Pessoa::STATUS[$this->status];
    }

    public function getClienteFormatadoAttribute()
    {
        return Pessoa::CLIENTE[$this->cliente];
    }

    public function getFornecedorFormatadoAttribute()
    {
        return Pessoa::FORNECEDOR[$this->fornecedor];
    }

    public function getTransportadorFormatadoAttribute()
    {
        return Pessoa::TRANSPORTADOR[$this->transportador];
    }
}
