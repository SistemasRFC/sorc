<?php
include_once("../Dao/BaseDao.php");
class DespesasDao extends BaseDao
{
	protected $tableName = "EN_DESPESA";

	protected $columns = array(
		"dscDespesa"            => array("column" => "DSC_DESPESA",             "typeColumn" => "S"),
		"dtaDespesa"            => array("column" => "DTA_DESPESA",             "typeColumn" => "D"),
		"codConta"              => array("column" => "COD_CONTA",               "typeColumn" => "I"),
		"tpoDespesa"            => array("column" => "TPO_DESPESA",             "typeColumn" => "I"),
		"vlrDespesa"            => array("column" => "VLR_DESPESA",             "typeColumn" => "F"),
		"codClienteFinal"       => array("column" => "COD_CLIENTE_FINAL",       "typeColumn" => "I"),
		"indDespesaPaga"        => array("column" => "IND_DESPESA_PAGA",        "typeColumn" => "S"),
		"dtaPagamento"          => array("column" => "DTA_PAGAMENTO",           "typeColumn" => "D"),
		"codDespesaImportacao"  => array("column" => "COD_DESPESA_IMPORTACAO",  "typeColumn" => "I"),
		"qtdParcelas"           => array("column" => "QTD_PARCELAS",            "typeColumn" => "I"),
		"nroParcelaAtual"       => array("column" => "NRO_PARCELA_ATUAL",       "typeColumn" => "I"),
		"dtaLancDespesa"        => array("column" => "DTA_LANC_DESPESA",        "typeColumn" => "D"),
		"codUsuarioDespesa"     => array("column" => "COD_USUARIO_DESPESA",     "typeColumn" => "I")
	);

  	protected $columnKey = array("codDespesa" => array("column" => "COD_DESPESA", "typeColumn" => "I"));

    function AddDespesa(stdClass $obj) {
        $obj->codDespesa = $this->CatchUltimoCodigo('EN_DESPESA', 'COD_DESPESA');
        return $this->MontarInsert($obj);
    }

    function UpdateDespesa(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Function ListarDespesas($codClienteFinal){
        $mes = filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_NUMBER_INT);
        $ano = filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT);
        if ($mes==""){
            $mes = date("m");
        }
        if ($ano==''){
            $ano = date("Y");
        }
        $sql = " SELECT COD_DESPESA,
                        DTA_DESPESA,
                        DTA_LANC_DESPESA,
                        VLR_DESPESA,
                        DSC_DESPESA,
                        TPO_DESPESA,
                        TP.DSC_TIPO_DESPESA,
                        TP.COD_TIPO_DESPESA,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS CONTA,
                        R.COD_CONTA,
                        CASE WHEN R.IND_DESPESA_PAGA='S' THEN 'Despesa Paga' ELSE 'Em Aberto' END AS IND_DESPESA_PAGA,
                        IND_DESPESA_PAGA AS IND_PAGO,
                        R.DTA_PAGAMENTO,
                        COALESCE(QTD_PARCELAS,1) AS QTD_PARCELAS,
                        COALESCE(NRO_PARCELA_ATUAL,1) AS NRO_PARCELA_ATUAL,
                        COALESCE(QTD_PARCELAS,1)-COALESCE(NRO_PARCELA_ATUAL,1) AS NRO_PARCELA_RESTANTES,
                        CASE WHEN COD_DESPESA_IMPORTACAO>0 THEN 'Despesa Importada' ELSE 'Mês atual' END AS IND_ORIGEM_DESPESA,
                        R.COD_USUARIO_DESPESA,
                        U.NME_USUARIO_COMPLETO AS DONO_DESPESA,
                        C.IND_IS_CARTAO
                   FROM EN_DESPESA R
              LEFT JOIN EN_CONTA C
                     ON R.COD_CONTA = C.COD_CONTA
             INNER JOIN EN_TIPO_DESPESA TP
                     ON R.TPO_DESPESA = TP.COD_TIPO_DESPESA
              LEFT JOIN SE_USUARIO U
                     ON R.COD_USUARIO_DESPESA = U.COD_USUARIO
                  WHERE r.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_DESPESA)= ".$mes."
                    AND YEAR(DTA_DESPESA)=".$ano."
               ORDER BY DTA_DESPESA";
        return $this->selectDB($sql, false);
    }

    function RetornaDespesaPorCodigo(stdClass $obj) {
        return $this->MontarSelect('WHERE COD_DESPESA = '.$obj->codDespesa);
    }
}
?>
