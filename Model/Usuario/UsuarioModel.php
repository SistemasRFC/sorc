<?php
include_once("Model/BaseModel.php");
include_once("Dao/Usuario/UsuarioDao.php");
include_once("Resources/php/FuncoesArray.php");
class UsuarioModel extends BaseModel
{

    function ListarUsuario(){
        $dao = new UsuarioDao();        
        $lista = $dao->ListarUsuario($_SESSION['cod_usuario'], $_SESSION['cod_perfil'], $_SESSION['cod_cliente_final']);    
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            }
        }
        return json_encode($lista);
    }

    function ListarResponsavelFiltro(){
        $dao = new UsuarioDao();        
        $lista = $dao->ListarResponsavelFiltro($_SESSION['cod_cliente_final']);
        return json_encode($lista);
    }

    function AddUsuario(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->txtSenhaW = base64_encode("123459");
        return json_encode($dao->AddUsuario($this->objRequest));
    }

    function UpdateUsuario(){
        $dao = new UsuarioDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        return json_encode($dao->UpdateUsuario($this->objRequest));
    }

    function DeleteUsuario(){
        $dao = new UsuarioDao();
        return $dao->DeleteUsuario();
    }

    Public Function ReiniciarSenha(){
        $dao = new UsuarioDao();
        return json_encode($dao->ReiniciarSenha());
    }

    Public Function ResetaSenha(){
        $dao = new UsuarioDao();
        return json_encode($dao->ResetaSenha());
    }  
}
?>
