<?php
include_once("Model/BaseModel.php");
include_once("Dao/RelatorioReceitaDespesaMensal/RelatorioReceitaDespesaMensalDao.php");
class RelatorioReceitaDespesaMensalModel extends BaseModel
{
    
    Public Function CarregaRegistros($Json=true){
        $dao = new RelatorioReceitaDespesaMensalDao();
        $mes = filter_input(INPUT_POST, 'mesFiltro', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_STRING);
        $lista = $dao->CarregaRegistros($_SESSION['cod_cliente_final'], $mes, $ano);
        if ($Json) {
            return json_encode($lista);
        } else {
            return $lista;
        }
    }
    
    function ListarAnosFiltro() {
        return BaseModel::ListarAnosCombo();
    }

    function ListarMesesFiltro() {
        return BaseModel::ListarMesesCombo();
    }
}
?>
