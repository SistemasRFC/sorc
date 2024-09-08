<?php
include_once("../Model/BaseModel.php");
include_once("Dao/TipoDespesa/TipoDespesaDao.php");
class TipoDespesaModel extends BaseModel
{
    Public Function ListarTiposDespesasAtivos($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesasAtivos($_SESSION['cod_cliente_final']);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;                
    }

    function VerificarTeto() {
        $dao = new TiposDespesaDao();
        $codTipoDespesa = filter_input(INPUT_POST, 'tpoDespesa', FILTER_SANITIZE_STRING);
        $result = $dao->VerificarTeto($_SESSION['cod_cliente_final'], $codTipoDespesa);

        return json_encode($result);
    }
    
    Function ListarSomaTipoDespesas() {
        $dao = new TiposDespesaDao();
        $ano = filter_input(INPUT_POST, 'anoFiltro', FILTER_SANITIZE_STRING);
        $mes = filter_input(INPUT_POST, 'mesFiltro', FILTER_SANITIZE_STRING);
        if ($mes=='') {
            $mes=date('m');
        }
        if ($ano=='') {
            $ano=date('Y');
        }        
        $lista = $dao->ListarSomaTipoDespesas($_SESSION['cod_cliente_final'], $mes, $ano);
        $arrTipos = [];
        if($lista[0] && $lista[1] != null){
            $count = count($lista[1]);
            if($count > 0) {
                for($i=0;$i<$count;$i++) {
                    array_push($arrTipos, $lista[1][$i]['DSC_TIPO_DESPESA']);
                    $lista[1][$i]['PORCENT'] = $lista[1][$i]['PORCENT'] < 100 ? $lista[1][$i]['PORCENT'] : 100;
                    $lista[1][$i]['VALOR'] = number_format($lista[1][$i]['VALOR'],2,'.','');
                }
            }
        }
        $lista[2] = $arrTipos;

        return json_encode($lista);
    }
}
?>
