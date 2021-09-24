<?php
include_once("Dao/Despesas/DespesasDao.php");
class DespesaModel
{
    
    function AddDespesa(){
        $dao = new DespesasDao();
        $qtdParcelas = filter_input(INPUT_POST, 'qtdParcelas', FILTER_SANITIZE_NUMBER_INT);
        $nroParcelaAtual = filter_input(INPUT_POST, 'nroParcelaAtual', FILTER_SANITIZE_NUMBER_INT);        
        $dta = explode('/', filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING));
        $dtaLancamento = filter_input(INPUT_POST, 'dtaLancDespesa', FILTER_SANITIZE_STRING);
        $indDespesaPaga = filter_input(INPUT_POST, 'indDespesaPaga', FILTER_SANITIZE_STRING);
        $dtaPagamento = filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING);
        if ($dtaPagamento==''){
            $dtaPagamento=NULL;
        }
        $codDespesaImportada = 0;
        for ($i=$nroParcelaAtual;$i<=$qtdParcelas;$i++){
            if ($dta[1]==13){
                $dta[1]=1;
                $dta[2]++;
            }
            if (strlen($dta[1])==1){
                $dta[1] = '0'.$dta[1];
            }
            $dtaDespesa = $dta[0].'/'.$dta[1].'/'.$dta[2]; 
            $result = $dao->AddDespesa($_SESSION['cod_cliente_final'], $dtaDespesa, $indDespesaPaga, $dtaPagamento, $dtaLancamento, $nroParcelaAtual, $codDespesaImportada);
            if ($i==$nroParcelaAtual){
                $codDespesaImportada = $result[2];
            }
            $indDespesaPaga = 'N';
            $dtaPagamento = '';            
            $dta[1]++;
            $nroParcelaAtual++;
        }
        return json_encode($result);
    }
}
?>
