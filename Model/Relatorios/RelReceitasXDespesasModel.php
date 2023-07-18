<?php
include_once("Model/BaseModel.php");
include_once("Dao/Relatorios/RelReceitasXDespesasDao.php");
class RelReceitasXDespesasModel extends BaseModel
{
    function RelReceitasXDespesasModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
    Public Function CarregaRegistros($Json=true){
        $dao = new RelReceitasXDespesasDao();
        $lista = $dao->CarregaRegistros($_SESSION['cod_cliente_final']);
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }
    
    Public Function ListarAnos($Json=true){
        $nroAno = date("Y")+1;
        $anos = array();
        $j=0;
        for($i=2012;$i<=$nroAno;$i++){            
            $anos[$j] = array('NRO_ANO_REFERENCIA' => $i);
            $j++;
        }
        if ($Json){
            return json_encode($anos);
        }else{
            return $anos;
        }
    }
}
?>
