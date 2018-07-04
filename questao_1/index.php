<?php

//requerendo a função para resolver as equações
require_once('function.php');

/**
 * exibir_resultado
 *
 * chama a função que executa a equação. exibe os resultados na tela
 *
 * @param $a
 * @param $b
 * @param $c
 */
function exibir_resultado($a,$b,$c){

    echo 'Solução para "'.($a!==0?$a.'x²':'').($b!==0?($b>0?'+'.$b.'x':$b.'x'):'').($c!==0?($c>0?'+'.$c:$c):'').'=0": <br>';

    $solucao = equacao_2_grau($a,$b,$c);

    if($solucao){
        foreach($solucao as $key=> $value){

            if( count($solucao)>1 ){
                $num_chave = ' '.($key+1);
            }else{
                $num_chave = '';
            }

            echo 'chave '.$num_chave.': '.$value.'<br>';

        }
    }

    echo '<hr><br>';
}


exibir_resultado(2,12,18);

exibir_resultado(1,3,-10);

exibir_resultado(1,-10,24);

exibir_resultado(1,-2,-3);