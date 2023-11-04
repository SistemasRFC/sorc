<?PHP
include_once("../Dao/BaseDao.php");
class ContasBancariasDao extends BaseDao
{
	protected $tableName = "EN_CONTA";

	protected $columns = array(
		"nmeBanco"       	=> array("column" => "NME_BANCO", 		  "typeColumn" => "S"),
		"nroConta"      	=> array("column" => "NRO_CONTA", 		  "typeColumn" => "S"),
		"nroAgencia"        => array("column" => "NRO_AGENCIA", 	  "typeColumn" => "S"),
		"codClienteFinal"	=> array("column" => "COD_CLIENTE_FINAL", "typeColumn" => "I"),
		"indAtiva"          => array("column" => "IND_ATIVA", 		  "typeColumn" => "S"),
		"indIsCartao"       => array("column" => "IND_IS_CARTAO", 	  "typeColumn" => "S")
	);

	protected $columnKey = array("codConta" => array("column" => "COD_CONTA", "typeColumn" => "I"));

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
