<?php
include_once("Controller/BaseController.php");
include_once("Model/Perfil/PerfilModel.php");
class PerfilController extends BaseController
{

  Public Function ChamaView() {
     $params = array();
     echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
  }

  function ListarPerfil(){
    $model = new PerfilModel();
    echo $model->ListarPerfil();
  }

  function ListarPerfilRestrito(){
    $model = new PerfilModel();
    echo $model->ListarPerfilRestrito();
  }

  function ListarPerfilAtivo(){
    $model = new PerfilModel();
    echo $model->ListarPerfilAtivo();
  }

  function AddPerfil(){
    $PerfilModel = new PerfilModel();
    echo $PerfilModel->AddPerfil();
    
  }
  function UpdatePerfil(){
    $PerfilModel = new PerfilModel();
    echo $PerfilModel->UpdatePerfil();

  }

}
$PerfilController = new PerfilController();
?>