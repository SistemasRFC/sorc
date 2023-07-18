<?
include_once("Model/BaseModel.php");
include_once("Dao/Perfil/PerfilDao.php");
include_once("Resources/php/FuncoesArray.php");
class PerfilModel extends BaseModel
{

    function ListarPerfilRestrito(){
        $dao = new PerfilDao();
        return json_encode($dao->ListarPerfilRestrito($_SESSION['cod_perfil']));
    }

    function ListarPerfilAtivo(){
        $dao = new PerfilDao();
        return json_encode($dao->ListarPerfilAtivo($_SESSION['cod_perfil']));
    }

    /**
     * Retorna uma Lista de perfis
     * @return JSON
     */
    function ListarPerfil(){
        $dao = new PerfilDao();
        $listaPerfil = $dao->ListarPerfil();
        $lista = FuncoesArray::AtualizaBooleanInArray($listaPerfil, 'IND_ATIVO', 'ATIVO');
        return json_encode($lista);
    }

    Public Function AddPerfil(){
        $dao = new PerfilDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        return json_encode($dao->AddPerfil($this->objRequest));
    }

    Public Function UpdatePerfil(){
        $dao = new PerfilDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        return json_encode($dao->UpdatePerfil($this->objRequest));
    }
 
}
?>
