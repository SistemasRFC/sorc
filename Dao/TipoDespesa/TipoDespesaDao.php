<?php
include_once("../../Dao/BaseDao.php");
class TiposDespesaDao extends BaseDao
{
    function TiposDespesaDao(){
        $this->conect();
    }

    Function AddTipoDespesa($codClienteFinal){
        $vlrPiso = str_replace('.', '', filter_input(INPUT_POST, 'vlrPiso', FILTER_SANITIZE_STRING));
        $vlrPiso = str_replace(',', '.', $vlrPiso);        
        $vlrTeto = str_replace('.', '', filter_input(INPUT_POST, 'vlrTeto', FILTER_SANITIZE_STRING));
        $vlrTeto = str_replace(',', '.', $vlrTeto);
        $sql = "INSERT INTO EN_TIPO_DESPESA (
                COD_TIPO_DESPESA,
                DSC_TIPO_DESPESA,
                VLR_PISO,
                VLR_TETO,
                COD_CLIENTE_FINAL,
                IND_ATIVO)
                VALUES(
                ".$this->CatchUltimoCodigo('EN_TIPO_DESPESA', 'COD_TIPO_DESPESA').",
                '".filter_input(INPUT_POST, 'dscTipoDespesa', FILTER_SANITIZE_STRING)."',
                '".$vlrPiso."',
                '".$vlrTeto."',
                '".$codClienteFinal."',
                '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."')";
        return $this->insertDB($sql);
    }
    
    Function UpdateTipoDespesa(){
        $vlrPiso = str_replace('.', '', filter_input(INPUT_POST, 'vlrPiso', FILTER_SANITIZE_STRING));
        $vlrPiso = str_replace(',', '.', $vlrPiso);        
        $vlrTeto = str_replace('.', '', filter_input(INPUT_POST, 'vlrTeto', FILTER_SANITIZE_STRING));
        $vlrTeto = str_replace(',', '.', $vlrTeto);        
        $sql = " UPDATE EN_TIPO_DESPESA
                    SET DSC_TIPO_DESPESA = '".filter_input(INPUT_POST, 'dscTipoDespesa', FILTER_SANITIZE_STRING)."',
                        VLR_PISO = '".$vlrPiso."',
                        VLR_TETO = '".$vlrTeto."',
                        IND_ATIVO = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."'
                  WHERE COD_TIPO_DESPESA = ".filter_input(INPUT_POST, 'codTipoDespesa', FILTER_SANITIZE_NUMBER_INT);
        return $this->insertDB($sql);
    }

    Function ListarTiposDespesas($codClienteFinal){
        $sql = " SELECT COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        VLR_PISO,
                        VLR_TETO,
                        IND_ATIVO
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }

    Function ListarTiposDespesasAtivos($codClienteFinal){
        $sql = " SELECT COD_TIPO_DESPESA,
                        DSC_TIPO_DESPESA,
                        VLR_PISO,
                        VLR_TETO,
                        IND_ATIVO
                   FROM EN_TIPO_DESPESA
                  WHERE COD_CLIENTE_FINAL = $codClienteFinal AND IND_ATIVO='S'
                  ORDER BY DSC_TIPO_DESPESA";
        return $this->selectDB($sql, false);
    }
}
?>
