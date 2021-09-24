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
}
?>
