<?php
include_once("Dao/BaseDao.php");
class PerfilDao extends BaseDao
{
    protected $tableName = "SE_PERFIL";

    protected $columns = array(
      "dscPerfilW"  => array("column" => "DSC_PERFIL_W", "typeColumn"   => "S"),
      "indAtivo"    => array("column" => "IND_ATIVO", "typeColumn"      => "S")
    );

    protected $columnKey = array("codPerfilW" => array("column" => "COD_PERFIL_W", "typeColumn" => "I"));

    function ListarPerfilRestrito($codPerfil){
        $sql = "SELECT COD_PERFIL_W, DSC_PERFIL_W 
                  FROM SE_PERFIL 
                 WHERE COD_PERFIL_W  IN (SELECT COD_PERFIL_ACESSO
                                           FROM RE_PERMISSAO_PERFIL
                                          WHERE COD_PERFIL = $codPerfil)
                   AND IND_ATIVO='S'";
        return $this->selectDB("$sql", false);
    }

    function ListarPerfilAtivo($codPerfil){
        $sql = "SELECT COD_PERFIL_W AS ID,
                       DSC_PERFIL_W AS DSC
                  FROM SE_PERFIL 
                 WHERE IND_ATIVO='S'";
        if ($codPerfil != 1) {
            $sql .= "AND COD_PERFIL_W = ".$codPerfil;
        };
        return $this->selectDB($sql, false);
    }

    /**
     * Retorna uma Lista de perfis
     * Utilizado no PerfilModel
     * @return Array
     */
    function ListarPerfil(){
        $sql = "SELECT COD_PERFIL_W, 
                       DSC_PERFIL_W,
                       IND_ATIVO
                  FROM SE_PERFIL";
        return $this->selectDB("$sql", false);
    }

    Public Function AddPerfil(stdClass $obj) {
        return $this->MontarInsert($obj);
    }

    Public Function UpdatePerfil(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

}
?>
