<?php
include_once("../BaseController.php");
include_once("../../Model/TipoDespesa/TipoDespesaModel.php");
class TipoDespesaController extends BaseController
{
    function TipoDespesaController(){
        $method = $_REQUEST['method'];
        $string =$method.'()';
        $method = "\$this->".$string.";";
        eval($method);

    }
    
    Function ChamaView(){
        $view = $this->getPath()."/View/TipoDespesa/".str_replace("Controller", "View", get_class($this)).".php";
        header("Location: ".$view);            
    }
    
    Function AddTipoDespesa(){
        $model = new TipoDespesaModel();
        echo $model->AddTipoDespesa();
    }
    
    Function UpdateTipoDespesa(){
        $model = new TipoDespesaModel();
        echo $model->UpdateTipoDespesa();
    }  

    Function ListarTiposDespesas(){
        $model = new TipoDespesaModel();
        echo $model->ListarTiposDespesas();
    }
}
$TipoDespesaController = new TipoDespesaController();
?>