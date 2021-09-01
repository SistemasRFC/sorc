<?php
include_once("../../Dao/BaseDao.php");
class RelMediaDiariaDao extends BaseDao
{
    Public Function RelMediaDiariaDao(){
        $this->conect();
    }
    
    Public Function CarregaRegistros($codCliente){
        $sql = " SELECT DAY(D.DTA_PAGAMENTO) AS DIA,
                        YEAR(D.DTA_PAGAMENTO) AS ANO,
                        AVG(VLR_DESPESA) AS VALOR  
                   FROM EN_DESPESA D
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE D.COD_CLIENTE_FINAL = $codCliente 
                    AND MONTH(D.DTA_PAGAMENTO)>0
                    AND YEAR(D.DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT)."
                  GROUP BY DIA, ANO
                  ORDER BY ANO, DIA";
        return $this->selectDB($sql, false);
    }
}
?>
