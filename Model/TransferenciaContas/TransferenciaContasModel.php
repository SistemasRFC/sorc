<?php
include_once("Model/BaseModel.php");
include_once("Dao/TransferenciaContas/TransferenciaContasDao.php");
class TransferenciaContasModel extends BaseModel {

    function AddTransferenciaContas(){
        $dao = new TransferenciaContasDao();
        return json_encode($dao->AddTransferenciaContas($_SESSION['cod_cliente_final']));
    }
    function DeletarTransferencia(){
        $dao = new TransferenciaContasDao();
        return json_encode($dao->DeletarTransferencia());
    }
    function UpdateTransferenciaContas(){
        $dao = new TransferenciaContasDao();
        return json_encode($dao->UpdateTransferenciaContas());
    }
    Function ListarTransferencias(){
        $dao = new TransferenciaContasDao();
        $lista = $dao->ListarTransferencias($_SESSION['cod_cliente_final']);
        if ($lista[0]){
            $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_MOVIMENTACAO');
        }
        return json_encode($lista);
    }
}
?>
