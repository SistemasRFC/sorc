<?
include_once("../../Dao/BaseDao.php");
include_once("../../Form/TransferenciaContas/TransferenciaContasForm.php");
class TransferenciaContasDao extends BaseDao
{
    function TransferenciaContasDao(){
    }

    Function AddTransferenciaContas($codClienteFinal){
        $form = new TransferenciaContasForm();
        $sql = "INSERT INTO RE_TRANSFERENCIA_CONTAS (
                NRO_SEQUENCIAL,
                COD_CONTA_ORIGEM,
                COD_CONTA_DESTINO,
                DTA_MOVIMENTACAO,
                VLR_MOVIMENTACAO,
                COD_CLIENTE_FINAL)
                VALUES(
                ".$this->CatchUltimoCodigo('RE_TRANSFERENCIA_CONTAS', 'NRO_SEQUENCIAL').",
                '".$form->getCodContaOrigem()."',
                '".$form->getCodContaDestino()."',
                '".$this->ConverteDataForm($form->getDtaMovimentacao())."',
                '".$form->getVlrMovimentacao()."',
                '".$codClienteFinal."')";
        return $this->insertDB($sql);
    }

    Function UpdateTransferenciaContas(){
        $form = new TransferenciaContasForm();
        $sql = "
        UPDATE RE_TRANSFERENCIA_CONTAS
           SET COD_CONTA_ORIGEM = ".$form->getCodContaOrigem().",
               COD_CONTA_DESTINO = ".$form->getCodContaDestino().",
               DTA_MOVIMENTACAO = '".$this->ConverteDataForm($form->getDtaMovimentacao())."',
               VLR_MOVIMENTACAO = '".$form->getVlrMovimentacao()."'
         WHERE NRO_SEQUENCIAL = ".$form->getCodTransferencia();
        return $this->insertDB($sql);
    }
    Function DeletarTransferencia(){
        $form = new TransferenciaContasForm();
        $sql = "
        DELETE FROM RE_TRANSFERENCIA_CONTAS
         WHERE NRO_SEQUENCIAL = ".$form->getCodTransferencia();
        return $this->insertDB($sql);
    }
    Function ListarTransferencias($codClienteFinal){
        $form = new TransferenciaContasForm();
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
                    AND MONTH(DTA_MOVIMENTACAO)= ".$form->getNroMesReferencia()."
                    AND YEAR(DTA_MOVIMENTACAO)=".$form->getNroAnoReferencia();
        $sql .= " ORDER BY ".$form->getOrdenacao()." ".$form->getOrientaOrdenacao();
        return $this->selectDB($sql, false);
    }
}
?>
