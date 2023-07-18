<?php
include_once("Controller/BaseController.php");
include_once("Model/Login/LoginModel.php");
class LoginController extends BaseController
{

    public function ChamaAlterarSenhaView()
    {
        $params = array();
        echo ($this->gen_redirect_and_form('View/Login/AlterarSenhaView.php', $params));
    }

    function Logar(){
        $model = new LoginModel();        
        echo $model->Logar();
    }

    function AlteraSenha(){
      $model = new LoginModel();
      echo $model->AlteraSenha();
    }

    Public Function AtualizaCliente(){
      $model = new LoginModel();        
      $model->AtualizaCliente();
    }
}
$loginController = new LoginController();
?>