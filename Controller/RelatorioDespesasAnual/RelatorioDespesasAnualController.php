<?php
include_once("Controller/BaseController.php");
include_once("Model/RelatorioDespesasAnual/RelatorioDespesasAnualModel.php");
class RelatorioDespesasAnualController extends BaseController
{
	Public Function ChamaView() {
		$params = array();
		echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
	}
    
    Public Function CarregaRegistros(){
        $model = new RelatorioDespesasAnualModel();
        echo $model->CarregaRegistros();
    }

	Function ListarAnosFiltro(){
		$model = new RelatorioDespesasAnualModel();
		echo $model->ListarAnosFiltro();
	}
}
$RelatorioDespesasAnualController = new RelatorioDespesasAnualController();
?>