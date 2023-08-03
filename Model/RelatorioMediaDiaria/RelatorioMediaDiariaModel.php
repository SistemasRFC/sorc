<?php
include_once("Model/BaseModel.php");
include_once("Dao/RelatorioMediaDiaria/RelatorioMediaDiariaDao.php");
class RelatorioMediaDiariaModel extends BaseModel
{

    Public Function BuscarMediaDiaria($Json=true) {
        $dao = new RelatorioMediaDiariaDao();
        $lista = $dao->BuscarMediaDiaria($_SESSION['cod_cliente_final']);
        if ($Json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    Public Function ListarAnosFiltro() {
        return BaseModel::ListarAnosCombo();
    }
}
?>
