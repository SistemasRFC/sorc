<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/ContasBancarias/ContasBancariasDao.php");
class ContasBancariasModel extends BaseModel
{
    function ContasBancariasModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
    function AddContaBancaria(){
        $dao = new ContasBancariasDao();
        return json_encode($dao->AddContaBancaria($_SESSION['cod_cliente_final']));
    }

    function UpdateContaBancaria(){
        $dao = new ContasBancariasDao();
        return json_encode($dao->UpdateContaBancaria());
    }

    function RemoveContaBancaria(){
        $dao = new ContasBancariasDao();
        return json_encode($dao->RemoveContaBancaria());
    }

    Function ListarContasBancarias($Json = true){
        $dao = new ContasBancariasDao();
        $lista = $dao->ListarContasBancarias($_SESSION['cod_cliente_final']);
        for ($i=0;$i<count($lista);$i++){
            $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVA' , 'ATIVO');
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;        
    }

    Function ListarContasBancariasAtivas($Json = true){
        $dao = new ContasBancariasDao();
        $lista = $dao->ListarContasBancariasAtivas($_SESSION['cod_cliente_final']);
        for ($i=0;$i<count($lista);$i++){
            $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVA' , 'ATIVO');
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;        
    }

    Function ListarSaldoContasBancarias(){
        $dao = new ContasBancariasDao();
        $lista = $dao->ListarSaldoContasBancarias($_SESSION['cod_cliente_final']);
        $total = count($lista);
        $i=0;
        $data = array();
        while($i<$total ) {
            $data[] = array(
                'nmeBanco' => $lista[$i]['NME_BANCO'],
                'nroConta' => $lista[$i]['NRO_CONTA'],
                'nroAgencia' => $lista[$i]['NRO_AGENCIA'],
                'valor' => number_format($lista[$i]['VALOR'],2)
            );
            $i++;
        }
        if (empty($data)){
            $data[] = array(
                'value' => '',
                'label' => 'Sem dados para a pesquisa',
                'id' => 0
            );
        }
        return json_encode($data);
    }

    function ImportarSaldo(){
        $dao = new ContasBancariasDao();
        $listaSaldo = $dao->ListarSaldoContasBancarias($_SESSION['cod_cliente_final']);
        for($i=0;$i<count($listaSaldo);$i++){
            $dao->ImportarSaldo($_SESSION['cod_cliente_final'], $listaSaldo[$i]['VALOR'], $listaSaldo[$i]['COD_CONTA']);
        }
        return true;
    }
}
?>
