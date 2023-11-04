<?php
include_once("Dao/BaseDao.php");
class MenuDao extends BaseDao
{
    protected $tableName = "SE_MENU_NOVO";

    protected $columns = array(
      "dscMenu"        => array("column" => "DSC_MENU",         "typeColumn" => "S"),
      "nmeController"  => array("column" => "NME_CONTROLLER",   "typeColumn" => "S"),
      "indAtivo"       => array("column" => "IND_ATIVO",        "typeColumn" => "S"),
      "codMenuPai"     => array("column" => "COD_MENU_PAI",     "typeColumn" => "I"),
      "nmeMethod"      => array("column" => "NME_METHOD",       "typeColumn" => "S"),
      "dscIconeAtalho" => array("column" => "DSC_ICONE_ATALHO", "typeColumn" => "S"),
      "indAtalho"      => array("column" => "IND_ATALHO",       "typeColumn" => "S")
    );

    protected $columnKey = array("codMenu" => array("column" => "COD_MENU", "typeColumn" => "I"));

    /**
     * Retorna uma lista de menus
     * @return array
     */
    function ListaMenus(){        
        $sql_lista = " SELECT COD_MENU AS ID,
                              DSC_MENU AS DSC
                         FROM SE_MENU_NOVO
                        WHERE IND_ATIVO = 'S'
                     ORDER BY DSC_MENU";
        return $this->selectDB("$sql_lista", false);
    }

    function ListarMenusAutoComplete($parametro){
        try{
            $sql_lista = " SELECT COD_MENU,
                                  DSC_MENU,
                                  NME_CONTROLLER,
                                  NME_METHOD,
                                  IND_ATIVO,
                                  COD_MENU_PAI,
                                  COALESCE(IND_ATALHO,'N') AS IND_ATALHO,
                                  COALESCE(DSC_ICONE_ATALHO, '') AS DSC_ICONE_ATALHO,
                                  (SELECT COUNT(*)
                                     FROM SE_MENU_NOVO
                                    WHERE COD_MENU>0
                                      AND COD_MENU_PAI = M.COD_MENU) AS QTD
                             FROM SE_MENU_NOVO M
                            WHERE COD_MENU_PAI >=0
                              AND DSC_MENU LIKE '$parametro%'";
            $lista = $this->selectDB("$sql_lista", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;
    }

    Public Function ListarMenusGrid(){
        try{
            $sql_lista = " SELECT M.COD_MENU,
                                  M.DSC_MENU,
                                  M.NME_CONTROLLER,
                                  M.NME_METHOD,
                                  M.IND_ATIVO,
                                  M.COD_MENU_PAI,
                                  COALESCE(M.IND_ATALHO,'N') AS IND_ATALHO,
                                  COALESCE(M.DSC_ICONE_ATALHO, '') AS DSC_ICONE_ATALHO,
                                  (SELECT COUNT(*)
                                     FROM SE_MENU_NOVO MA
                                    WHERE MA.COD_MENU > 0
                                      AND MA.COD_MENU_PAI = M.COD_MENU) AS QTD,
                                  M2.DSC_MENU AS DSC_MENU_PAI
                             FROM SE_MENU_NOVO M
                        LEFT JOIN SE_MENU_NOVO M2
                               ON M.COD_MENU_PAI = M2.COD_MENU";
            $lista = $this->selectDB("$sql_lista", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;
    }

    function AddMenu(stdClass $obj) {
        return $this->MontarInsert($obj);
    }

    function UpdateMenu(stdClass $obj) {
        return $this->MontarUpdate($obj);
    }

    function DeleteMenu(){       
        $sql_lista = "
        DELETE FROM SE_MENU_NOVO
         WHERE COD_MENU = ".filter_input(INPUT_POST,'codMenu',FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$sql_lista", false);
        return $result;

    }

}
?>
