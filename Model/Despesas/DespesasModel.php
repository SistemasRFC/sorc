<?
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
        $indDespesaPaga = filter_input(INPUT_POST, 'indDespesaPaga', FILTER_SANITIZE_STRING);
        $dtaPagamento = filter_input(INPUT_POST, 'dtaPagamento', FILTER_SANITIZE_STRING);
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
            $result = $dao->AddDespesa($_SESSION['cod_cliente_final'], $dtaDespesa, $indDespesaPaga, $dtaPagamento, $nroParcelaAtual, $codDespesaImportada);
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
        $mes = filter_input(INPUT_POST, 'dtaDespesa', FILTER_SANITIZE_STRING);  
        $codigo = filter_input(INPUT_POST, 'codDespesa', FILTER_SANITIZE_STRING); 
        $mes = explode('/', $mes);
        $mesAtual = date("m");
        $anoAtual = date("Y");
        if ($mes[1]==$mesAtual){
            $lista[0]=false;
            $lista[1]="Esta despesa pertence a este mês já!";
        }else{
            if ($mes[1]==12){
                $mes[1]='01';
                $mes[2]=$mes[2]+1;
            }else{
                $mes[1]=$mes[1]+1;
            }
            if ($mes[1]<10){
                $mes[1]='0'.$mes[1];
            }
            $data = $mes[0].'/'.$mesAtual.'/'.$anoAtual;
            $dao = new DespesasDao();
            $ret = $dao->VerificaDespesa($codigo);
            if ($ret[0]){
                if ($ret[1][0]['QTD']>0){
                    $lista[0]=false;
                    $lista[1]='Esta despesa já foi importada para este mês';
                }else{
                    $lista = $dao->ImportarDespesa($_SESSION['cod_cliente_final'],
                                              $data,
                                              $codigo);
                }
            }else{
                $lista=$ret;
            }
            
        }
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
        $lista = $dao->ListarDespesas($_SESSION['cod_cliente_final']);
        
        for($i=0;$i<count($lista[1]);$i++) {
            $lista[1][$i]['DSC_DESPESA'] = strtoupper($lista[1][$i]['DSC_DESPESA']);
            $lista[1][$i]['DTA_DESPESA'] = $this->ConverteDataBanco($lista[1][$i]['DTA_DESPESA']);
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
}
?>
