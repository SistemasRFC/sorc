<?php

class FuncoesArray{
    
    /**
     * Cria um campo boolean, chamado ATIVO, dentro de um array passado como par�metro a partir de um campo String que venha com valor S ou N
     * @param Array $lista
     * @param String $campo
     * @return Array
     */
    Public Static Function AtualizaBooleanInArray($lista, $campo, $campoNovo) {
        $listaAtualizada = $lista;
        $booleans = explode('|', $campo);
        $booleansNovo = explode('|', $campoNovo);
        for ($i = 0; $i < count($listaAtualizada[1]); $i++) {
            for ($j = 0; $j < count($booleans); $j++) {
                if ($listaAtualizada[1][$i][$booleans[$j]] == "S") {
                    $listaAtualizada[1][$i][$booleansNovo[$j]] = true;
                } else {
                    $listaAtualizada[1][$i][$booleansNovo[$j]] = false;
                }
            }
        }
        return $listaAtualizada;
    }

    Public Function ConcatenaArrays($array1, $array2) {
        for ($i = 0; $i < count($array2); $i++) {
            $array1[] = $array2[$i];
        }
        return $array1;
    }
    
    Public Static Function RecursiveArrayUtf8Encode($array){
        $listaAtualizada = $array;
        for ($i = 0; $i < count($listaAtualizada[1]); $i++) {
            foreach($listaAtualizada[1][$i] as $key=>$value) {
                $listaAtualizada[1][$i][$key] = utf8_encode($value);
            }
        }
        return $listaAtualizada;        
    }
    
    /**
     * Recebe um ResultSet e tranforma em um Array
     * @param ResultSet $array
     * @return Array
     */
    Public Static Function CarregaArray($array){
        $i=0;
        while ($rs = mysqli_fetch_array($array)){
            $resulta[$i] = $rs;
            $i++;
        }
        if(!isset($resulta)){
            $resulta = null;
        }        
        return $resulta;
    }
}