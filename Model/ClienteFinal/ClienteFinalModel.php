<?php
include_once("Model/BaseModel.php");
include_once("Dao/ClienteFinal/ClienteFinalDao.php");
include_once("Resources/php/FuncoesArray.php");
class ClienteFinalModel extends BaseModel {  
    
    Public Function ListarClienteFinal($Json=true){
        $dao = new ClienteFinalDao();
        $lista = $dao->ListarClienteFinal($_SESSION['cod_usuario'], $_SESSION['cod_perfil']);
        if ($lista[0]) {
            for ($i=0;$i<count($lista);$i++){
                $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO' , 'ATIVO');
            }
        }
        if ($Json) {
            $lista = json_encode($lista);
        }
        return $lista;
    }     
    
    Public Function ListarClienteFinalAtivo($Json=true){
        $dao = new ClienteFinalDao();
        $lista = $dao->ListarClienteFinalAtivo($_SESSION['cod_perfil'], $_SESSION['cod_cliente_final']);
        if ($Json) {
            $lista = json_encode($lista);
        }
        return $lista;
    }
    
    Public Function UpdateCliente($Json=true){
        $dao = new ClienteFinalDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $lista = $dao->UpdateCliente($this->objRequest);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    } 
    
    Public Function AddCliente($Json=true){
        $dao = new ClienteFinalDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $lista = $dao->AddCliente($this->objRequest);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
    
    Public Function DeleteCliente($Json=true){
        $dao = new ClienteFinalDao();
        $lista = $dao->DeleteCliente();
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
}
?>
