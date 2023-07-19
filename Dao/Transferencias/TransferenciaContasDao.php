<?php
include_once("Dao/BaseDao.php");
class TransferenciaContasDao extends BaseDao
{
    function TransferenciaContasDao(){
    }

    Function AddTransferenciaContas($codClienteFinal){
        $vlrMovimentacao = str_replace(',', '.', filter_input(INPUT_POST, 'vlrMovimentacao', FILTER_SANITIZE_STRING));
        $sql = "INSERT INTO RE_TRANSFERENCIA_CONTAS (
                NRO_SEQUENCIAL,
                COD_CONTA_ORIGEM,
                COD_CONTA_DESTINO,
                DTA_MOVIMENTACAO,
                VLR_MOVIMENTACAO,
                COD_CLIENTE_FINAL)
                VALUES(
                ".$this->CatchUltimoCodigo('RE_TRANSFERENCIA_CONTAS', 'NRO_SEQUENCIAL').",
                ".filter_input(INPUT_POST, 'codContaOrigem', FILTER_SANITIZE_NUMBER_INT).",
                ".filter_input(INPUT_POST, 'codContaDestino', FILTER_SANITIZE_NUMBER_INT).",
                '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaMovimentacao', FILTER_SANITIZE_STRING))."',
                '".$vlrMovimentacao."',
                '".$codClienteFinal."')";
        return $this->insertDB($sql);
    }

    Function UpdateTransferenciaContas(){
        $vlrMovimentacao = str_replace(',', '.', filter_input(INPUT_POST, 'vlrMovimentacao', FILTER_SANITIZE_STRING));
        $sql = "
        UPDATE RE_TRANSFERENCIA_CONTAS
           SET COD_CONTA_ORIGEM = ".filter_input(INPUT_POST, 'codContaOrigem', FILTER_SANITIZE_NUMBER_INT).",
               COD_CONTA_DESTINO = ".filter_input(INPUT_POST, 'codContaDestino', FILTER_SANITIZE_NUMBER_INT).",
               DTA_MOVIMENTACAO = '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaMovimentacao', FILTER_SANITIZE_STRING))."',
               VLR_MOVIMENTACAO = '".$vlrMovimentacao."'
         WHERE NRO_SEQUENCIAL = ".filter_input(INPUT_POST, 'codTransferencia', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }
    Function DeletarTransferencia(){
        $sql = "
        DELETE FROM RE_TRANSFERENCIA_CONTAS
         WHERE NRO_SEQUENCIAL = ".filter_input(INPUT_POST, 'codTransferencia', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }
    Function ListarTransferencias($codClienteFinal){
        $sql = "SELECT
                    NRO_SEQUENCIAL,
                    COD_CONTA_ORIGEM,
                    CONCAT(CO.NME_BANCO,'(Ag: ',CO.NRO_AGENCIA,' Conta: ',CO.NRO_CONTA,')') AS DSC_CONTA_ORIGEM,
                    COD_CONTA_DESTINO,
                    CONCAT(CD.NME_BANCO,'(Ag: ',CD.NRO_AGENCIA,' Conta: ',CD.NRO_CONTA,')') AS DSC_CONTA_DESTINO,
                    DTA_MOVIMENTACAO,
                    VLR_MOVIMENTACAO
                  FROM RE_TRANSFERENCIA_CONTAS TC
                 INNER JOIN EN_CONTA CO
                    ON TC.COD_CONTA_ORIGEM = CO.COD_CONTA
                 INNER JOIN EN_CONTA CD
                    ON TC.COD_CONTA_DESTINO = CD.COD_CONTA
                 WHERE TC.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_MOVIMENTACAO)= ".filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_NUMBER_INT)."
                    AND YEAR(DTA_MOVIMENTACAO)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT);
        return $this->selectDB($sql, false);
    }
}
?>
