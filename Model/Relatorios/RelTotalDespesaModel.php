<?
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Relatorios/RelTotalDespesaDao.php");
class RelTotalDespesaModel extends BaseModel
{
    function RelTotalDespesaModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
    Public Function CarregaRegistros($Json=true){
        $dao = new RelTotalDespesaDao();
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
