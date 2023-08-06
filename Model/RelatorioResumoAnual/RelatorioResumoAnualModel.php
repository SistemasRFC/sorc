<?php
include_once("Model/BaseModel.php");
include_once("Dao/RelatorioResumoAnual/RelatorioResumoAnualDao.php");
class RelatorioResumoAnualModel extends BaseModel
{
    Public Function CarregaRegistros($Json=true){
        $dao = new RelatorioResumoAnualDao();
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
