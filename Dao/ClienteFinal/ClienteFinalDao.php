<?php
include_once("../../Dao/BaseDao.php");
class ClienteFinalDao extends BaseDao
{
    function ClienteFinalDao(){
        $this->conect();
    }

    function ListarClienteFinal($codUsuario, $codPerfil){
        $sql_lista = "SELECT COD_CLIENTE_FINAL,
                          DSC_CLIENTE_FINAL,
                          IND_ATIVO
                     FROM EN_CLIENTE_FINAL";
        if ($codPerfil!=1){
            $sql_lista .= " WHERE COD_USUARIO_PAI = ".$codUsuario;
        }
        $sql_lista .= " ORDER BY DSC_CLIENTE_FINAL ";
       return $this->selectDB("$sql_lista", false);       
    }

    Public Function ListarClienteFinalAtivo($codUsuario, $codPerfil){
        $sql_lista = "SELECT COD_CLIENTE_FINAL,
                          DSC_CLIENTE_FINAL,
                          IND_ATIVO
                     FROM EN_CLIENTE_FINAL 
                    WHERE IND_ATIVO = 'S'";
        if ($codPerfil!=1){
            $sql_lista .= " AND COD_USUARIO_PAI = ".$codUsuario;
        }
        $sql_lista .= " ORDER BY DSC_CLIENTE_FINAL ";
       return $this->selectDB("$sql_lista", false);
    }

    function AddCliente($codUsuario){
        $codClienteFinal = $this->CatchUltimoCodigo('EN_CLIENTE_FINAL', 'COD_CLIENTE_FINAL');
        $sql_lista = "
        INSERT INTO EN_CLIENTE_FINAL VALUES ( ".$codClienteFinal.", ".
                                              "'".filter_input(INPUT_POST, 'dscCliente', FILTER_SANITIZE_STRING)."', 
                                              '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                                              ".$codUsuario.") ";
        return $this->insertDB("$sql_lista");

    }

    function UpdateCliente($codUsuario){
        $sql_lista = "
         UPDATE EN_CLIENTE_FINAL
            SET DSC_CLIENTE_FINAL='".filter_input(INPUT_POST, 'dscCliente', FILTER_SANITIZE_STRING)."', 
                IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
                COD_USUARIO_PAI = ".$codUsuario."
          WHERE COD_CLIENTE_FINAL = ".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB("$sql_lista");

    }

    function DeleteCliente(){
        $sql_lista = "
        UPDATE EN_CLIENTE_FINAL SET IND_ATIVO = 'N'
         WHERE COD_CLIENTE_FINAL = ".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB("$sql_lista");
    }

}
?>
