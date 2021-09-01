<?
include_once("../BaseController.php");
class ClienteFinalController extends BaseController
{
    function ClienteFinalController(){
        $this->verificaSessao();
        $method = $_REQUEST['method'];
        $string =$method.'()';
        $method = "\$this->".$string.";";
        //echo $method;
        eval($method);

    }
    
    Function ChamaView(){
        
    }
}
$ClienteFinalController = new ClienteFinalController();
?>