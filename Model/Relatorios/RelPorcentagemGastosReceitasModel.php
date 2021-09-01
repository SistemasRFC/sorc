<?
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Relatorios/RelPorcentagemGastosReceitasDao.php");
class RelPorcentagemGastosReceitasModel extends BaseModel
{
    function RelPorcentagemGastosReceitasModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
    Public Function CarregaRegistros($Json=true){
        $dao = new RelPorcentagemGastosReceitasDao();
        $mes = filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_STRING);
        if ($mes==''){
            $mes=date('m');
        }
        if ($ano==''){
            $ano=date('Y');
        }            
        $lista = $dao->CarregaRegistros($_SESSION['cod_cliente_final'], $mes, $ano);
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
