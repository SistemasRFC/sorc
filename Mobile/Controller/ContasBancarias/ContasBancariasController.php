<?php
include_once("Controller/BaseController.php");
include_once("Model/ContasBancarias/ContasBancariasModel.php");
class ContasBancariasController extends BaseController
{
    Public Function ListarContasBancariasAtivas(){
        $model = new ContasBancariasModel();
        echo $model->ListarContasBancariasAtivas();
    }
}
?>