<?php
include_once("Model/BaseModel.php");
include_once("Dao/Despesas/DespesasDao.php");
include_once("Resources/php/FuncoesData.php");
include_once("Resources/php/FuncoesMoeda.php");
include_once("Resources/php/FuncoesArray.php");
class DespesaModel extends BaseModel
{
    
    function AddDespesa(){
        $dao = new DespesasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $qtdParcelas = $this->objRequest->qtdParcelas;
        $nroParcelaAtual = $this->objRequest->nroParcelaAtual;        
        $dta = explode('-', $this->objRequest->dtaDespesa);
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        // $dtaLancamento = filter_input(INPUT_POST, 'dtaLancDespesa', FILTER_SANITIZE_STRING);
        // $indDespesaPaga = filter_input(INPUT_POST, 'indDespesaPaga', FILTER_SANITIZE_STRING);
        // $dtaPagamento = filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING);
        // echo isset($this->objRequest->dtaPagamento); die;
        if (isset($this->objRequest->dtaPagamento)==1) {
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

    function UpdateDespesa(){
        $dao = new DespesasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        return json_encode($dao->UpdateDespesa($this->objRequest));
    }

    function DeletarDespesa(){
        $dao = new DespesasDao();
        $result = $dao->PegaDespesaPai();

        return json_encode($dao->DeletarDespesa($result[1][0]['COD_DESPESA_IMPORTACAO']));
    }
    
    Function ListarDespesas(){
        $dao = new DespesasDao();
        $codCliente = $_SESSION['cod_cliente_final'];
        // if ($_SESSION['cod_perfil']==3) {
        //     $codCliente = filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        // }
        $lista = $dao->ListarDespesas($codCliente);
        if($lista[0] && $lista[1] != null) {
            $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_DESPESA|DTA_LANC_DESPESA|DTA_PAGAMENTO', 'DTA_DESPESA_FORMATADO|DTA_LANC_DESPESA_FORMATADO|DTA_PAGAMENTO_FORMATADO');
            $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_DESPESA');
            $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_DESPESA_PAGA', 'PAGO');
            // $total = count($lista[1]);
            // for($i=0;$i<$total;$i++) {
            //     $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            // }
        }
        return json_encode($lista);
    }
    
    Function ListarDespesasGrid(){
        $dao = new DespesasDao();
        $lista = $dao->ListarDespesas($_SESSION['cod_cliente_final']);
        $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_DESPESA|DTA_LANC_DESPESA|DTA_PAGAMENTO', 'DTA_DESPESA_FORMATADO|DTA_LANC_DESPESA_FORMATADO|DTA_PAGAMENTO_FORMATADO');
        $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_DESPESA');
        $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_DESPESA_PAGA', 'PAGO');
        
        for($i=0;$i<count($lista[1]);$i++) {
            $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            // $lista[1][$i]['DTA_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_DESPESA']);
            // $lista[1][$i]['DTA_LANC_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_LANC_DESPESA']);
            // $lista[1][$i]['DTA_PAGAMENTO'] = $this->ConverteDataBanco($lista[1][$i]['DTA_PAGAMENTO']);
            // $lista[1][$i]['VLR_DESPESA'] = number_format($lista[1][$i]['VLR_DESPESA'],2,'.','');
        }        
        return json_encode($lista[1]);
    }

    function ImportarDespesas(){
        $dao = new DespesasDao();
        // $strDtaDespesa = filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING);  
        $codigos = filter_input(INPUT_POST, 'codDespesas', FILTER_SANITIZE_STRING); 
        $nroAno = filter_input(INPUT_POST, 'anosRef', FILTER_SANITIZE_STRING); 
        $nroMes = filter_input(INPUT_POST, 'mesRef', FILTER_SANITIZE_STRING); 
        
        $arrCodigos = explode("d", $codigos);
        // $arrDtaDespesa = explode(";", $strDtaDespesa);
        // $dtaAtual = $dao->GetDataAtual();
        for($i=0; $i < count($arrCodigos); $i++) {
            $dtaDespesa = $nroAno.'-'.$nroMes.'-01';
            $despesaRef = $dao->GetDespesaById($arrCodigos[$i]);
            if($despesaRef[0] && count($despesaRef[1]) > 0){
                $dtaDespesaRef = $despesaRef[1][0]['DTA_DESPESA'];
                $data = explode("-", $dtaDespesaRef);
                $dtaDespesa = $nroAno.'-'.$nroMes.'-'.$data[2];
            }
            $codigoRef = $arrCodigos[$i];
            // $dtaDespesa = $data[0].'/'.$nroMes.'/'.$nroAno;
            $lista = $dao->ImportarDespesas($codigoRef, $dtaDespesa, $_SESSION['cod_cliente_final']);
            // $ultimoCodigo++;
        }
        return json_encode($lista);
    }

    // Function PegaLimiteTipoDespesa(){
    //     $dao = new DespesasDao();
    //     $lista = $dao->PegaLimiteTipoDespesa($_SESSION['cod_cliente_final']);
    //     $total = count($lista);
    //     $i=0;
    //     $data = array();
    //     while($i<$total ) {
    //         $data[] = array(
    //             'vlrLimite' => number_format($lista[$i]['VLR_LIMITE'],2,',','.'),
    //             'vlrPiso' => number_format($lista[$i]['VLR_PISO'],2,',','.'),
    //             'vlrTeto' => number_format($lista[$i]['VLR_TETO'],2,',','.')
    //         );
    //         $i++;
    //     }
    //     if (empty($data)){
    //         $data[] = array(
    //             'value' => '',
    //             'label' => 'Sem dados para a pesquisa',
    //             'id' => 0
    //         );
    //     }
    //     return json_encode($data);
    // }

    function ListarAnosFiltro() {
        $nroAno = date("Y")+1;
        $result = [true, []];
        for($i=2012; $i<=$nroAno; $i++) {
            $ref = (object) array('ID' => $i, 'DSC' => $i);
            array_push($result[1], $ref);
        }
        return json_encode($result);
    }

    function ListarMesesFiltro() {
        $result = [true, []];
        $meses = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
        "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"];
        for($i= 0; $i < count($meses); $i++) {
            $ref = (object) array('ID' => $i+1, 'DSC' => $meses[$i]);
            array_push($result[1], $ref);
        }
        return json_encode($result);
    }
    
    Public Function QuitarParcelas(){
        $dao = new DespesasDao();
        $codDespesa = filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_NUMBER_INT);
        $result = $dao->PegaDespesaFilha($codDespesa);
        while ($result[1]!=NULL){
            $dao->DeletarDespesaFilha($result[1][0]['COD_DESPESA']);
            $result = $dao->PegaDespesaFilha($result[1][0]['COD_DESPESA']);
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
}
?>
