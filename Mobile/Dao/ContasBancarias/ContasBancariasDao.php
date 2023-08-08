<?PHP
include_once("../Dao/BaseDao.php");
class ContasBancariasDao extends BaseDao
{
    Function ListarContasBancariasAtivas($codClienteFinal){
        $sql = " SELECT COD_CONTA AS ID,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS DSC
                   FROM EN_CONTA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                    AND IND_ATIVA='S'";
        return $this->selectDB($sql, false);
    }
}
?>
