<?
include_once("Model/BaseModel.php");
include_once("Dao/Relatorios/RelDespesasPagamentoDao.php");
class RelDespesasPagamentoModel extends BaseModel
{
    function RelDespesasPagamentoModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
    Public Function CarregaRegistros($Json=true){
        $dao = new RelDespesasPagamentoDao();
        $lista = $dao->CarregaRegistros($_SESSION['cod_cliente_final']);
        $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_PAGAMENTO');
        $vlrTotal = 0;
        for($i=0;$i<count($lista[1]);$i++){
            $vlrTotal += $lista[1][$i]['VLR_DESPESA'];
            $lista[1][$i]['DSC_DESPESA']=  strtoupper($lista[1][$i]['DSC_DESPESA']);
        }
        $lista = BaseModel::FormataMoedaInArray($lista, 'VLR_DESPESA');
        $lista[2] = number_format($vlrTotal,2,",",".");
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
