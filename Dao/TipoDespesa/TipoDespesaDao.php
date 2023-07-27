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
}
?>
