<?php
include_once("../Dao/BaseDao.php");
class TiposDespesaDao extends BaseDao
{
	public function ListarTiposDespesasAtivos($codClienteFinal)
	{
		$sql = " SELECT COD_TIPO_DESPESA AS ID,
                        DSC_TIPO_DESPESA AS DSC
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                    AND IND_ATIVO = 'S'
               ORDER BY DSC_TIPO_DESPESA";
		return $this->selectDB($sql, false);
	}

	function VerificarTeto($codClienteFinal, $codTipoDespesa)
	{
		$sql = " SELECT COALESCE(TP.VLR_TETO, 0) AS VLR_TETO,
                      	COALESCE(SUM(D.VLR_DESPESA), 0) AS VLR_GASTO
                   FROM EN_TIPO_DESPESA TP
              LEFT JOIN EN_DESPESA D
                     ON TP.COD_TIPO_DESPESA = D.TPO_DESPESA
                    AND D.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(D.DTA_LANC_DESPESA)= MONTH(now())
                    AND YEAR(D.DTA_LANC_DESPESA)= YEAR(now())
                  WHERE TP.COD_TIPO_DESPESA = $codTipoDespesa
               GROUP BY TP.COD_TIPO_DESPESA";
		return $this->selectDB($sql, false);
	}

	function ListarSomaTipoDespesas($codClienteFinal, $mes, $ano)
	{
		$sql = " SELECT TP.COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        SUM(VLR_DESPESA) AS VALOR,
						VLR_TETO,
						SUM(VLR_DESPESA)*100/VLR_TETO AS PORCENT
                   FROM EN_DESPESA D
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE D.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(D.DTA_DESPESA)= $mes
                    AND YEAR(D.DTA_DESPESA)= $ano
                  GROUP BY TP.COD_TIPO_DESPESA, DSC_TIPO_DESPESA
                  ORDER BY VALOR";
		return $this->selectDB($sql, false);
	}
}
