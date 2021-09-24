<?PHP
include_once("Dao/BaseDao.php");
class ContasBancariasDao extends BaseDao
{
    function ContasBancariasDao(){
        $this->conect();
    }

    Function ListarContasBancariasAtivas($codClienteFinal,
                                   $param = null){
        $sql = " SELECT COD_CONTA,
                        NME_BANCO,
                        NRO_CONTA,
                        NRO_AGENCIA,
                        COD_CLIENTE_FINAL,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS CONTA,
                        IND_ATIVA
                   FROM EN_CONTA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal AND IND_ATIVA='S'";
        if ($param!=null){
            $sql .= " AND COD_CONTA = ".$param;
        }
        return $this->selectDB($sql, false);
    }
}
?>
