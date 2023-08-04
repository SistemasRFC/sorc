<?php
include_once("Controller/BaseController.php");
include_once("Model/RelatorioReceitaDespesaMensal/RelatorioReceitaDespesaMensalModel.php");
class RelatorioReceitaDespesaMensalController extends BaseController
{

	Public Function ChamaView() {
		$params = array();
		echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
	}
    
    Public Function CarregaRegistros(){
        $model = new RelatorioReceitaDespesaMensalModel();
        echo $model->CarregaRegistros();
    }

	Function ListarAnosFiltro(){
		$model = new RelatorioReceitaDespesaMensalModel();
		echo $model->ListarAnosFiltro();
	}
	
    function ListarMesesFiltro() {
        $model = new RelatorioReceitaDespesaMensalModel();
        echo $model->ListarMesesFiltro();
    }
}
$RelatorioReceitaDespesaMensalController = new RelatorioReceitaDespesaMensalController();
?>