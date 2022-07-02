<?php

namespace App\Services;

class Validador{

	public function validaCPF($cpf = null) {

	    if(empty($cpf)) {
	        return false;
	    }

	    $cpf = str_replace(['.','-'],'',$cpf);

	    if (strlen($cpf) != 11) {
	        return false;
	    }

	    else if ($cpf == '00000000000' ||
                $cpf == '11111111111' ||
                $cpf == '22222222222' ||
                $cpf == '33333333333' ||
                $cpf == '44444444444' ||
                $cpf == '55555555555' ||
                $cpf == '66666666666' ||
                $cpf == '77777777777' ||
                $cpf == '88888888888' ||
                $cpf == '99999999999') {
	        return false;

	     } else {

	        for ($t = 9; $t < 11; $t++) {

	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	            $d = ((10 * $d) % 11) % 10;
	            if ($cpf{$c} != $d) {
	                return false;
	            }
	        }

            return true;
	    }
	}

	public function validaCNPJ( $cnpj ) {
	    $cnpj = preg_replace( '/[^0-9]/', '', $cnpj );

	    $cnpj = (string)$cnpj;

	    $cnpj_original = $cnpj;

	    $primeiros_numeros_cnpj = substr( $cnpj, 0, 12 );

	    if (!function_exists('multiplica_cnpj') ) {
	        function multiplica_cnpj( $cnpj, $posicao = 5 ) {
	            $calculo = 0;
	            for ( $i = 0; $i < strlen( $cnpj ); $i++ ) {
	                $calculo = $calculo + ( $cnpj[$i] * $posicao );
	                $posicao--;
	                if ( $posicao < 2 ) {
	                    $posicao = 9;
	                }
	            }
	            return $calculo;
	        }
	    }

	    $primeiro_calculo = multiplica_cnpj( $primeiros_numeros_cnpj );

	    $primeiro_digito = ( $primeiro_calculo % 11 ) < 2 ? 0 :  11 - ( $primeiro_calculo % 11 );

	    $primeiros_numeros_cnpj .= $primeiro_digito;

	    $segundo_calculo = multiplica_cnpj( $primeiros_numeros_cnpj, 6 );

        $segundo_digito = ( $segundo_calculo % 11 ) < 2 ? 0 :  11 - ( $segundo_calculo % 11 );

	    $cnpj = $primeiros_numeros_cnpj . $segundo_digito;

	    if ( $cnpj === $cnpj_original ) {
	        return true;
	    }
	}

}
