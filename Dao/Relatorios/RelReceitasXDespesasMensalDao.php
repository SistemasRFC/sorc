<?php
include_once("../../Dao/BaseDao.php");
class RelReceitasXDespesasMensalDao extends BaseDao
{
    Public Function RelReceitasXDespesasMensalDao(){
        $this->conect();
    }
    
    Public Function CarregaRegistros($codCliente){
        $sql = " SELECT MONTH(DOU.DTA_PAGAMENTO) AS NRO_MES_REFERENCIA,
                        CASE WHEN MONTH(DOU.DTA_PAGAMENTO)=01 THEN 'Janeiro'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=02 THEN 'Fevereiro'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=03 THEN 'Março'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=04 THEN 'Abril'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=05 THEN 'Maio'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=06 THEN 'Junho'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=07 THEN 'Julho'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=08 THEN 'Agosto'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=09 THEN 'Setembro'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=10 THEN 'Outubro'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=11 THEN 'Novembro'
                             WHEN MONTH(DOU.DTA_PAGAMENTO)=12 THEN 'Dezembro' END AS MES,
                         YEAR(DOU.DTA_PAGAMENTO) AS ANO,
                       (SELECT SUM(VLR_DESPESA) AS VLR_DESPESA
                          FROM EN_DESPESA DI
                         WHERE (MONTH(DI.DTA_PAGAMENTO) = MONTH(DOU.DTA_PAGAMENTO) 
                           AND YEAR(DI.DTA_PAGAMENTO) = YEAR(DOU.DTA_PAGAMENTO))
                           AND DI.COD_CLIENTE_FINAL = $codCliente) AS VLR_DESPESA,
                       (SELECT SUM(VLR_RECEITA) AS VLR_RECEITA
                          FROM EN_RECEITA DI
                         WHERE (MONTH(DI.DTA_RECEITA) = MONTH(DOU.DTA_PAGAMENTO) 
                           AND YEAR(DI.DTA_RECEITA) = YEAR(DOU.DTA_PAGAMENTO))
                           AND DI.COD_CLIENTE_FINAL = $codCliente) AS VLR_RECEITA
                  FROM EN_DESPESA DOU
                 WHERE MONTH(DOU.DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_NUMBER_INT)."
                    AND YEAR(DOU.DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT)."
                 GROUP BY ANO, MES
                 ORDER BY ANO, NRO_MES_REFERENCIA";
        return $this->selectDB($sql, false);
    }
}
?>
