<?php
include_once("Model/BaseModel.php");
include_once("Dao/RelatorioTipoDespesa/RelatorioTipoDespesaDao.php");
include_once("Resources/php/FuncoesArray.php");
include_once("Resources/php/FuncoesMoeda.php");
class RelatorioTipoDespesaModel extends BaseModel
{

    function ListarSomaTipoDespesasPorPeriodo()
    {
        $dao = new RelatorioTipoDespesaDao();
        $dtaInicio = filter_input(INPUT_POST, 'dtaInicio', FILTER_SANITIZE_STRING);
        $dtaFim = filter_input(INPUT_POST, 'dtaFim', FILTER_SANITIZE_STRING);
        $result = $dao->ListarSomaTipoDespesasPorPeriodo($_SESSION['cod_cliente_final'], $dtaInicio, $dtaFim);
        if ($result[1] != null) {
            $qtd = count($result[1]);
            $result[2] = [];
            for ($i = 0; $i < $qtd; $i++) {
                array_push($result[2], $result[1][$i]['DSC_TIPO_DESPESA']);
            }
        }

        return json_encode($result);
    }
}
