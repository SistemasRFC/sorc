<?php
include_once("Dao/BaseDao.php");
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

	function AddContaBancaria(stdClass $obj)
	{
		return $this->MontarInsert($obj);
	}

	function UpdateContaBancaria(stdClass $obj)
	{
		return $this->MontarUpdate($obj);
	}

	function ListarContasBancarias($codClienteFinal, $param = null)
	{
		$sql = " SELECT COD_CONTA,
                        NME_BANCO,
                        NRO_CONTA,
                        NRO_AGENCIA,
                        COD_CLIENTE_FINAL,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS CONTA,
                        IND_ATIVA,
                        COALESCE(IND_IS_CARTAO, 'N') AS IND_IS_CARTAO
                   FROM EN_CONTA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal";
		if ($param != null) {
			$sql .= " AND COD_CONTA = " . $param;
		}
		return $this->selectDB($sql, false);
	}

	function ListarContasBancariasAtivas($codClienteFinal)
	{
		$sql = " SELECT COD_CONTA,
                        NME_BANCO,
                        NRO_CONTA,
                        NRO_AGENCIA,
                        COD_CLIENTE_FINAL,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS CONTA,
                        IND_ATIVA,
                        COALESCE(IND_IS_CARTAO, 'N') AS IND_IS_CARTAO
                   FROM EN_CONTA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                    AND IND_ATIVA='S'
               ORDER BY NME_CONTA";
		return $this->selectDB($sql, false);
	}

	function ListarContasFiltro($codClienteFinal)
	{
		$sql = " SELECT COD_CONTA as ID,
                        CONCAT(NME_BANCO,' (Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS DSC
                   FROM EN_CONTA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal AND IND_ATIVA='S'
               ORDER BY DSC";
		return $this->selectDB($sql, false);
	}
}
