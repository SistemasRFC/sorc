<?php
include_once("Dao/BaseDao.php");
class TiposDespesaDao extends BaseDao
{
    protected $tableName = "EN_TIPO_DESPESA";

    protected $columns = array(
      "dscTipoDespesa"      => array("column" => "DSC_TIPO_DESPESA",    "typeColumn" => "S"),
      "codClienteFinal"     => array("column" => "COD_CLIENTE_FINAL",   "typeColumn" => "I"),
      "vlrPiso"             => array("column" => "VLR_PISO",            "typeColumn" => "F"),
      "vlrTeto"             => array("column" => "VLR_TETO",            "typeColumn" => "F"),
      "indAtivo"            => array("column" => "IND_ATIVO",           "typeColumn" => "S"),
      "indInvestimento"     => array("column" => "IND_INVESTIMENTO",    "typeColumn" => "S")
    );

    protected $columnKey = array("codTipoDespesa" => array("column" => "COD_TIPO_DESPESA", "typeColumn" => "I"));

    Function AddTipoDespesa(stdClass $obj) {
        return $this->MontarInsert($obj);
    }
    
    Function UpdateTipoDespesa(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Function ListarTiposDespesas($codClienteFinal){
        $sql = " SELECT COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        VLR_PISO,
                        VLR_TETO,
                        IND_ATIVO,
                        IND_INVESTIMENTO
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }

    Function ListarTiposDespesasAtivos($codClienteFinal){
        $sql = " SELECT COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        VLR_PISO,
                        VLR_TETO,
                        IND_ATIVO,
                        IND_INVESTIMENTO
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                    AND IND_ATIVO='S'
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }

    Function ListarTiposDespesaFiltro($codClienteFinal) {
        $sql = " SELECT COD_TIPO_DESPESA as ID,
                        DSC_TIPO_DESPESA as DSC
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                    AND IND_ATIVO = 'S'
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }

    Function ListarSomaTipoDespesas($codClienteFinal, $mes, $ano){
        $sql = " SELECT TP.COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        SUM(VLR_DESPESA) AS VALOR
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

    function VerificarTeto($codClienteFinal, $codTipoDespesa) {
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
    
    function SumarizaPorTipoDespesa($codClienteFinal){
        $sql = " select dsc_tipo_despesa,
                        vlr_teto-vlr_despesa as vlr_total
                   from (
                 select tp.dsc_tipo_despesa,
                            sum(d.vlr_despesa) as vlr_despesa,
                        coalesce(tp.vlr_teto,0) as vlr_teto
                   from en_despesa d
                  inner join en_tipo_despesa tp on d.tpo_despesa = tp.cod_tipo_despesa
                  where (year(dta_lanc_despesa)=year(now()) and month(DTA_LANC_DESPESA)=month(now())
                    and d.cod_cliente_final = $codClienteFinal)
                  group by tp.dsc_tipo_despesa) as x";
        return $this->selectDB($sql, false);
        
    }
}
?>
