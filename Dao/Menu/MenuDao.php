<?php
include_once("Dao/BaseDao.php");
class MenuDao extends BaseDao
{
    protected $tableName = "SE_MENU";

    protected $columns = array(
      "dscMenuW"            => array("column" => "DSC_MENU_W", "typeColumn"         => "S"),
      "nmeController"       => array("column" => "NME_CONTROLLER", "typeColumn"     => "S"),
      "indMenuAtivoW"       => array("column" => "IND_MENU_ATIVO_W", "typeColumn"   => "S"),
      "codMenuPaiW"         => array("column" => "COD_MENU_PAI_W", "typeColumn"     => "I"),
      "nmeMethod"           => array("column" => "NME_METHOD", "typeColumn"         => "S"),
      "dscCaminhoImagem"    => array("column" => "DSC_CAMINHO_IMAGEM", "typeColumn" => "S"),
      "indAtalho"           => array("column" => "IND_ATALHO", "typeColumn"         => "S")
    );

    protected $columnKey = array("codMenuW" => array("column" => "COD_MENU_W", "typeColumn" => "I"));

    /**
     * Retorna uma lista de menus
     * @return array
     */
    function ListaMenus(){        
        $sql_lista = " SELECT COD_MENU_W AS ID,
                              DSC_MENU_W AS DSC
                         FROM SE_MENU
                        WHERE IND_MENU_ATIVO_W = 'S'
                        ORDER BY DSC_MENU_W";
        return $this->selectDB("$sql_lista", false);
    }

    function ListarMenusAutoComplete($parametro){
        try{
            $sql_lista = " SELECT COD_MENU_W,
                                  DSC_MENU_W,
                                  NME_CONTROLLER,
                                  NME_METHOD,
                                  IND_MENU_ATIVO_W,
                                  COD_MENU_PAI_W,
                                  COALESCE(IND_ATALHO,'N') AS IND_ATALHO,
                                  COALESCE(DSC_CAMINHO_IMAGEM, '') AS DSC_CAMINHO_IMAGEM,
                                  (SELECT COUNT(*)
                                     FROM SE_MENU
                                    WHERE COD_MENU_W>0
                                      AND COD_MENU_PAI_W = M.COD_MENU_W) AS QTD
                             FROM SE_MENU M
                            WHERE COD_MENU_PAI_W >=0
                              AND DSC_MENU_W LIKE '$parametro%'";
            $lista = $this->selectDB("$sql_lista", false);
        }catch(Exception $e){
            echo "erro".$e;
        }
        return $lista;
    }

    Public Function ListarMenusGrid(){
        try{
            $sql_lista = " SELECT M.COD_MENU_W,
                                  M.DSC_MENU_W,
                                  M.NME_CONTROLLER,
                                  M.NME_METHOD,
                                  M.IND_MENU_ATIVO_W,
                                  M.COD_MENU_PAI_W,
                                  COALESCE(M.IND_ATALHO,'N') AS IND_ATALHO,
                                  COALESCE(M.DSC_CAMINHO_IMAGEM, '') AS DSC_CAMINHO_IMAGEM,
                                  (SELECT COUNT(*)
                                     FROM SE_MENU MA
                                    WHERE MA.COD_MENU_W > 0
                                      AND MA.COD_MENU_PAI_W = M.COD_MENU_W) AS QTD,
                                  M2.DSC_MENU_W AS DSC_MENU_PAI
                             FROM SE_MENU M
                            INNER JOIN SE_MENU M2
                               ON M.COD_MENU_PAI_W = M2.COD_MENU_W";
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
        DELETE FROM SE_MENU
         WHERE COD_MENU_W = ".filter_input(INPUT_POST,'codMenuW',FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$sql_lista", false);
        return $result;

    }

}
?>
