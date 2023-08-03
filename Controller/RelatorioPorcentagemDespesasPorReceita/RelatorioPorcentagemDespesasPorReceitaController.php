<?php
include_once("Controller/BaseController.php");
include_once("Model/RelatorioPorcentagemDespesasPorReceita/RelatorioPorcentagemDespesasPorReceitaModel.php");
class RelatorioPorcentagemDespesasPorReceitaController extends BaseController
{

	Public Function ChamaView() {
		$params = array();
		echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
	}
    
    Public Function CarregaRegistros(){
        $model = new RelatorioPorcentagemDespesasPorReceitaModel();
        echo $model->CarregaRegistros();
    }

	Function ListarAnosFiltro(){
		$model = new RelatorioPorcentagemDespesasPorReceitaModel();
		echo $model->ListarAnosFiltro();
	}
	
    function ListarMesesFiltro() {
        $model = new RelatorioPorcentagemDespesasPorReceitaModel();
        echo $model->ListarMesesFiltro();
    }
}
$RelatorioPorcentagemDespesasPorReceitaController = new RelatorioPorcentagemDespesasPorReceitaController();
?>