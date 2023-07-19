<?php
include_once("Dao/BaseDao.php");
class ClienteFinalDao extends BaseDao {

    protected $tableName = "EN_CLIENTE_FINAL";

    protected $columns = array(
      "dscClienteFinal"   => array("column" => "DSC_CLIENTE_FINAL", "typeColumn" => "S"),
      "indAtivo"          => array("column" => "IND_ATIVO", "typeColumn"         => "S")
    );

    protected $columnKey = array("codClienteFinal" => array("column" => "COD_CLIENTE_FINAL", "typeColumn" => "I"));

    function ListarClienteFinal(){
        $select = "SELECT COD_CLIENTE_FINAL,
                          DSC_CLIENTE_FINAL,
                          IND_ATIVO
                     FROM EN_CLIENTE_FINAL
                    ORDER BY DSC_CLIENTE_FINAL";
       return $this->selectDB($select, false);       
    }

    Public Function ListarClienteFinalAtivo($codPerfil, $codClienteFinal){
        $select = "SELECT COD_CLIENTE_FINAL AS ID,
                          DSC_CLIENTE_FINAL AS DSC
                     FROM EN_CLIENTE_FINAL 
                    WHERE IND_ATIVO = 'S'";
        if ($codPerfil != 1) {
            $select .= " AND COD_CLIENTE_FINAL = ".$codClienteFinal;
        }
        $select .= " ORDER BY DSC_CLIENTE_FINAL ";
       return $this->selectDB($select, false);
    }

    function AddCliente(stdClass $obj) {
        return $this->MontarInsert($obj);
    }

    function UpdateCliente(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    function DeleteCliente(){
        $sql_lista = "
        UPDATE EN_CLIENTE_FINAL SET IND_ATIVO = 'N'
         WHERE COD_CLIENTE_FINAL = ".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB("$sql_lista");
    }

}
?>
