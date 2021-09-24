<?php
include_once("Model/BaseModel.php");
include_once("Dao/TipoDespesa/TipoDespesaDao.php");
class TipoDespesaModel extends BaseModel
{
    Public Function ListarTiposDespesasAtivos($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesasAtivos($_SESSION['cod_cliente_final']);
        for ($i=0;$i<count($lista);$i++){
            $lista[1][$i]['ID']=$lista[1][$i]['COD_TIPO_DESPESA'];
            $lista[1][$i]['DSC']=$lista[1][$i]['DSC_TIPO_DESPESA'];
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;                
    }
}
?>
