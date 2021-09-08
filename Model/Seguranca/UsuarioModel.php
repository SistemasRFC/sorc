<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Seguranca/UsuarioDao.php");
class UsuarioModel extends BaseModel
{
    function UsuarioModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }

    function ListarUsuario(){
        $dao = new UsuarioDao();        
        $lista = $dao->ListarUsuario($_SESSION['cod_usuario'], $_SESSION['cod_perfil']);    
        if ($lista[0]){
            if ($lista[1]!=null){
                $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO', 'ATIVO');
            }
        }
        return json_encode($lista);
    }
    
    function AddUsuario(){
        $dao = new UsuarioDao();
        return json_encode($dao->AddUsuario($_SESSION['cod_usuario'], $_SESSION['cod_perfil']));
    }

    function UpdateUsuario(){
        $dao = new UsuarioDao();
        return json_encode($dao->UpdateUsuario($_SESSION['cod_perfil']));
    }

    function DeleteUsuario(){
        $dao = new UsuarioDao();
        return $dao->DeleteUsuario();
    }
    
    function AddLogin(){
        $dao = new UsuarioDao();        
        $result = $dao->AddLogin();
        return $result;
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
