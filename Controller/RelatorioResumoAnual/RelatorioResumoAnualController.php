<?php
include_once("Controller/BaseController.php");
include_once("Model/RelatorioResumoAnual/RelatorioResumoAnualModel.php");
class RelatorioResumoAnualController extends BaseController
{
	Public Function ChamaView() {
		$params = array();
		echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
	}

    Public Function CarregaRegistros(){
        $model = new RelatorioResumoAnualModel();
        echo $model->CarregaRegistros();
    }

	Function ListarAnosFiltro(){
		$model = new RelatorioResumoAnualModel();
		echo $model->ListarAnosFiltro();
	}
}
$RelatorioResumoAnualController = new RelatorioResumoAnualController();
?>