<?php
include_once("Dao/BaseDao.php");
class RelatorioTipoDespesaDao extends BaseDao
{

	function ListarSomaTipoDespesasPorPeriodo($codClienteFinal, $inicio, $fim) {
		$sql = " SELECT TP.COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        SUM(VLR_DESPESA) AS VALOR,
						VLR_PISO,
						VLR_TETO
                   FROM EN_DESPESA D
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE D.COD_CLIENTE_FINAL = $codClienteFinal
                    AND D.DTA_DESPESA BETWEEN '$inicio' AND '$fim'
                  GROUP BY TP.COD_TIPO_DESPESA, DSC_TIPO_DESPESA
                  ORDER BY VALOR";
		return $this->selectDB($sql, false);

	}
}
