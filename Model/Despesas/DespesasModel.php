<?php
include_once("Model/BaseModel.php");
include_once("Dao/Despesas/DespesasDao.php");
include_once("Resources/php/FuncoesData.php");
include_once("Resources/php/FuncoesMoeda.php");
include_once("Resources/php/FuncoesArray.php");
class DespesaModel extends BaseModel
{
    
    function AddDespesa() {
        $dao = new DespesasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $qtdParcelas = $this->objRequest->qtdParcelas;
        $nroParcelaAtual = $this->objRequest->nroParcelaAtual;
        $dta = explode('-', $this->objRequest->dtaDespesa);
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        if ($this->objRequest->indDespesaPaga =='N') {
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
            $this->objRequest->nroParcelaAtual = $this->objRequest->nroParcelaAtual+1;
            $dtaLanc = explode('-', $this->objRequest->dtaLancDespesa);
            $dtaLanc[1]++;
            if ($dtaLanc[1]==13){
                $dtaLanc[1]=1;
                $dtaLanc[0]++;
            }
            if (strlen($dtaLanc[1])==1){
                $dtaLanc[1] = '0'.$dtaLanc[1];
            }
            $this->objRequest->dtaLancDespesa = $dtaLanc[0].'-'.$dtaLanc[1].'-'.$dtaLanc[2];

            $dta[1]++;
            $nroParcelaAtual = $nroParcelaAtual++;
        }
        return json_encode($result);
    }

    function UpdateDespesa() {
        $dao = new DespesasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        if ($this->objRequest->indDespesaPaga == 'N') {
            $this->objRequest->dtaPagamento = null;
        }
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        return json_encode($dao->UpdateDespesa($this->objRequest));
    }

    function DeletarDespesa() {
        $dao = new DespesasDao();
        $codDespesa = filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_STRING); 
        $result = $dao->PegaDespesasFilhas($codDespesa);
        $arrCodigos = $codDespesa.',';
        if($result[0] && $result[1] != null) {
            $count = count($result[1]);
            for($i=0; $i < $count; $i++) {
                $arrCodigos .= $result[1][$i]['COD_DESPESA'].',';
            }
        }
        $arrCodigos = substr($arrCodigos, 0, strlen($arrCodigos)-1);
        return json_encode($dao->DeletarDespesa($arrCodigos));
    }
    
    Function ListarDespesas() {
        $dao = new DespesasDao();
        $codCliente = $_SESSION['cod_cliente_final'];
        $lista = $dao->ListarDespesas($codCliente);
        if($lista[0] && $lista[1] != null) {
            $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_DESPESA|DTA_LANC_DESPESA|DTA_PAGAMENTO', 'DTA_DESPESA_FORMATADO|DTA_LANC_DESPESA_FORMATADO|DTA_PAGAMENTO_FORMATADO');
            $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_DESPESA');
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_DESPESA_PAGA', 'PAGO');
        }
        return json_encode($lista);
    }

    function ImportarDespesas() {
        $dao = new DespesasDao();
        $codigos = filter_input(INPUT_POST, 'codDespesas', FILTER_SANITIZE_STRING); 
        $nroAno = filter_input(INPUT_POST, 'anoRef', FILTER_SANITIZE_STRING); 
        $nroMes = filter_input(INPUT_POST, 'mesRef', FILTER_SANITIZE_STRING); 
        $arrCodigos = explode("d", $codigos);

        for($i=0; $i < count($arrCodigos); $i++) {
            $dtaDespesa = $nroAno.'-'.$nroMes.'-01';
            $despesaRef = $dao->GetDespesaById($arrCodigos[$i]);
            if($despesaRef[0] && count($despesaRef[1]) > 0){
                $dtaDespesaRef = $despesaRef[1][0]['DTA_DESPESA'];
                $data = explode("-", $dtaDespesaRef);
                $dtaDespesa = $nroAno.'-'.$nroMes.'-'.$data[2];
            }
            $codigoRef = $arrCodigos[$i];
            $lista = $dao->ImportarDespesas($codigoRef, $dtaDespesa, $_SESSION['cod_cliente_final']);
        }

        return json_encode($lista);
    }

    function ListarAnosFiltro() {
        return BaseModel::ListarAnosCombo();
    }

    function ListarMesesFiltro() {
        return BaseModel::ListarMesesCombo();
    }
    
    Public Function QuitarParcelas() {
        $dao = new DespesasDao();
        $codDespesa = filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        $result = $dao->PegaDespesaFilha($codDespesa);
        if ($result[1]!=NULL) {
            foreach($result[1] as $filha) {
                $dao->DeletarDespesaFilha($filha['COD_DESPESA']);
            }
        }
        return json_encode($result);
    }
    
    Public Function PagarPorConta(){
        $dao = new DespesasDao();
        $codDespesa = filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        $result = $dao->GetDespesaById($codDespesa);
        if ($result[0]){
            $result = $dao->AtualizaPagamento($result[1][0]['COD_CONTA'], $result[1][0]['DTA_DESPESA']);
        }
        return json_encode($result);
    }
    
    Public Function BaixarDespesas(){
        $dao = new DespesasDao();
        // $codCliente = $_SESSION['cod_cliente_final'];
        $listaDespesas = filter_input(INPUT_POST, 'listaDespesas', FILTER_SANITIZE_STRING);
        if ($listaDespesas != '') {
            $arrCodigos = str_replace("d", ",", $listaDespesas);
            $arrCodigos = substr($arrCodigos, 0, strlen($arrCodigos)-1);
            $result = $dao->BaixarDespesaEmLote($arrCodigos);
        } else {
            // $result = $dao->BaixarDespesas($codCliente);
            $result = [false, "Nenhuma Despesa para dar baixa."];
        }

        return json_encode($result);
    }
    
    Function ListarDespesasCartao() {
        $dao = new DespesasDao();
        $codCliente = $_SESSION['cod_cliente_final'];
        $lista = $dao->ListarDespesasCartao($codCliente);
        if($lista[0] && $lista[1] != null) {
            $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_DESPESA|DTA_LANC_DESPESA|DTA_PAGAMENTO', 'DTA_DESPESA_FORMATADO|DTA_LANC_DESPESA_FORMATADO|DTA_PAGAMENTO_FORMATADO');
            $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_DESPESA');
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_DESPESA_PAGA', 'PAGO');
        }
        return json_encode($lista);
    }
}
