<?php
include_once("Dao/BaseDao.php");
class RelPorcentagemGastosReceitasDao extends BaseDao
{
    Public Function RelPorcentagemGastosReceitasDao(){
        $this->conect();
    }
    
    Public Function CarregaRegistros($codCliente, $mes, $ano){
        $sql = " SELECT TP.COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        SUM(VLR_DESPESA) AS VLR_DESPESA,
                        (SELECT SUM(VLR_RECEITA)
                           FROM EN_RECEITA R
                          WHERE R.COD_CLIENTE_FINAL = $codCliente 
                            AND (YEAR(R.DTA_RECEITA)=$ano 
                            AND MONTH(R.DTA_RECEITA) = $mes)) AS VLR_RECEITA 
                   FROM EN_DESPESA D
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE D.COD_CLIENTE_FINAL = $codCliente
                    AND MONTH(D.DTA_DESPESA)= $mes
                    AND YEAR(D.DTA_DESPESA)= $ano";
        $indStatus = filter_input(INPUT_POST, 'indStatus', FILTER_SANITIZE_STRING);
        if ($indStatus!="-1" && $indStatus!=""){
            $sql .= "   AND D.IND_DESPESA_PAGA = '".$indStatus."'";
        }                     
        $sql .= "   GROUP BY TP.COD_TIPO_DESPESA, DSC_TIPO_DESPESA
                    ORDER BY VLR_DESPESA";
        return $this->selectDB($sql, false);
    }
}
?>
