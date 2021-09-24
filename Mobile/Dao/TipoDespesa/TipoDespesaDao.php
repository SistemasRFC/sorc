<?php
include_once("Dao/BaseDao.php");
class TiposDespesaDao extends BaseDao
{
    Public Function ListarTiposDespesasAtivos($codClienteFinal){
        $sql = " SELECT COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        VLR_PISO,
                        VLR_TETO,
                        IND_ATIVO,
                        IND_INVESTIMENTO
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal AND IND_ATIVO='S'
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }
}
?>
