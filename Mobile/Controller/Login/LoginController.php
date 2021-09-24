<?php
include_once("Controller/BaseController.php");
include_once("Model/Login/LoginModel.php");
class LoginController extends BaseController
{
    Public Function Logar(){
        $model = new LoginModel();        
        $logar = $model->Logar();
        echo $logar;
    }
}
?>