<?php
include_once("Dao/ContasBancarias/ContasBancariasDao.php");
class ContasBancariasModel
{
    Public Function ListarContasBancariasAtivas($Json = true){
        $dao = new ContasBancariasDao();
        $lista = $dao->ListarContasBancariasAtivas($_SESSION['cod_cliente_final']);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;        
    }
}
?>

