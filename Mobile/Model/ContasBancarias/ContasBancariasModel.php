<?php
include_once("Dao/ContasBancarias/ContasBancariasDao.php");
class ContasBancariasModel
{
    Public Function ListarContasBancariasAtivas($Json = true){
        $dao = new ContasBancariasDao();
        $lista = $dao->ListarContasBancariasAtivas($_SESSION['cod_cliente_final']);
        for ($i=0;$i<count($lista[1]);$i++){
            $lista[1][$i]['ID'] = $lista[1][$i]['COD_CONTA'];
            $lista[1][$i]['DSC'] = $lista[1][$i]['CONTA'];
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;        
    }
}
?>

