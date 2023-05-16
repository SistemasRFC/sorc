<?php
include_once("Controller/BaseController.php");
include_once("Model/Despesas/DespesasModel.php");

class DespesasController extends BaseController
{
    
    Function AddDespesa(){
        $model = new DespesaModel();
        echo $model->AddDespesa();
    }

    Public Function ListarMeses() {
        $meses = array( ['ID'=>0, 'DSC'=>'Selecione...'],
                        ['ID'=>1, 'DSC'=>'1-Janeiro'],
                        ['ID'=>2, 'DSC'=>'2-Fevereiro'],
                        ['ID'=>3, 'DSC'=>'3-Março'],
                        ['ID'=>4, 'DSC'=>'4-Abril'],
                        ['ID'=>5, 'DSC'=>'5-Maio'],
                        ['ID'=>6, 'DSC'=>'6-Junho'],
                        ['ID'=>7, 'DSC'=>'7-Julho'],
                        ['ID'=>8, 'DSC'=>'8-Agosto'],
                        ['ID'=>9, 'DSC'=>'9-Setembro'],
                        ['ID'=>10, 'DSC'=>'10-Outubro'],
                        ['ID'=>11, 'DSC'=>'11-Novembro'],
                        ['ID'=>12, 'DSC'=>'12-Dezembro']);
        echo json_encode(array(true, $meses));
    }

    Public Function ListarAnos() {
        $anos = array( ['ID'=>0, 'DSC'=>'Selecione...'],
                       ['ID'=>date('Y')-1, 'DSC'=>date('Y')-1],
                       ['ID'=>date('Y'), 'DSC'=>date('Y')],
                       ['ID'=>date('Y')+1, 'DSC'=>date('Y')+1]);
        echo json_encode(array(true, $anos));
    }

    Public Function ListarDespesas() {
        $model = new DespesaModel();
        echo $model->ListarDespesasMob();
    }
}
?>