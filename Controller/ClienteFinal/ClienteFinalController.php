<?
include_once("../BaseController.php");
include_once("../../Model/ClienteFinal/ClienteFinalModel.php");
class ClienteFinalController extends BaseController
{
    function ClienteFinalController(){        
        $method = $_REQUEST['method'];
        $string =$method.'()';
        $method = "\$this->".$string.";";
        //echo $method;
        eval($method);

    }
    
    Public Function ChamaView(){
        $params = array();
        $view = $this->getPath()."/View/ClienteFinal/".str_replace("Controller", "View", get_class($this)).".php";
        echo ($this->gen_redirect_and_form($view, $params));
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