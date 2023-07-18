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
		"indAtiva"          => array("column" => "IND_ATIVA", 		  "typeColumn" => "S")
	);

  	protected $columnKey = array("codConta" => array("column" => "COD_CONTA", "typeColumn" => "I"));

    function AddContaBancaria(stdClass $obj) {
      return $this->MontarInsert($obj);
    }
    
    function UpdateContaBancaria(stdClass $obj) {
      return $this->MontarUpdate($obj);
    }

    Function ListarContasBancarias($codClienteFinal,
                                   $param = null){
        $sql = " SELECT COD_CONTA,
                        NME_BANCO,
                        NRO_CONTA,
                        NRO_AGENCIA,
                        COD_CLIENTE_FINAL,
                        CONCAT(NME_BANCO,'(Ag: ',NRO_AGENCIA,' Conta: ',NRO_CONTA,')') AS CONTA,
                        IND_ATIVA
                   FROM EN_CONTA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal";
        if ($param!=null){
            $sql .= " AND COD_CONTA = ".$param;
        }
        //echo $sql; exit;
        return $this->selectDB($sql, false);
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
        //echo $sql; exit;
        return $this->selectDB($sql, false);
    }

    Function ListarSaldoContasBancarias($codClienteFinal){
        $form = new ContasBancariasForm();
        $sql = "SELECT NME_BANCO,
                       NRO_CONTA,
                       NRO_AGENCIA,
                       COD_CONTA,
                       SUM(VALOR) AS VALOR
                FROM (
                SELECT C.NME_BANCO,
                       C.NRO_AGENCIA,
                       C.NRO_CONTA,
                       C.COD_CONTA,
                       SUM(COALESCE(VLR_RECEITA,0)) AS VALOR
                  FROM EN_CONTA C
                  LEFT JOIN EN_RECEITA D
                    ON D.COD_CONTA = C.COD_CONTA
                 WHERE MONTH(DTA_RECEITA)='".$form->getNroMesReferencia()."'
                   AND YEAR(DTA_RECEITA)='".$form->getNroAnoReferencia()."'
                   AND C.COD_CLIENTE_FINAL = ".$codClienteFinal."
                   AND IND_ATIVA = 'S'
                 GROUP BY C.NME_BANCO, C.NRO_CONTA
                UNION ALL
                SELECT C.NME_BANCO,
                       C.NRO_AGENCIA,
                       C.NRO_CONTA,
                       C.COD_CONTA,
                       SUM(COALESCE(VLR_DESPESA,0))*-1 AS VALOR
                  FROM EN_CONTA C
                  LEFT JOIN EN_DESPESA D
                    ON D.COD_CONTA = C.COD_CONTA
                 WHERE MONTH(DTA_DESPESA)='".$form->getNroMesReferencia()."'
                   AND YEAR(DTA_DESPESA)='".$form->getNroAnoReferencia()."'
                   AND C.COD_CLIENTE_FINAL = ".$codClienteFinal."
                   AND IND_ATIVA = 'S'
                   AND D.IND_DESPESA_PAGA = 'S'
                 GROUP BY C.NME_BANCO, C.NRO_CONTA
                 UNION ALL
                SELECT C.NME_BANCO,
                       C.NRO_AGENCIA,
                       C.NRO_CONTA,
                       C.COD_CONTA,
                       SUM(COALESCE(VLR_MOVIMENTACAO,0))*-1 AS VALOR
                  FROM EN_CONTA C
                 INNER JOIN RE_TRANSFERENCIA_CONTAS TC
                    ON C.COD_CONTA = TC.COD_CONTA_ORIGEM
                 WHERE MONTH(DTA_MOVIMENTACAO)='".$form->getNroMesReferencia()."'
                   AND YEAR(DTA_MOVIMENTACAO)='".$form->getNroAnoReferencia()."'
                   AND C.COD_CLIENTE_FINAL = ".$codClienteFinal."
                   AND IND_ATIVA = 'S'
                 GROUP BY C.NME_BANCO, C.NRO_CONTA
                UNION ALL
                SELECT C.NME_BANCO,
                       C.NRO_AGENCIA,
                       C.NRO_CONTA,
                       C.COD_CONTA,
                       SUM(COALESCE(VLR_MOVIMENTACAO,0)) AS VALOR
                  FROM EN_CONTA C
                  LEFT JOIN RE_TRANSFERENCIA_CONTAS TC
                    ON C.COD_CONTA = TC.COD_CONTA_DESTINO
                 WHERE MONTH(DTA_MOVIMENTACAO)='".$form->getNroMesReferencia()."'
                   AND YEAR(DTA_MOVIMENTACAO)='".$form->getNroAnoReferencia()."'
                   AND C.COD_CLIENTE_FINAL = ".$codClienteFinal."
                   AND IND_ATIVA = 'S'
                 GROUP BY C.NME_BANCO, C.NRO_CONTA) AS X
                 GROUP BY NME_BANCO, NRO_CONTA, NRO_AGENCIA";
        return $this->selectDB($sql, false);
    }

    function ImportarSaldo($codClienteFinal,
                           $valor,
                           $codConta){
        $form = new ContasBancariasForm();
        $codigo = $this->CatchUltimoCodigo('EN_RECEITA', 'COD_RECEITA');
        $dscReceita = "Saldo do mês ".$form->getNroMesReferencia()." do ano ".$form->getNroAnoReferencia();
        $sql_importa = " INSERT INTO EN_RECEITA VALUES ($codigo,
                                                            NOW(),
                                                            '".$valor."',
                                                            ".$codConta.",
                                                            '$dscReceita',
                                                         $codClienteFinal)";
        return $this->insertDB($sql_importa);

    }
}
?>
