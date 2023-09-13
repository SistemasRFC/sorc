<?php
include_once("Controller/BaseController.php");
// include_once("Model/TipoDespesa/TipoDespesaModel.php");
include_once("Model/Despesas/DespesasModel.php");
include_once("Model/ContasBancarias/ContasBancariasModel.php");
include_once("Model/ClienteFinal/ClienteFinalModel.php");

class DespesasController extends BaseController {

     Public Function ChamaView() {
        $params = array();
        echo ($this->gen_redirect_and_form(BaseController::ReturnView(BaseController::getPath(), get_class($this)), $params));
    }

    // Public Function ChamaRelatorioTipoDespesa(){
    //     $listaMeses = $this->ListarMeses();
    //     $listaAnos = $this->ListarAnos();
    //     $params = array('ListaMeses' => urlencode(serialize($listaMeses)),
    //                     'ListaAnos' => urlencode(serialize($listaAnos)),
    //                     'nroMesReferencia' => urlencode(serialize(date("m"))),
    //                     'nroAnoReferencia' => urlencode(serialize(date("Y"))));
    //     $view = $this->getPath()."/View/Despesas/RelatorioTipoDespesaView.php";
    //     echo ($this->gen_redirect_and_form($view, $params));  
    // }

    Function AddDespesa(){
        $model = new DespesaModel();
        echo $model->AddDespesa();
    }

    Function UpdateDespesa(){
        $model = new DespesaModel();
        echo $model->UpdateDespesa();
    }
    
    Function DeletarDespesa(){
        $model = new DespesaModel();
        echo $model->DeletarDespesa();
    }

    Function ListarDespesas(){
        $model = new DespesaModel();
        echo $model->ListarDespesas();
    }

    Function ImportarDespesas(){
        $model = new DespesaModel();
        echo $model->ImportarDespesas();
    }

    function ListarAnosFiltro() {
        $model = new DespesaModel();
        echo $model->ListarAnosFiltro();
    }

    function ListarMesesFiltro() {
        $model = new DespesaModel();
        echo $model->ListarMesesFiltro();
    }
    
    Public Function QuitarParcelas(){
        $model = new DespesaModel();
        echo $model->QuitarParcelas();
    }
    
    Public Function PagarPorConta(){
        $model = new DespesaModel();
        echo $model->PagarPorConta();
    }
    
    Public Function BaixarDespesas(){
        $model = new DespesaModel();
        echo $model->BaixarDespesas();
    }
    
}
$DespesasController = new DespesasController();
?>
