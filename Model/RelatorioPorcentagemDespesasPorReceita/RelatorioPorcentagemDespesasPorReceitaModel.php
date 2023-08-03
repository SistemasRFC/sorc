<?php
include_once("Model/BaseModel.php");
include_once("Dao/RelatorioPorcentagemDespesasPorReceita/RelatorioPorcentagemDespesasPorReceitaDao.php");
class RelatorioPorcentagemDespesasPorReceitaModel extends BaseModel
{
    
    Public Function CarregaRegistros($Json=true){
        $dao = new RelatorioPorcentagemDespesasPorReceitaDao();
        $mes = filter_input(INPUT_POST, 'mesFiltro', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_STRING);

        $lista = $dao->CarregaRegistros($_SESSION['cod_cliente_final'], $mes, $ano);
        $arrTipos = [];
        if($lista[0] && $lista[1] > 0) {
            $count = count($lista[1]);
            for($i=0;$i<$count;$i++) {
                array_push($arrTipos, $lista[1][$i]['DSC_TIPO_DESPESA']);
                $lista[1][$i]['VLR_DESPESA'] = number_format($lista[1][$i]['VLR_DESPESA'], 2, '.', '');
                $lista[1][$i]['VLR_RECEITA'] = number_format($lista[1][$i]['VLR_RECEITA'], 2, '.', '');
            }
        }
        $lista[2] = $arrTipos;

        return json_encode($lista);
    }
    
    function ListarAnosFiltro() {
        return BaseModel::ListarAnosCombo();
    }

    function ListarMesesFiltro() {
        return BaseModel::ListarMesesCombo();
    }
}
?>
