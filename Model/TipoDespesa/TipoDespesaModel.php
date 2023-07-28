<?php
include_once("Model/BaseModel.php");
include_once("Dao/TipoDespesa/TipoDespesaDao.php");
include_once("Resources/php/FuncoesArray.php");
include_once("Resources/php/FuncoesMoeda.php");
class TipoDespesaModel extends BaseModel
{
    function AddTipoDespesa($Json=true){
        $dao = new TiposDespesaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        $lista = $dao->AddTipoDespesa($this->objRequest);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }

    function UpdateTipoDespesa($Json=true){
        $dao = new TiposDespesaDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        $lista = $dao->UpdateTipoDespesa($this->objRequest);
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }
    
    Function ListarTiposDespesas($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesas($_SESSION['cod_cliente_final']);
        $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO|IND_INVESTIMENTO' , 'ATIVO|INVESTIMENTO');
        if ($Json){
            // var_dump($lista); die;
            return json_encode($lista);
        }
        return $lista;                
    }
    
    Function ListarTiposDespesasAtivos($Json=true){
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesasAtivos($_SESSION['cod_cliente_final']);
        $lista = FuncoesArray::AtualizaBooleanInArray($lista, 'IND_ATIVO|IND_INVESTIMENTO' , 'ATIVO|INVESTIMENTO');
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;                
    }
    
    function ListarTiposDespesaFiltro() {
        $dao = new TiposDespesaDao();
        $lista = $dao->ListarTiposDespesaFiltro($_SESSION['cod_cliente_final']);
        return $lista = json_encode($lista);              
    }
    
    Function ListarSomaTipoDespesas(){
        $dao = new TiposDespesaDao();
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
}
?>
