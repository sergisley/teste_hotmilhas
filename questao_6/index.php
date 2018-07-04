<?php

//iniciando loop
while(true) {

    //iniciando variáveis
    $rows = array();
    $quadrants = array();
    $cols = array();
    $sudoku_final_rows = array();

    //percorrendo os quadrantes
    for ($q = 0; $q <= 8; $q++) {

        //setando os valores possíveis para cada quadrante
        $possible_values = array(1, 2, 3, 4, 5, 6, 7, 8, 9);

        //percorrendo as 3 linhas possíveis no quadrante
        for ($r = 0; $r <= 2; $r++) {

            //percorrendo as 3 colunas possíveis no quadrante
            for ($c = 0; $c <= 2; $c++) {

                //setando o index da linha conforme valor absoluto, ou seja, desconsiderando o quadrante
                $row_index = $r;

                if ($q > 2 && $q < 6) {
                    $row_index += 3;
                } elseif ($q >= 6) {
                    $row_index += 6;
                }

                //setando o index da coluna conforme valor absoluto, desconsiderando o quadrante
                $col_index = $c;

                if ($q == 1 || $q == 4 || $q == 7) {
                    $col_index += 3;
                } elseif ($q == 2 || $q == 5 || $q == 8) {
                    $col_index += 6;
                }

                //iniciando o array que guardará os valores já usados neste quadrante, se não existir
                if (!isset($quadrants[$q])) {
                    $quadrants[$q] = array();
                }

                //iniciando o array que guardará os valores já usados nesta linha, se não existir
                if (!isset($rows[$row_index])) {
                    $rows[$row_index] = array();
                }

                //iniciando o array que guardará os valores já usados nesta coluna, se não existir
                if (!isset($cols[$col_index])) {
                    $cols[$col_index] = array();
                }

                //subtrai dos valroes possíveis os valores já usados no quadrante, linha e coluna
                $poss_vals = array_diff($possible_values,$quadrants[$q],  $rows[$row_index],$cols[$col_index]);

                //caso um valor seja colocado em um lugar ambíguo ao mesmo mas obrigatório a outro, os valores possíveis
                //estarão vazios. reiniciar o loop
                if(empty($poss_vals)){
                    continue(4);
                }

                //seleciona um valor randomicamente dentre os possíveis
                $value = $poss_vals[array_rand($poss_vals, 1)];

                //remove dos valores possíveis o valor encontrado
                if ( ( $key = array_search ($value, $possible_values ) ) !== false) {
                    unset($possible_values[$key]);
                }

                //carrega nos arrays de quadrante, linha e coluna o valor encontrado para que o mesmo não seja mais utilizado
                //nas respectivas áreas
                $quadrants[$q][]   =   $rows[$row_index][]  =   $cols[$col_index][] = $value;



                //carregando valor final para posterior exibição
                $sudoku_final_rows[$row_index][] = $value;

            }

        }

    }

    break;

}


echo  '<div style="font-size: 40px;text-align: center">';

//exibindo o sudoku
//iniciando loop
for($r=0;$r<=8;$r++){

    //exibir linha tracejada acima dos quadrantes
    if ($r == 0|| $r ==3 || $r ==6 ){
        echo '-----------------------------------<br>';
    }

    //percorrendo cada coluna
    for($c=0;$c<=8;$c++) {

        //carregando valores
        $value = $sudoku_final_rows[$r][$c];

        //exibindo valores
        if($c==0){
            echo ' || '.$value;
        }elseif($c==8){
            echo ' | '.$value.' ||<br>';
        }elseif($c==3||$c==6){
            echo ' || '.$value;
        }else{
            echo ' | '.$value;
        }

    }

    //exibir linha tracejada abaixo do último quadrante
    if ( $r == 8){
        echo '-----------------------------------<br>';
    }


}


echo  '</div>';


