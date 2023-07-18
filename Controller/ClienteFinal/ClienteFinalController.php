<?php
include_once("Controller/BaseController.php");
include_once("Model/ClienteFinal/ClienteFinalModel.php");
class ClienteFinalController extends BaseController
{
    Public Function ChamaView() {
       $params = array();
       echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
   }
    
    Public Function ListarClienteFinal(){
        $ClienteFinalModel = new ClienteFinalModel();
        echo $ClienteFinalModel->ListarClienteFinal();
    }
    
    Public Function ListarClienteFinalAtivo(){
        $ClienteFinalModel = new ClienteFinalModel();
        echo $ClienteFinalModel->ListarClienteFinalAtivo();
    }
    
    Public Function UpdateCliente(){
        $ClienteFinalModel = new ClienteFinalModel();
        echo $ClienteFinalModel->UpdateCliente();
    }
    
    Public Function AddCliente(){
        $ClienteFinalModel = new ClienteFinalModel();
        echo $ClienteFinalModel->AddCliente();   
    }
    
    Public Function DeleteCliente(){
        $ClienteFinalModel = new ClienteFinalModel();
        echo $ClienteFinalModel->DeleteCliente();   
    }
}
$ClienteFinalController = new ClienteFinalController();
?>