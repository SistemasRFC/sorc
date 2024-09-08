<?php
include_once("Controller/BaseController.php");
include_once("Model/RelatorioTipoDespesa/RelatorioTipoDespesaModel.php");
class RelatorioTipoDespesaController extends BaseController
{
	Public Function ChamaView() {
		$params = array();
		echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
	}

    Function ListarSomaTipoDespesasPorPeriodo() {
        $model = new RelatorioTipoDespesaModel();
        echo $model->ListarSomaTipoDespesasPorPeriodo();
    }
}
$RelatorioTipoDespesaController = new RelatorioTipoDespesaController();
?>