<?php
include_once("Dao/Despesas/DespesasDao.php");
include_once("../Resources/php/FuncoesData.php");
include_once("../Resources/php/FuncoesMoeda.php");
include_once("../Resources/php/FuncoesArray.php");

class DespesaModel extends BaseModel
{

    function AddDespesa() {
        $dao = new DespesasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $qtdParcelas = $this->objRequest->qtdParcelas;
        $nroParcelaAtual = $this->objRequest->nroParcelaAtual;        
        $dta = explode('-', $this->objRequest->dtaDespesa);
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        $this->objRequest->dtaLancDespesa = date('Y-m-d');
        if ($this->objRequest->indDespesaPaga == 'N') {
            unset($this->objRequest->dtaPagamento);
        }
        $this->objRequest->codDespesaImportacao = 0;
        for ($i=$nroParcelaAtual;$i<=$qtdParcelas;$i++){
            if ($dta[1]==13){
                $dta[1]=1;
                $dta[0]++;
            }
            if (strlen($dta[1])==1){
                $dta[1] = '0'.$dta[1];
            }
            $this->objRequest->dtaDespesa = $dta[0].'-'.$dta[1].'-'.$dta[2]; 
            $result = $dao->AddDespesa($this->objRequest);
            if ($i==$nroParcelaAtual){
                $this->objRequest->codDespesaImportacao = $result[2];
            }
            $this->objRequest->indDespesaPaga = 'N';
            unset($this->objRequest->dtaPagamento);
            $this->objRequest->nroParcelaAtual = $this->objRequest->nroParcelaAtual++;

            $dta[1]++;
            $nroParcelaAtual = $nroParcelaAtual++;
        }
        return json_encode($result);
    }
    
    // function AddDespesa(){
    //     $dao = new DespesasDao();
    //     $qtdParcelas = filter_input(INPUT_POST, 'qtdParcelas', FILTER_SANITIZE_NUMBER_INT);
    //     $nroParcelaAtual = filter_input(INPUT_POST, 'nroParcelaAtual', FILTER_SANITIZE_NUMBER_INT);        
    //     $dta = explode('/', filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING));
    //     $dtaLancamento = filter_input(INPUT_POST, 'dtaLancDespesa', FILTER_SANITIZE_STRING);
    //     $indDespesaPaga = filter_input(INPUT_POST, 'indDespesaPaga', FILTER_SANITIZE_STRING);
    //     $dtaPagamento = filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING);
    //     if ($dtaPagamento==''){
    //         $dtaPagamento=NULL;
    //     }
    //     $codDespesaImportada = 0;
    //     for ($i=$nroParcelaAtual;$i<=$qtdParcelas;$i++){
    //         if ($dta[1]==13){
    //             $dta[1]=1;
    //             $dta[2]++;
    //         }
    //         if (strlen($dta[1])==1){
    //             $dta[1] = '0'.$dta[1];
    //         }
    //         $dtaDespesa = $dta[0].'/'.$dta[1].'/'.$dta[2]; 
    //         $result = $dao->AddDespesa($_SESSION['cod_cliente_final'], $dtaDespesa, $indDespesaPaga, $dtaPagamento, $dtaLancamento, $nroParcelaAtual, $codDespesaImportada);
    //         if ($i==$nroParcelaAtual){
    //             $codDespesaImportada = $result[2];
    //         }
    //         $indDespesaPaga = 'N';
    //         $dtaPagamento = '';            
    //         $dta[1]++;
    //         $nroParcelaAtual++;
    //     }
    //     return json_encode($result);
    // }

    Function ListarDespesasMob(){
        $dao = new DespesasDao();
        $codCliente = $_SESSION['cod_cliente_final'];
        if ($_SESSION['cod_perfil']==3){
            $codCliente = filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        }
        $lista = $dao->ListarDespesas($codCliente);
        $vlrTotal = 0;
        if($lista[0] && $lista[1] != null) {
            for($i=0;$i<count($lista[1]);$i++) {
                $vlrTotal += $lista[1][$i]['VLR_DESPESA'];
                $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            }

            $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_DESPESA|DTA_LANC_DESPESA|DTA_PAGAMENTO', 'DTA_DESPESA_FORMATADO|DTA_LANC_DESPESA_FORMATADO|DTA_PAGAMENTO_FORMATADO');
            $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_DESPESA');
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_DESPESA_PAGA', 'PAGO');
        }
        $lista[2]['VLR_TOTAL'] = number_format($vlrTotal, 2, '.', '');
        return json_encode($lista);
    }

    function ListarAnosFiltro() {
        return BaseModel::ListarAnosCombo();
    }

    function ListarMesesFiltro() {
        return BaseModel::ListarMesesCombo();
    }
}
?>
