<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/TipoDespesa/TipoDespesaDao.php");
class TipoDespesaModel extends BaseModel
{
    function TipoDespesaModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
    function AddTipoDespesa($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->AddTipoDespesa($_SESSION['cod_cliente_final']);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }

    function UpdateTipoDespesa($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->UpdateTipoDespesa();
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
    
    Function ListarTiposDespesas($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesas($_SESSION['cod_cliente_final']);
        for ($i=0;$i<count($lista);$i++){
            $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO|IND_INVESTIMENTO' , 'ATIVO|INVESTIMENTO');
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;                
    }
    
    Function ListarTiposDespesasAtivos($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesasAtivos($_SESSION['cod_cliente_final']);
        for ($i=0;$i<count($lista);$i++){
            $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO|IND_INVESTIMENTO' , 'ATIVO|INVESTIMENTO');
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;                
    }
}
?>
