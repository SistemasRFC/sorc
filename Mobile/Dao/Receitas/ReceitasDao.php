<?php
include_once("../Dao/BaseDao.php");
class ReceitasDao extends BaseDao
{
    protected $tableName = "EN_RECEITA";

    protected $columns = array(
        "dtaReceita"            => array("column" => "DTA_RECEITA",             "typeColumn" => "D"),
        "vlrReceita"            => array("column" => "VLR_RECEITA",             "typeColumn" => "F"),
        "codConta"              => array("column" => "COD_CONTA",               "typeColumn" => "I"),
        "dscReceita"            => array("column" => "DSC_RECEITA",             "typeColumn" => "S"),
        "codClienteFinal"       => array("column" => "COD_CLIENTE_FINAL",       "typeColumn" => "I"),
        "codReceitaImportacao"  => array("column" => "COD_RECEITA_IMPORTACAO",  "typeColumn" => "I")
    );

    protected $columnKey = array("codReceita" => array("column" => "COD_RECEITA", "typeColumn" => "I"));

    function AddReceitas(stdClass $obj){
        $obj->codReceita = $this->CatchUltimoCodigo('EN_RECEITA', 'COD_RECEITA');
        return $this->MontarInsert($obj);
    }

    function UpdateReceitas(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    Function DeletarReceita(){
        $sql = " DELETE FROM EN_RECEITA
                  WHERE COD_RECEITA = ".filter_input(INPUT_POST, 'codReceita', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }

    Function ListarReceitas($codClienteFinal){
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
                    AND MONTH(DTA_RECEITA)= ".filter_input(INPUT_POST, 'mesFiltro', FILTER_SANITIZE_NUMBER_INT)."
                    AND YEAR(DTA_RECEITA)=".filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_NUMBER_INT);
        return $this->selectDB($sql, false);
    }

    function GetReceitaById($codReceita) {
        $sql = "SELECT COD_CONTA, DTA_RECEITA FROM EN_RECEITA WHERE COD_RECEITA = ".$codReceita;
        return $this->selectDB($sql, false);
    }
    
    Public Function ImportarReceita($codCliente, $dtaReceita, $codReceitaRef){
        $codReceita = $this->CatchUltimoCodigo('EN_RECEITA', 'COD_RECEITA');
        $sql = "INSERT INTO EN_RECEITA (COD_RECEITA, DSC_RECEITA, DTA_RECEITA, COD_CONTA, VLR_RECEITA, COD_CLIENTE_FINAL, COD_RECEITA_IMPORTACAO)
                SELECT $codReceita, 
                       DSC_RECEITA,
                       '$dtaReceita',
                       COD_CONTA,
                       VLR_RECEITA,
                       $codCliente,
                       $codReceitaRef
                  FROM EN_RECEITA
                 WHERE COD_RECEITA = $codReceitaRef";
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
