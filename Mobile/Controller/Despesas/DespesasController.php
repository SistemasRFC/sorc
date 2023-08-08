<?php
include_once("Controller/BaseController.php");
include_once("Model/Despesas/DespesasModel.php");

class DespesasController extends BaseController
{
    
    Function AddDespesa(){
        $model = new DespesaModel();
        echo $model->AddDespesa();
    }

    Public Function ListarDespesas() {
        $model = new DespesaModel();
        echo $model->ListarDespesasMob();
    }

    Public Function ListarMeses() {
        $model = new DespesaModel();
        echo $model->ListarMesesFiltro();
    }

    Public Function ListarAnos() {
        $model = new DespesaModel();
        echo $model->ListarAnosFiltro();
    }
}
?>