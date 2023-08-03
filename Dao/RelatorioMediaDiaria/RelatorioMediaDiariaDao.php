<?php
include_once("Dao/BaseDao.php");
class RelatorioMediaDiariaDao extends BaseDao
{

    Public Function BuscarMediaDiaria($codClienteFinal){
		$ano = filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_NUMBER_INT);
        $sql = " SELECT DIAS.NRO_DIA,
						COALESCE(VLR_DESPESA, 0) AS VALOR
				   FROM (SELECT 1 NRO_DIA UNION SELECT 2 NRO_DIA
						  UNION 
						 SELECT 3 NRO_DIA
						  UNION 
						 SELECT 4 NRO_DIA
						  UNION 
						 SELECT 5 NRO_DIA
						  UNION 
				 		 SELECT 6 NRO_DIA
						  UNION 
						 SELECT 7 NRO_DIA
						  UNION 
						 SELECT 8 NRO_DIA
						  UNION 
						 SELECT 9 NRO_DIA
						  UNION 
						 SELECT 10 NRO_DIA
						  UNION 
						 SELECT 11 NRO_DIA
						  UNION 
						 SELECT 12 NRO_DIA
						  UNION 
						 SELECT 13 NRO_DIA
						  UNION 
						 SELECT 14 NRO_DIA
						  UNION 
						 SELECT 15 NRO_DIA
						  UNION 
						 SELECT 16 NRO_DIA
						  UNION 
						 SELECT 17 NRO_DIA
						  UNION 
						 SELECT 18 NRO_DIA
						  UNION 
						 SELECT 19 NRO_DIA
						  UNION 
						 SELECT 20 NRO_DIA
						  UNION 
						 SELECT 21 NRO_DIA
					 	  UNION 
						 SELECT 22 NRO_DIA
						  UNION 
						 SELECT 23 NRO_DIA
						  UNION 
						 SELECT 24 NRO_DIA
						  UNION 
						 SELECT 25 NRO_DIA
						  UNION 
						 SELECT 26 NRO_DIA
						  UNION 
						 SELECT 27 NRO_DIA
					 	  UNION 
						 SELECT 28 NRO_DIA
						  UNION 
						 SELECT 29 NRO_DIA
						  UNION 
						 SELECT 30 NRO_DIA
						  UNION 
						 SELECT 31 NRO_DIA
						) DIAS
			  LEFT JOIN EN_DESPESA ED
			  		 ON DIAS.NRO_DIA = DAY(ED.DTA_PAGAMENTO)
					AND YEAR(ED.DTA_PAGAMENTO) = $ano
					AND MONTH(ED.DTA_PAGAMENTO) = MONTH(NOW())
					AND ED.COD_CLIENTE_FINAL = $codClienteFinal
			   GROUP BY DIAS.NRO_DIA";
        return $this->selectDB($sql, false);
    }

    // Public Function BuscarMediaDiaria($codClienteFinal){
    //     $sql = " SELECT DAY(D.DTA_PAGAMENTO) AS DIA,
    //                     YEAR(D.DTA_PAGAMENTO) AS ANO,
    //                     AVG(VLR_DESPESA) AS VALOR  
    //                FROM EN_DESPESA D
    //               INNER JOIN EN_TIPO_DESPESA TP
    //                  ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
    //               WHERE D.COD_CLIENTE_FINAL = $codClienteFinal 
    //                 AND MONTH(D.DTA_PAGAMENTO)>0
    //                 AND YEAR(D.DTA_PAGAMENTO)=".filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_NUMBER_INT)."
    //               GROUP BY DIA, ANO
    //               ORDER BY ANO, DIA";
    //     return $this->selectDB($sql, false);
    // }
}
?>
