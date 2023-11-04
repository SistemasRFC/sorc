<?php
include_once("Controller/BaseController.php");
include_once("Model/Receitas/ReceitasModel.php");
include_once("Model/ContasBancarias/ContasBancariasModel.php");
class ReceitasController extends BaseController {

     Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

//     Function ChamaView_old(){
//         $listaMeses = $this->ListarMeses();
//         $listaAnos = $this->ListarAnos();
//         $contasBancariasModel = new ContasBancariasModel();
//         $listaContasBancarias = $contasBancariasModel->ListarContasBancariasAtivas(false);
//         $params = array('ListaContasBancarias' => urlencode(serialize($listaContasBancarias)),
//                         'ListaMeses' => urlencode(serialize($listaMeses)),
//                         'ListaAnos' => urlencode(serialize($listaAnos)),
//                         'codTipoReceitas' => urlencode(serialize(0)),
//                         'nroMesReferencia' => urlencode(serialize(date("m"))),
//                         'nroAnoReferencia' => urlencode(serialize(date("Y"))));
//         $view = $this->getPath()."/View/Receitas/".str_replace("Controller", "View", get_class($this)).".php";
//         echo ($this->gen_redirect_and_form($view, $params));
//     }
    
    Function ImportarReceitas(){
        $model = new ReceitasModel();
        echo $model->ImportarReceitas();
    }

    Function AddReceita(){
        $model = new ReceitasModel();
        echo $model->AddReceitas();
    }

    Function UpdateReceita(){
        $model = new ReceitasModel();
        echo $model->UpdateReceitas();
    }

    Function DeletarReceita(){
        $model = new ReceitasModel();
        echo $model->DeletarReceita();
    }

    Function ListarReceitas(){
        $model = new ReceitasModel();
        echo $model->ListarReceitas();
        flush();
    }

    function ListarAnosFiltro() {
		$model = new ReceitasModel();
		echo $model->ListarAnosFiltro();
	}

	function ListarMesesFiltro() {
		$model = new ReceitasModel();
		echo $model->ListarMesesFiltro();
	}
}
$ReceitasController = new ReceitasController();
?>
