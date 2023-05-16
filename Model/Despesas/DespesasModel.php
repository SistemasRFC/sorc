<?php
include_once("../../Model/BaseModel.php");
include_once("../../Dao/Despesas/DespesasDao.php");
class DespesaModel extends BaseModel
{
    function DespesaModel(){
        If (!isset($_SESSION)){
            ob_start();
            session_start();
        }
    }
    
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

    function ImportarDespesa(){
        $dtaDespesa = filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING);  
        $codigo = filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_STRING); 
        
        $dao = new DespesasDao();
        $lista = $dao->ImportarDespesa($_SESSION['cod_cliente_final'],
                                  $dtaDespesa,
                                  $codigo);
        
        return json_encode($lista);
    }

    function UpdateDespesa(){
        $dao = new DespesasDao();
        return json_encode($dao->UpdateDespesa($_SESSION['cod_cliente_final']));
    }

    function DeletarDespesa(){
        $dao = new DespesasDao();
        $result = $dao->PegaDespesaPai();

        return json_encode($dao->DeletarDespesa($result[1][0]['COD_DESPESA_IMPORTACAO']));
    }
    
    Function ListarDespesas(){
        $dao = new DespesasDao();
        $codCliente = $_SESSION['cod_cliente_final'];
        if ($_SESSION['cod_perfil']==3){
            $codCliente = filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        }
        $lista = $dao->ListarDespesas($codCliente);
        
        for($i=0;$i<count($lista[1]);$i++) {
            $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            $lista[1][$i]['DTA_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_DESPESA']);
            $lista[1][$i]['DTA_LANC_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_LANC_DESPESA']);
            $lista[1][$i]['DTA_PAGAMENTO'] = $this->ConverteDataBanco($lista[1][$i]['DTA_PAGAMENTO']);
            $lista[1][$i]['VLR_DESPESA'] = number_format($lista[1][$i]['VLR_DESPESA'],2,'.','');
        }        
        return json_encode($lista);
    }
    
    Function ListarDespesasGrid(){
        $dao = new DespesasDao();
        $lista = $dao->ListarDespesas($_SESSION['cod_cliente_final']);
        
        for($i=0;$i<count($lista[1]);$i++) {
            $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            $lista[1][$i]['DTA_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_DESPESA']);
            $lista[1][$i]['DTA_LANC_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_LANC_DESPESA']);
            $lista[1][$i]['DTA_PAGAMENTO'] = $this->ConverteDataBanco($lista[1][$i]['DTA_PAGAMENTO']);
            $lista[1][$i]['VLR_DESPESA'] = number_format($lista[1][$i]['VLR_DESPESA'],2,'.','');
        }        
        return json_encode($lista[1]);
    }

    Function ListarSomaTipoDespesas(){
        $dao = new DespesasDao();
        $mes = filter_input(INPUT_POST, 'nroMesReferencia', FILTER_SANITIZE_STRING);
        $ano = filter_input(INPUT_POST, 'nroAnoReferencia', FILTER_SANITIZE_STRING);
        if ($mes==''){
            $mes=date('m');
        }
        if ($ano==''){
            $ano=date('Y');
        }        
        $lista = $dao->ListarSomaTipoDespesas($_SESSION['cod_cliente_final'], $mes, $ano);
        for($i=0;$i<count($lista[1]);$i++) {
            $lista[1][$i]['VALOR'] = number_format($lista[1][$i]['VALOR'],2,'.','');
        }
        return json_encode($lista);
    }

    Function PegaLimiteTipoDespesa(){
        $dao = new DespesasDao();
        $lista = $dao->PegaLimiteTipoDespesa($_SESSION['cod_cliente_final']);
        $total = count($lista);
        $i=0;
        $data = array();
        while($i<$total ) {
            $data[] = array(
                'vlrLimite' => number_format($lista[$i]['VLR_LIMITE'],2,',','.'),
                'vlrPiso' => number_format($lista[$i]['VLR_PISO'],2,',','.'),
                'vlrTeto' => number_format($lista[$i]['VLR_TETO'],2,',','.')
            );
            $i++;
        }
        if (empty($data)){
            $data[] = array(
                'value' => '',
                'label' => 'Sem dados para a pesquisa',
                'id' => 0
            );
        }
        return json_encode($data);
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
