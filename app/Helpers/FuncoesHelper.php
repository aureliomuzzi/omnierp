<?php

namespace App\Helpers;

class FuncoesHelper
{
    public static function removerCaracter($str)
    {
        return preg_replace("/[^0-9]/", "", $str);
    }

    public static function mascaras($mask,$str){

        $str = str_replace(" ","",$str);

        for($i=0;$i<strlen($str);$i++){
            $mask[strpos($mask,"#")] = $str[$i];
        }

        return $mask;
    }
}
