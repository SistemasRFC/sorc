<?php
include_once("Dao/BaseDao.php");
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

    Function DeletarDespesa($codDepesaImportada=null){
        $sql = " DELETE FROM EN_DESPESA
                  WHERE COD_DESPESA = ".filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        if ($codDepesaImportada!=null){
            $sql .= " AND COD_DESPESA_IMPORTACAO = ".$codDepesaImportada."
                      AND (IND_DESPESA_PAGA IS NULL OR IND_DESPESA_PAGA = 'N')";
        }
        return $this->insertDB($sql);
    }
    
    Public Function PegaDespesaPai(){
        $sql = "SELECT CASE WHEN COD_DESPESA_IMPORTACAO IS NULL THEN COD_DESPESA ELSE COD_DESPESA_IMPORTACAO END AS COD_DESPESA_IMPORTACAO
                  FROM EN_DESPESA
                 WHERE COD_DESPESA = ".filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        return $this->selectDB($sql, false);
    }
    
    Function ListarDespesas($codClienteFinal,
                            $param = null){
        $mes = filter_input(INPUT_POST, 'mesFiltro', FILTER_SANITIZE_NUMBER_INT);
        $ano = filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_NUMBER_INT);
        if ($mes==""){
            $mes = date("m");
        }
        if ($ano==''){
            $ano = date("Y");
        }
        $sql = " SELECT DISTINCT COD_DESPESA,
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
                        IND_DESPESA_PAGA AS IND_DESPESA_PAGA,
                        R.DTA_PAGAMENTO,
                        COALESCE(QTD_PARCELAS,1) AS QTD_PARCELAS,
                        COALESCE(NRO_PARCELA_ATUAL,1) AS NRO_PARCELA_ATUAL,
                        COALESCE(QTD_PARCELAS,1)-COALESCE(NRO_PARCELA_ATUAL,1) AS NRO_PARCELA_RESTANTES,
                        CASE WHEN COD_DESPESA_IMPORTACAO>0 THEN 'Despesa Importada' ELSE 'Mês atual' END AS IND_ORIGEM_DESPESA,
                        R.COD_USUARIO_DESPESA,
                        U.NME_USUARIO_COMPLETO AS DONO_DESPESA
                   FROM EN_DESPESA R
                  LEFT JOIN EN_CONTA C
                     ON R.COD_CONTA = C.COD_CONTA
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON R.TPO_DESPESA = TP.COD_TIPO_DESPESA
                   LEFT JOIN SE_USUARIO U
                     ON R.COD_USUARIO_DESPESA = U.COD_USUARIO
                  WHERE r.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_DESPESA)= ".$mes."
                    AND YEAR(DTA_DESPESA)=".$ano;
        if ($param!=null){
            $sql .= $param;
        }
        $tpoDespesa = filter_input(INPUT_POST, 'tpoDespesaFiltro', FILTER_SANITIZE_STRING);
        if ($tpoDespesa!="-1" && $tpoDespesa!=""){
            $sql .= "   AND R.TPO_DESPESA = ".$tpoDespesa;
        }
        $indStatus = filter_input(INPUT_POST, 'statusFiltro', FILTER_SANITIZE_STRING);
        if ($indStatus!="-1" && $indStatus!=""){
            $sql .= "   AND R.IND_DESPESA_PAGA = '".$indStatus."'";
        } 
        $codConta = filter_input(INPUT_POST, 'contaFiltro', FILTER_SANITIZE_STRING);
        if ($codConta!="-1" && $codConta!=""){
            $sql .= "   AND R.COD_CONTA = ".$codConta;
        }         
        $codUsuario = filter_input(INPUT_POST, 'responsavelFiltro', FILTER_SANITIZE_STRING);
        if ($codUsuario!="-1" && $codUsuario!=""){
            $sql .= "   AND R.COD_USUARIO_DESPESA = ".$codUsuario;
        }         
        $sql .= " ORDER BY DTA_DESPESA";
        return $this->selectDB($sql, false);
    }

    Function PegaLimiteTipoDespesa($codClienteFinal){
        $sql = " SELECT TP.VLR_PISO,
                        TP.VLR_TETO,
                        SUM(COALESCE(R.VLR_DESPESA,0)) AS VLR_LIMITE
                   FROM EN_TIPO_DESPESA TP
                   LEFT JOIN EN_DESPESA R
                     ON TP.COD_TIPO_DESPESA = R.TPO_DESPESA
                    AND r.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_DESPESA)= ".$form->getNroMesReferencia()."
                    AND YEAR(DTA_DESPESA)=".$form->getNroAnoReferencia()."
                   LEFT JOIN EN_CONTA C
                     ON R.COD_CONTA = C.COD_CONTA
                  WHERE TP.COD_TIPO_DESPESA = ".$form->getCodTipoDespesa()."
                  GROUP BY TP.VLR_PISO,
                        TP.VLR_TETO";
        return $this->selectDB($sql, false);
    }
    
    Public Function ImportarDespesas($codDespesaRef, $dtaDespesa, $codClienteFinal){
        $codigo = $this->CatchUltimoCodigo('EN_DESPESA', 'COD_DESPESA');
        $sql = "INSERT INTO EN_DESPESA (COD_DESPESA, DSC_DESPESA, DTA_DESPESA, DTA_LANC_DESPESA, COD_CONTA, TPO_DESPESA,
                                        VLR_DESPESA, COD_CLIENTE_FINAL, IND_DESPESA_PAGA, DTA_PAGAMENTO,
                                        COD_DESPESA_IMPORTACAO, COD_USUARIO_DESPESA)
                SELECT $codigo,
                       DSC_DESPESA,
                       '$dtaDespesa',
                       NOW(),
                       COD_CONTA,
                       TPO_DESPESA,
                       VLR_DESPESA,
                       $codClienteFinal,
                       'N',
                       NULL,
                       $codDespesaRef,
                       COD_USUARIO_DESPESA
                  FROM EN_DESPESA
                 WHERE COD_DESPESA = $codDespesaRef";
        return $this->insertDB($sql);
    }
    
    Public Function VerificaDespesa($codDespesa){
        $sql = " SELECT COUNT(COD_DESPESA) AS QTD
                   FROM EN_DESPESA
                  WHERE COD_DESPESA_IMPORTACAO = $codDespesa";
        return $this->selectDB($sql, false);
    }
    
    Public Function PegaDespesaFilha($codDespesaImportacao){
        $sql = "SELECT COD_DESPESA
                  FROM EN_DESPESA
                 WHERE COD_DESPESA_IMPORTACAO = ".$codDespesaImportacao;
        return $this->selectDB($sql, false);
    }
    
    Public Function DeletarDespesaFilha($codDespesa){
        $sql = " DELETE FROM EN_DESPESA
                  WHERE COD_DESPESA = ".$codDespesa;
        return $this->insertDB($sql);
    }
    
    Public Function GetDespesaById($codDespesa){
        $sql = "SELECT COD_CONTA, DTA_DESPESA FROM EN_DESPESA WHERE COD_DESPESA = ".$codDespesa;
        return $this->selectDB($sql, false);
    }
    
    Public Function AtualizaPagamento($codConta, $dtaDespesa){
        $sql = "UPDATE EN_DESPESA SET
                IND_DESPESA_PAGA = 'S',
                DTA_PAGAMENTO ='".$dtaDespesa."' ";
                $sql .= " WHERE COD_CONTA = ".$codConta. " AND DTA_DESPESA = '".$dtaDespesa."'";
        return $this->insertDB($sql);        
    }
}
?>
