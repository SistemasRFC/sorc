<?php
include_once("Controller/BaseController.php");
include_once("Model/RelatorioMediaDiaria/RelatorioMediaDiariaModel.php");
class RelatorioMediaDiariaController extends BaseController
{

	Public Function ChamaView() {
		$params = array();
		echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
	}

	public function BuscarMediaDiaria() {
		$model = new RelatorioMediaDiariaModel();
		echo $model->BuscarMediaDiaria();
	}

    Function ListarAnosFiltro(){
        $model = new RelatorioMediaDiariaModel();
        echo $model->ListarAnosFiltro();
    }
}
$RelatorioMediaDiariaController = new RelatorioMediaDiariaController();
?>