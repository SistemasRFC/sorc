<?php
include_once("Dao/Despesas/DespesasDao.php");

class DespesaModel extends BaseModel
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

    Function ListarDespesasMob(){
        $dao = new DespesasDao();
        $codCliente = $_SESSION['cod_cliente_final'];
        if ($_SESSION['cod_perfil']==3){
            $codCliente = filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        }
        $lista = $dao->ListarDespesas($codCliente);
        $vlrTotal = 0;
        for($i=0;$i<count($lista[1]);$i++) {
            $vlrTotal += $lista[1][$i]['VLR_DESPESA'];
            $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            $lista[1][$i]['DTA_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_DESPESA']);
            $lista[1][$i]['DTA_LANC_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_LANC_DESPESA']);
            $lista[1][$i]['DTA_PAGAMENTO'] = $this->ConverteDataBanco($lista[1][$i]['DTA_PAGAMENTO']);
            $lista[1][$i]['VLR_DESPESA'] = number_format($lista[1][$i]['VLR_DESPESA'],2,'.','');
        }
        $lista[2]['VLR_TOTAL'] = number_format($vlrTotal, 2, '.', '');
        return json_encode($lista);
    }
}
?>
