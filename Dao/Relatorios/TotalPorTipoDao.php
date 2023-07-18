<?php
include_once("Dao/BaseDao.php");
class TotalPorTipoDao extends BaseDao
{
    Public Function TotalPorTipoDao(){
        $this->conect();
    }
    
    Public Function ListarDespesasPorTipo($codCliente){
        $sql = "SELECT TP.DSC_TIPO_DESPESA,
                       SUM(VLR_DESPESA) AS VLR_DESPESA 
                  FROM EN_DESPESA D
                 INNER JOIN EN_TIPO_DESPESA TP
                    ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                 WHERE (MONTH(DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_NUMBER_INT)." 
                   AND YEAR(DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT).")
                   AND D.COD_CLIENTE_FINAL = $codCliente 
                 GROUP BY TP.DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }
}
?>
