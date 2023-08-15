<?php
include_once("Controller/BaseController.php");
include_once("Model/TipoDespesa/TipoDespesaModel.php");
class TipoDespesaController extends BaseController
{
    Function ListarTiposDespesasAtivos(){
        $model = new TipoDespesaModel();
        echo $model->ListarTiposDespesasAtivos();
    }

    function VerificarTeto() {
        $model = new TipoDespesaModel();
        echo $model->VerificarTeto();
    }

    function SumarizaPorTipoDespesa() {
        $model = new TipoDespesaModel();
        echo $model->SumarizaPorTipoDespesa();
    }
}
?>