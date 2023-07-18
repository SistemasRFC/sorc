<?php
include_once("Dao/BaseDao.php");
class ReceitasDao extends BaseDao
{
    function ReceitasDao(){
        $this->conect();
    }

    Function AddReceitas($codClienteFinal){
        $vlrReceita = str_replace(',', '.', filter_input(INPUT_POST, 'vlrReceita', FILTER_SANITIZE_STRING));
        $sql = "INSERT INTO EN_RECEITA (
                COD_RECEITA,
                DSC_RECEITA,
                DTA_RECEITA,
                COD_CONTA,
                VLR_RECEITA,
                COD_CLIENTE_FINAL)
                VALUES(
                ".$this->CatchUltimoCodigo('EN_RECEITA', 'COD_RECEITA').",
                '".filter_input(INPUT_POST, 'dscReceita', FILTER_SANITIZE_STRING)."',
                '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaReceita', FILTER_SANITIZE_STRING))."',
                '".filter_input(INPUT_POST, 'codConta', FILTER_SANITIZE_STRING)."',
                '".$vlrReceita."',
                '".$codClienteFinal."')";
        return $this->insertDB($sql);
    }

    Function UpdateReceitas(){
        $vlrReceita = str_replace(',', '.', filter_input(INPUT_POST, 'vlrReceita', FILTER_SANITIZE_STRING));
        $sql = " UPDATE EN_RECEITA
                    SET DSC_RECEITA = '".filter_input(INPUT_POST, 'dscReceita', FILTER_SANITIZE_STRING)."',
                        DTA_RECEITA = '".$this->ConverteDataForm(filter_input(INPUT_POST, 'dtaReceita', FILTER_SANITIZE_STRING))."',
                        COD_CONTA = '".filter_input(INPUT_POST, 'codConta', FILTER_SANITIZE_STRING)."',
                        VLR_RECEITA = '".$vlrReceita."'
                  WHERE COD_RECEITA = ".filter_input(INPUT_POST, 'codReceita', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }

    Function DeletarReceita(){
        $sql = " DELETE FROM EN_RECEITA
                  WHERE COD_RECEITA = ".filter_input(INPUT_POST, 'codReceita', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }

    Function ListarReceitas($codClienteFinal,
                            $param = null){
        $sql = " SELECT COD_RECEITA,
                        DTA_RECEITA,
                        VLR_RECEITA,
                        DSC_RECEITA,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS CONTA,
                        R.COD_CONTA
                   FROM EN_RECEITA R
                  INNER JOIN EN_CONTA C
                     ON R.COD_CONTA = C.COD_CONTA
                  WHERE R.COD_CLIENTE_FINAL = $codClienteFinal
                    AND MONTH(DTA_RECEITA)= ".filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_NUMBER_INT)."
                    AND YEAR(DTA_RECEITA)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT);
        if ($param!=null){
            $sql .= $param;
        }
        return $this->selectDB($sql, false);
    }
    
    Public Function ImportarReceita($codCliente, $dtaReceita, $codReceita){
        $sql = "INSERT INTO EN_RECEITA (COD_RECEITA, DSC_RECEITA, DTA_RECEITA, COD_CONTA, VLR_RECEITA, COD_CLIENTE_FINAL)
                SELECT ".$this->CatchUltimoCodigo('EN_RECEITA', 'COD_RECEITA').", 
                       DSC_RECEITA,
                       '".$this->ConverteDataForm($dtaReceita)."',
                       COD_CONTA,
                       VLR_RECEITA,
                       $codCliente
                  FROM EN_RECEITA
                 WHERE COD_RECEITA = $codReceita";
        return $this->insertDB($sql);
    }
    
    Public Function VerificaReceita($codReceita){
        $sql = " SELECT COUNT(COD_RECEITA) AS QTD
                   FROM EN_RECEITA
                  WHERE COD_RECEITA_IMPORTACAO = $codReceita";
        return $this->selectDB($sql, false);
    }
}
?>
