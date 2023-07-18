<?php
include_once("Controller/BaseController.php");
include_once("Model/Permissao/PermissaoModel.php");
class PermissaoController extends BaseController
{

  Public Function ChamaView() {
     $params = array();
     echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
  }

  Public Function ListarMenusPerfil(){
    $model = new PermissaoModel();
    echo $model->ListarMenusPerfil(true);
  }

  function AtualizaPermissoes(){
    $model = new PermissaoModel();
    echo $model->AtualizaPermissoes();
  }
}
$PermissaoController = new PermissaoController();
?>