<?php
include_once("Controller/BaseController.php");
include_once("Model/TipoDespesa/TipoDespesaModel.php");
class TipoDespesaController extends BaseController
{
    Public Function ChamaView() {
       $params = array();
       echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
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

    function ListarTiposDespesaFiltro(){
        $model = new TipoDespesaModel();
        echo $model->ListarTiposDespesaFiltro();
    }
    
    Function ListarSomaTipoDespesas(){
        $model = new TipoDespesaModel();
        echo $model->ListarSomaTipoDespesas();
    }
}
$TipoDespesaController = new TipoDespesaController();
?>