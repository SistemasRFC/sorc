<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/ClienteFinal/ClienteFinalDao.php");
class ClienteFinalModel extends BaseModel
{
    function ClienteFinalModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }    
    
    Public Function ListarClienteFinal($Json=true){
        $clienteFinalDao = new ClienteFinalDao();
        $lista = $clienteFinalDao->ListarClienteFinal($_SESSION['cod_usuario'], $_SESSION['cod_perfil']);
        if ($lista[0]){
            for ($i=0;$i<count($lista);$i++){
                $lista = BaseModel::AtualizaBooleanInArray($lista, 'IND_ATIVO' , 'ATIVO');
            }
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }     
    
    Public Function ListarClienteFinalAtivo($Json=true){
        $clienteFinalDao = new ClienteFinalDao();
        $lista = $clienteFinalDao->ListarClienteFinalAtivo($_SESSION['cod_usuario'], $_SESSION['cod_perfil']);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
    
    Public Function UpdateCliente($Json=true){
        $clienteFinalDao = new ClienteFinalDao();
        $lista = $clienteFinalDao->UpdateCliente($_SESSION['cod_usuario']);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    } 
    
    Public Function AddCliente($Json=true){
        $clienteFinalDao = new ClienteFinalDao();
        $lista = $clienteFinalDao->AddCliente($_SESSION['cod_usuario']);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
    
    Public Function DeleteCliente($Json=true){
        $clienteFinalDao = new ClienteFinalDao();
        $lista = $clienteFinalDao->DeleteCliente();
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
}
?>
