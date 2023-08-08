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
}
?>
