<?php
include_once("Dao/BaseDao.php");
class DespesasDao extends BaseDao
{

    Function AddDespesa($codClienteFinal, $dtaDespesa, $indDespesaPaga, $dtaPagamento, $dtaLancamento, $nroParcelaAtual, $codDespesaImportada=0){
        $vlrDespesa = str_replace(',', '.', filter_input(INPUT_POST, 'vlrDespesa', FILTER_SANITIZE_STRING));
        $codDespesa = $this->CatchUltimoCodigo('EN_DESPESA', 'COD_DESPESA');
        $sql = "INSERT INTO EN_DESPESA (
                COD_DESPESA,
                DSC_DESPESA,
                DTA_DESPESA,
                DTA_LANC_DESPESA,
                COD_CONTA,
                TPO_DESPESA,
                VLR_DESPESA,
                COD_CLIENTE_FINAL,
                IND_DESPESA_PAGA,
                DTA_PAGAMENTO,
                QTD_PARCELAS,
                NRO_PARCELA_ATUAL,
                COD_DESPESA_IMPORTACAO)
                VALUES(
                ".$codDespesa.",
                '".filter_input(INPUT_POST, 'dscDespesa', FILTER_SANITIZE_STRING)."',
                '".$this->ConverteDataForm($dtaDespesa)."',
                '".$this->ConverteDataForm($dtaLancamento)."',
                '".filter_input(INPUT_POST, 'codConta', FILTER_SANITIZE_NUMBER_INT)."',
                '".filter_input(INPUT_POST, 'codTipoDespesa', FILTER_SANITIZE_NUMBER_INT)."',
                '".$vlrDespesa."',
                '".$codClienteFinal."',
                '".$indDespesaPaga."',";
                if ($dtaPagamento==''){
                    $sql .= "NULL, ";
                }else{
                    $sql .= "'".$this->ConverteDataForm($dtaPagamento)."', ";
                }
                $sql .= filter_input(INPUT_POST, 'qtdParcelas', FILTER_SANITIZE_NUMBER_INT). ",
                ".$nroParcelaAtual.",
                ".$codDespesaImportada.")";
        $result = $this->insertDB($sql);
        $result[2] = $codDespesa;
        return $result;
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
                        CASE WHEN COD_DESPESA_IMPORTACAO>0 THEN 'Despesa Importada' ELSE 'Mês atual' END AS IND_ORIGEM_DESPESA
                   FROM EN_DESPESA R
                  LEFT JOIN EN_CONTA C
                     ON R.COD_CONTA = C.COD_CONTA
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON R.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE r.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_DESPESA)= ".$mes."
                    AND YEAR(DTA_DESPESA)=".$ano."
                  ORDER BY DTA_DESPESA";
        return $this->selectDB($sql, false);
    }
}
?>
