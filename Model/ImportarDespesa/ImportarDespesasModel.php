<?php
include_once("Model/BaseModel.php");
include_once("Dao/ImportarDespesa/ImportarDespesaDao.php");
class ImportarDespesaModel extends BaseModel {

    function ImportarDespesas(){
        $form->setOrdenacao('DTA_DESPESA');
        $form->setOrientaOrdenacao('ASC');
        $dao = new ImportarDespesaDao();
        $lista = $dao->ListarDespesas($_SESSION['cod_cliente_final']);

        $codigos = explode(";", $form->getCodDespesaSelecao());
        $values = "";
        for($i=0;$i<count($lista);$i++){
            for($j=0;$j<count($codigos);$j++){
                if ($codigos[$j]==$lista[$i]['COD_DESPESA']){
                    $dtaDespesa = $_POST['nroAnoReferenciaDestino'].'-'.$_POST['nroMesReferenciaDestino'].'-'.substr($lista[$i]['DTA_DESPESA'],8,2);
                    $dtaDespesa = $this->ConverteDataBanco($dtaDespesa);
                    $form->setCodConta($lista[$i]['COD_CONTA']);
                    $form->setCodTipoDespesa($lista[$i]['COD_TIPO_DESPESA']);
                    $form->setDscDespesa($lista[$i]['DSC_DESPESA']);
                    $form->setDtaDespesa($dtaDespesa);
                    $form->setVlrDespesa($lista[$i]['VLR_DESPESA']);
                    $form->setIndDespesaPaga('N');
                    $form->setCodDespesaImportada($lista[$i]['COD_DESPESA']);
                    $_POST['qtdParcelas']=1;
                    $_POST['nroParcelaAtual']=1;
                    $dao->AddDespesa($_SESSION['cod_cliente_final'], $codDespesa, $dtaDespesa);
                }
            }
        }
        return true;
    }
    
    Function ListarDespesas(){
        $dao = new DespesasDao();
        $lista = $dao->ListarDespesas($_SESSION['cod_cliente_final']);
        
        for($i=0;$i<count($lista[1]);$i++) {
            $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            $lista[1][$i]['DTA_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_DESPESA']);
            $lista[1][$i]['DTA_PAGAMENTO'] = $this->ConverteDataBanco($lista[1][$i]['DTA_PAGAMENTO']);
            $lista[1][$i]['VLR_DESPESA'] = number_format($lista[1][$i]['VLR_DESPESA'],2,'.','');
        }        
        return json_encode($lista);
    }
}
?>
