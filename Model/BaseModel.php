<?
class BaseModel
{
    function BaseModel(){              

    }
    
   /**
     * Converte a data que vem do banco para ser visualizada no form
     * @param <type> $data
     * @return <type>
     */
    Public Static function ConverteDataBanco($data, $hora=false){
        if ($data!='0000-00-00'){
            $dataReturn = substr($data, 8,2).'/'.substr($data, 5,2).'/'.substr($data,0,4);
            if ($hora){
                $dataReturn = $dataReturn." ".substr($data,11,8);
            }
        }else{
            $dataReturn='';
        }
        return $dataReturn;
    }
    
    Public function ConsoleLog($mensagem){
      echo "<script>console.log('$mensagem');</script>";
    }

    Public Function AddDiasData($dtaPagamento,
                                $qtdDias){
        $quebrarDatas = explode("/", $dtaPagamento);
        list($dia, $mes, $ano) = $quebrarDatas;
        $dataNova = date('d/m/Y', mktime(0,0,0, $mes, $dia + $qtdDias, $ano));
        return $dataNova;
    }

    function diffDate($CheckIn,$CheckOut){
        $CheckInX = explode("-", $CheckIn);
        $CheckOutX =  explode("-", $CheckOut);
        $date1 =  mktime(0, 0, 0, $CheckInX[1],$CheckInX[2],$CheckInX[0]);
        $date2 =  mktime(0, 0, 0, $CheckOutX[1],$CheckOutX[2],$CheckOutX[0]);
         $interval =($date2 - $date1)/(3600*24);

        // returns numberofdays
        return  $interval ;

    }
    
    /**
     * Cria um campo boolean, chamado ATIVO, dentro de um array passado como parâmetro a partir de um campo String que venha com valor S ou N
     * @param Array $lista
     * @param String $campo
     * @return Array
     */
    Public Static Function AtualizaBooleanInArray($lista, $campo, $campoNovo){
        $listaAtualizada = $lista;
        $booleans = explode('|', $campo); 
        $booleansNovo = explode('|', $campoNovo);
        for($i=0;$i<count($listaAtualizada[1]);$i++){ 
            for ($j=0;$j<count($booleans);$j++){
                if ($listaAtualizada[1][$i][$booleans[$j]]=="S"){
                    $listaAtualizada[1][$i][$booleansNovo[$j]] = true;
                }else{
                    $listaAtualizada[1][$i][$booleansNovo[$j]] = false;
                }
            }
        }        
        return $listaAtualizada;
    }
    
    /**
     * Atualiza o campo data passado como parâmetro dentro de um array
     * @param Array $lista
     * @param Date $campo
     * @return String
     */
    Public Static Function AtualizaDataInArray($lista, $campo){
        $listaAtualizada = $lista;
        $datas = explode('|', $campo);           
        for($i=0;$i<count($listaAtualizada[1]);$i++){
            for ($j=0;$j<count($datas);$j++){
                $listaAtualizada[1][$i][$datas[$j]] = BaseModel::ConverteDataBanco($listaAtualizada[1][$i][$datas[$j]]);
            }
        }
        return $listaAtualizada;
    }
    
    Public Static Function FormataMoedaInArray($lista, $campo){
        $listaAtualizada = $lista;
        $datas = explode('|', $campo);        
        for($i=0;$i<count($listaAtualizada[1]);$i++){
            for ($j=0;$j<count($datas);$j++){
                $listaAtualizada[1][$i][$datas[$j]] = number_format($listaAtualizada[1][$i][$datas[$j]],2,",",".");
            }
        }
        return $listaAtualizada;        
    }
}
?>
