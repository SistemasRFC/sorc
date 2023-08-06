<?php
include_once("Model/BaseModel.php");
include_once("Dao/RelatorioDespesasAnual/RelatorioDespesasAnualDao.php");
class RelatorioDespesasAnualModel extends BaseModel
{
    Public Function CarregaRegistros($Json=true){
        $dao = new RelatorioDespesasAnualDao();
        $ano = filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_STRING);
        $lista = $dao->CarregaRegistros($_SESSION['cod_cliente_final'], $ano);     
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }
    
    function ListarAnosFiltro() {
        return BaseModel::ListarAnosCombo();
    }
}
?>
