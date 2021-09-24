<?php
include_once("Controller/BaseController.php");
include_once("Model/Despesas/DespesasModel.php");

class DespesasController extends BaseController
{
    
    Function AddDespesa(){
        $model = new DespesaModel();
        echo $model->AddDespesa();
    }
}
?>