<?php
include_once("Controller/BaseController.php");
include_once("Model/Perfil/PerfilModel.php");
include_once("Model/Usuario/UsuarioModel.php");
class UsuarioController extends BaseController
{

  Public Function ChamaView() {
     $params = array();
     echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
  }

  function ListarUsuario() {
    $model = new UsuarioModel();
    echo $model->ListarUsuario();
  }

  function AddUsuario() {
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->AddUsuario();
  }
  function UpdateUsuario() {
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->UpdateUsuario();
  }

  function DeleteUsuario() {
    $UsuarioModel = new UsuarioModel();
    echo $UsuarioModel->UpdateUsuario();
  }

  Public Function ReiniciarSenha() {
      $UsuarioModel = new UsuarioModel();
      echo $UsuarioModel->ReiniciarSenha();
  }

    Public Function ResetaSenha() {
        $UsuarioModel = new UsuarioModel();
        echo $UsuarioModel->ResetaSenha();
    }  
}
$UsuarioController = new UsuarioController();
?>