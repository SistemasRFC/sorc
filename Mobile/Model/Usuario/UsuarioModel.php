<?php
include_once("../Model/BaseModel.php");
include_once("Dao/Usuario/UsuarioDao.php");
class UsuarioModel extends BaseModel
{
    function ListarResponsavelFiltro(){
        $dao = new UsuarioDao();        
        $lista = $dao->ListarResponsavelFiltro($_SESSION['cod_cliente_final']);
        return json_encode($lista);
    }
}
?>
