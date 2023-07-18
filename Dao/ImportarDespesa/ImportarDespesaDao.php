<?
include_once("Dao/BaseDao.php");
class DespesasDao extends BaseDao
{
    function DespesasDao(){
    }

    Function AddDespesa($codClienteFinal, $dtaDespesa, $codDespesaImportada=0){
        $vlrDespesa = str_replace('.', '', filter_input(INPUT_POST, 'vlrDespesa', FILTER_SANITIZE_STRING));
        $vlrDespesa = str_replace(',', '.', $vlrDespesa);
        $sql = "INSERT INTO EN_DESPESA (
                COD_DESPESA,
                DSC_DESPESA,
                DTA_DESPESA,
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
                ".$this->CatchUltimoCodigo('EN_DESPESA', 'COD_DESPESA').",
                '".$dtaDespesa."',
                '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING))."',
                '".filter_input(INPUT_POST, 'codConta', FILTER_SANITIZE_NUMBER_INT)."',
                '".filter_input(INPUT_POST, 'codTipoDespesa', FILTER_SANITIZE_NUMBER_INT)."',
                '".$vlrDespesa."',
                '".$codClienteFinal."',
                '".filter_input(INPUT_POST, 'indDespesaPaga', FILTER_SANITIZE_STRING)."',
                '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING))."',
                ".filter_input(INPUT_POST, 'qtdParcelas', FILTER_SANITIZE_NUMBER_INT).",
                ".filter_input(INPUT_POST, 'nroParcelaAtual', FILTER_SANITIZE_NUMBER_INT).",
                ".$codDespesaImportada.")";
        //echo $sql; exit;
        return $this->insertDB($sql);
    }

    Function UpdateDespesa($codClienteFinal){
        $vlrDespesa = str_replace('.', '', filter_input(INPUT_POST, 'vlrDespesa', FILTER_SANITIZE_STRING));
        $vlrDespesa = str_replace(',', '.', $vlrDespesa);
        $sql = "UPDATE EN_DESPESA SET
                DSC_DESPESA = '".filter_input(INPUT_POST, 'dscDespesa', FILTER_SANITIZE_STRING)."',
                DTA_DESPESA = '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING))."',
                COD_CONTA  =  ".filter_input(INPUT_POST, 'codConta', FILTER_SANITIZE_NUMBER_INT).",
                TPO_DESPESA = ".filter_input(INPUT_POST, 'codTipoDespesa', FILTER_SANITIZE_NUMBER_INT).",
                VLR_DESPESA = '".$vlrDespesa."',
                IND_DESPESA_PAGA = '".filter_input(INPUT_POST, 'indDespesaPaga', FILTER_SANITIZE_STRING)."',
                DTA_PAGAMENTO ='".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING))."',
                QTD_PARCELAS = ".filter_input(INPUT_POST, 'qtdParcelas', FILTER_SANITIZE_NUMBER_INT).",
                NRO_PARCELA_ATUAL = ".filter_input(INPUT_POST, 'nroParcelaAtual', FILTER_SANITIZE_NUMBER_INT)."
                WHERE COD_DESPESA = ".filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        //echo $sql; exit;
        return $this->insertDB($sql);
    }

    Function DeletarDespesa(){
        $sql = " DELETE FROM EN_DESPESA
                  WHERE COD_DESPESA = ".filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }
    
    Function ListarDespesas($codClienteFinal,
                            $param = null){
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
                  INNER JOIN EN_CONTA C
                     ON R.COD_CONTA = C.COD_CONTA
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON R.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE r.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_DESPESA)= ".$mes."
                    AND YEAR(DTA_DESPESA)=".$ano;
        if ($param!=null){
            $sql .= $param;
        }
        $tpoDespesa = filter_input(INPUT_POST, 'tpoDespesa', FILTER_SANITIZE_STRING);
        if ($tpoDespesa!="-1" && $tpoDespesa!=""){
            $sql .= "   AND R.TPO_DESPESA = ".$tpoDespesa;
        }
        $indStatus = filter_input(INPUT_POST, 'indStatus', FILTER_SANITIZE_STRING);
        if ($indStatus!="-1" && $indStatus!=""){
            $sql .= "   AND R.IND_DESPESA_PAGA = '".$indStatus."'";
        }        
        return $this->selectDB($sql, false);
    }


    Function ListarSomaTipoDespesas($codClienteFinal){
        $sql = " SELECT DSC_TIPO_DESPESA,
                        SUM(VLR_DESPESA) AS VALOR
                   FROM EN_DESPESA D
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE D.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(D.DTA_DESPESA)= MONTH(NOW())
                    AND YEAR(D.DTA_DESPESA)= YEAR(NOW())
                  GROUP BY DSC_TIPO_DESPESA
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }

    Function PegaLimiteTipoDespesa($codClienteFinal){
        $form = new DespesasForm();
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
}
?>
