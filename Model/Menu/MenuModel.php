<?php
include_once("Model/BaseModel.php");
include_once("Dao/Menu/MenuDao.php");
include_once("Resources/php/FuncoesArray.php");
class MenuModel extends BaseModel
{
    function ListaMenus(){
        $dao = new MenuDao();
        $result = $dao->ListaMenus();
        return json_encode($result);
    }

    function AddMenu(){
        $dao = new MenuDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        if (isset($this->objRequest->codMenuPai)==1) {
            unset($this->objRequest->codMenuPai);
        }
        $result = $dao->AddMenu($this->objRequest);
        return json_encode($result);
    }

    function UpdateMenu(){
        $dao = new MenuDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        if (isset($this->objRequest->codMenuPai)==1) {
            unset($this->objRequest->codMenuPai);
        }
        $result = $dao->UpdateMenu($this->objRequest);
        return json_encode($result);
    }

    function DeleteMenu(){
        $dao = new MenuDao();
        return json_encode($dao->DeleteMenu());
    }

    function ListarMenusAutoComplete($parametro){
        $dao = new MenuDao();
        $lista = $dao->ListarMenusAutoComplete($parametro);
        $total = count($lista);
        $i=0;
        $data = array();
        while($i<$total ) {
            $data[] = array(
                'value' => $lista[$i]['DSC_MENU'],
                'label' => $lista[$i]['DSC_MENU'],
                'id' => $lista[$i]['COD_MENU'],
                'nmeController' => $lista[$i]['NME_CONTROLLER'],
                'nmeMethod' => $lista[$i]['NME_METHOD'],
                'indAtivo' => $lista[$i]['IND_ATIVO'],
                'codMenuPai' => $lista[$i]['COD_MENU_PAI'],
                'indAtalho' => $lista[$i]['IND_ATALHO'],
                'dscIconeAtalho' => $lista[$i]['DSC_ICONE_ATALHO']
            );
            $i++;
        }
        if (empty($data)){
            $data[] = array(
                'value' => '',
                'label' => 'Sem dados para a pesquisa',
                'id' => 0
            );
        }
        return json_encode($data);
    }

    function ListarMenusGrid(){
        $dao = new MenuDao();
        $lista = $dao->ListarMenusGrid();
        $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
        $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATALHO', 'ATALHO');
        return json_encode($lista);
    }
}
?>
