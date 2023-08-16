<?php
include_once("Dao/BaseDao.php");
class RelatorioResumoAnualDao extends BaseDao
{
    
    Public Function CarregaRegistros($codClienteFinal, $ano) {
        $sql = " SELECT MESES.DSC_MES,
						(SELECT COALESCE(SUM(VLR_RECEITA), 0) AS VLR_RECEITA FROM EN_RECEITA ER
						  WHERE ER.COD_CLIENTE_FINAL = $codClienteFinal
							AND MONTH(DTA_RECEITA) = MESES.NRO_MES
							AND YEAR(DTA_RECEITA)=$ano) AS VLR_RECEITA,
						(SELECT COALESCE(SUM(VLR_DESPESA), 0) AS VLR_DESPESA FROM EN_DESPESA ED 
						  WHERE DTA_PAGAMENTO IS NOT NULL
							AND ED.COD_CLIENTE_FINAL = $codClienteFinal
							AND MONTH(DTA_DESPESA) = MESES.NRO_MES
							AND YEAR(DTA_DESPESA)=$ano) AS VLR_DESPESA
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
						 SELECT 12 NRO_MES, 'DEZEMBRO' DSC_MES) AS MESES
				ORDER BY MESES.NRO_MES";
        return $this->selectDB($sql, false);
    }
}
?>
