<?php

/**
 * equacao_2_grau
 *
 * recebe as 3 raízes da equação e retorna os resultados em array
 *
 * @param $a
 * @param $b
 * @param $c
 * @return array
 */
function equacao_2_grau($a,$b,$c){

    //calculando primeira raiz
    $x1 = (  ( -$b + sqrt( pow( $b,2 ) - 4 * $a  *$c ) ) / ( 2 * $a ) );

    //calculando segunda raiz
    $x2 =  (  ( -$b - sqrt( pow( $b,2 ) - 4 * $a  *$c ) ) / ( 2 * $a ) );

    //confere se as duas raizes são iguais. sendo, retorna a raiz única
    if($x1 != $x2){
        $ret = array(
            $x1, $x2
        );
    }else{
        $ret = array(
             $x1
        );
    }

    return $ret;

}

