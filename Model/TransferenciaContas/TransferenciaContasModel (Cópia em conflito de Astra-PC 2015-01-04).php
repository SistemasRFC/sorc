<?
include_once("../../Model/BaseModel.php");
include_once("../../Dao/TransferenciaContas/TransferenciaContasDao.php");
class TransferenciaContasModel extends BaseModel
{
    function TransferenciaContasModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    function AddTransferenciaContas(){
        $dao = new TransferenciaContasDao();
        return $dao->AddTransferenciaContas($_SESSION['cod_cliente_final']);
    }
    function DeletarTransferencia(){
        $dao = new TransferenciaContasDao();
        return $dao->DeletarTransferencia();
    }
    function UpdateTransferenciaContas(){
        $dao = new TransferenciaContasDao();
        return $dao->UpdateTransferenciaContas();
    }
    Function ListarTransferencias(){
        $dao = new TransferenciaContasDao();
        $lista = $dao->ListarTransferencias($_SESSION['cod_cliente_final']);
        $total = count($lista);
        $i=0;
        $data = array();
        while($i<$total ) {
            $data[] = array(
                'nroSequencial' => $lista[$i]['NRO_SEQUENCIAL'],
                'dscContaOrigem' => $lista[$i]['DSC_CONTA_ORIGEM'],
                'dscContaDestino' => $lista[$i]['DSC_CONTA_DESTINO'],
                'dtaMovimentacao' => $this->ConverteDataBanco($lista[$i]['DTA_MOVIMENTACAO']),
                'vlrMovimentacao' => number_format($lista[$i]['VLR_MOVIMENTACAO'],2,',','.'),
                'codContaOrigem' => $lista[$i]['COD_CONTA_ORIGEM'],
                'codContaDestino' => $lista[$i]['COD_CONTA_DESTINO']
            );
            $i++;
        }
        return json_encode($data);
    }
}
?>
