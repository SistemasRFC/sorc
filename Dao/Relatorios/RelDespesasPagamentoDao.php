<?php
include_once("../../Dao/BaseDao.php");
class RelDespesasPagamentoDao extends BaseDao
{
    Public Function RelDespesasPagamentoDao(){
        $this->conect();
    }
    
    Public Function CarregaRegistros($codCliente){
        $sql = " SELECT DTA_PAGAMENTO,
                        DSC_DESPESA,
                        VLR_DESPESA
                   FROM EN_DESPESA D
                  WHERE D.COD_CLIENTE_FINAL = $codCliente 
                    AND YEAR(D.DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT)."
                    AND MONTH(D.DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_NUMBER_INT)."
                  ORDER BY DTA_PAGAMENTO, DSC_DESPESA";
        return $this->selectDB($sql, false);
    }
}
?>
