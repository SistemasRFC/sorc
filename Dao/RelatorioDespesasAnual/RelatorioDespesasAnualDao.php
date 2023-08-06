<?php
include_once("Dao/BaseDao.php");
class RelatorioDespesasAnualDao extends BaseDao
{    
    Public Function CarregaRegistros($codClienteFinal, $ano) {
        $sql = " SELECT MESES.DSC_MES,
                        COALESCE(SUM(PD.VLR_DESPESA), 0) AS VLR_PAGO,
                        COALESCE(SUM(TD.VLR_DESPESA), 0) AS VLR_DESPESA
                   FROM (SELECT 1 NRO_MES, 'JANEIRO' DSC_MES
                          UNION 
                         SELECT 2 NRO_MES, 'FEVEREIRO' DSC_MES
                          UNION 
                         SELECT 3 NRO_MES, 'MARÇO' DSC_MES
                          UNION 
                         SELECT 4 NRO_MES, 'ABRIL' DSC_MES
                          UNION 
                         SELECT 5 NRO_MES, 'MAIO' DSC_MES
                          UNION 
                         SELECT 6 NRO_MES, 'JUNHO' DSC_MES
                          UNION 
                         SELECT 7 NRO_MES, 'JULHO' DSC_MES
                          UNION 
                         SELECT 8 NRO_MES, 'AGOSTO' DSC_MES
                          UNION 
                         SELECT 9 NRO_MES, 'SETEMBRO' DSC_MES
                          UNION 
                         SELECT 10 NRO_MES, 'OUTUBRO' DSC_MES
                          UNION 
                         SELECT 11 NRO_MES, 'NOVEMBRO' DSC_MES
                          UNION 
                         SELECT 12 NRO_MES, 'DEZEMBRO' DSC_MES) MESES
               LEFT JOIN EN_DESPESA PD 
                      ON MESES.NRO_MES = MONTH(PD.DTA_DESPESA)
                     AND YEAR(PD.DTA_DESPESA) = $ano
                     AND PD.DTA_PAGAMENTO IS NOT NULL
                     AND PD.COD_CLIENTE_FINAL = $codClienteFinal
               LEFT JOIN EN_DESPESA TD
                      ON MESES.NRO_MES = MONTH(TD.DTA_DESPESA)
                     AND YEAR(TD.DTA_DESPESA) = $ano
                     AND TD.COD_CLIENTE_FINAL = $codClienteFinal
                GROUP BY MESES.NRO_MES, MESES.DSC_MES";
        return $this->selectDB($sql, false);
    }
}
?>
