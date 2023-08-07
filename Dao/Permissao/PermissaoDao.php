<?php
include_once("Dao/BaseDao.php");
class PermissaoDao extends BaseDao
{
    protected $tableName = "SE_MENU_NOVO_PERFIL";

    protected $columns = array(
      "codMenu" => array("column" => "COD_MENU", "typeColumn" => "I")
    );

    protected $columnKey = array("codPerfilW" => array("column" => "COD_PERFIL_W", "typeColumn" => "I"));

    function ListarMenusPerfil(stdClass $obj) {        
        try{
            $select = " SELECT M.DSC_MENU,
                               M.COD_MENU,
                               M2.DSC_MENU AS DSC_MENU_PAI,
                               (SELECT DSC_PERFIL_W
                                  FROM SE_PERFIL P
                            INNER JOIN SE_MENU_NOVO_PERFIL MP
                                    ON P.COD_PERFIL_W = MP.COD_PERFIL_W
                                 WHERE MP.COD_MENU = M.COD_MENU
                                   AND P.COD_PERFIL_W = ".$obj->codPerfilW.") AS PERFIL
                          FROM SE_MENU_NOVO M
                     LEFT JOIN SE_MENU_NOVO M2
                            ON M.COD_MENU_PAI = M2.COD_MENU
                         WHERE M.IND_ATIVO = 'S'
                      ORDER BY DSC_MENU_PAI, M.DSC_MENU";
            $lista = $this->selectDB("$select", false);
        } catch(Exception $e) {
            echo "erro".$e;
        }
        return $lista;
    }

    Function AtualizaPermissoes(){        
        try{
            $sql_lista = "
            SELECT M.DSC_MENU, M.COD_MENU,
                   (SELECT DSC_PERFIL_W
                      FROM SE_PERFIL P
                     INNER JOIN SE_MENU_NOVO_PERFIL MP
                        ON P.COD_PERFIL_W = MP.COD_PERFIL_W
                     WHERE MP.COD_MENU = M.COD_MENU
                       AND P.COD_PERFIL_W = ".filter_input(INPUT_POST, 'codPerfilW', FILTER_SANITIZE_NUMBER_INT).") AS PERFIL
              FROM SE_MENU_NOVO M
             WHERE IND_ATIVO = 'S'";
            $lista = $this->selectDB("$sql_lista", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;

    }

    function RemovePermissoes($codPerfil){        
        $delete = "DELETE
                     FROM SE_MENU_NOVO_PERFIL
                    WHERE COD_PERFIL_W = ".$codPerfil;
        $result = $this->insertDB($delete);
        return $result;
    }

    function AddPermissao($codPerfil, $codMenu){        
        $insert_login = "INSERT INTO SE_MENU_NOVO_PERFIL
                          VALUES ('".$codPerfil."','".$codMenu."')";
        return $this->insertDB("$insert_login");
    }
}
?>
