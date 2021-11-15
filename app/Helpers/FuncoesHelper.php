<?php

namespace App\Helpers;

class FuncoesHelper
{
    public static function removerCaracter($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }
}