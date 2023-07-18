<?
include_once("Dao/BaseDao.php");
class RelResumoAnualDao extends BaseDao
{
    Public Function RelResumoAnualDao(){
    }
    
    Public Function CarregaRegistros($codCliente){
        $sql = "SELECT MONTH(D.DTA_DESPESA) AS NRO_MES_REFERENCIA,
                       CASE WHEN MONTH(D.DTA_DESPESA)=01 THEN 'Janeiro'
                            WHEN MONTH(D.DTA_DESPESA)=02 THEN 'Fevereiro'
                            WHEN MONTH(D.DTA_DESPESA)=03 THEN 'Março'
                            WHEN MONTH(D.DTA_DESPESA)=04 THEN 'Abril'
                            WHEN MONTH(D.DTA_DESPESA)=05 THEN 'Maio'
                            WHEN MONTH(D.DTA_DESPESA)=06 THEN 'Junho'
                            WHEN MONTH(D.DTA_DESPESA)=07 THEN 'Julho'
                            WHEN MONTH(D.DTA_DESPESA)=08 THEN 'Agosto'
                            WHEN MONTH(D.DTA_DESPESA)=09 THEN 'Setembro'
                            WHEN MONTH(D.DTA_DESPESA)=10 THEN 'Outubro'
                            WHEN MONTH(D.DTA_DESPESA)=11 THEN 'Novembro'
                            WHEN MONTH(D.DTA_DESPESA)=12 THEN 'Dezembro' END AS MES,
                        YEAR(D.DTA_DESPESA) AS ANO,
                        SUM(VLR_DESPESA) AS VALOR
                   FROM EN_DESPESA D
                  INNER JOIN EN_TIPO_DESPESA TP
                     ON D.TPO_DESPESA = TP.COD_TIPO_DESPESA
                  WHERE D.COD_CLIENTE_FINAL = $codCliente 
                    AND MONTH(D.DTA_DESPESA)>0
                    AND YEAR(D.DTA_DESPESA)=".filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_NUMBER_INT)."
                  GROUP BY MES, ANO
                  ORDER BY ANO, NRO_MES_REFERENCIA";
        return $this->selectDB($sql, false);
    }
}
?>
