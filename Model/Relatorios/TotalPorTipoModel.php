<?php
include_once("Model/BaseModel.php");
include_once("Dao/Relatorios/TotalPorTipoDao.php");
class TotalPorTipoModel extends BaseModel
{
    function TotalPorTipoModel(){
        ob_start();
        session_start();
    }
    
    Public Function ListarDespesasPorTipo(){
        $TotalPorTipoDao = new TotalPorTipoDao();
        $return = $TotalPorTipoDao->ListarDespesasPorTipo($_SESSION['cod_cliente_final']);
        //$return = BaseModel::FormataMoedaInArray($return, 'VLR_DESPESA');
        return json_encode($return);
    }
}
?>
