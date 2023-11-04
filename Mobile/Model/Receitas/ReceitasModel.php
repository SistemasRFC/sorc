<?php
include_once("Dao/Receitas/ReceitasDao.php");
include_once("../Resources/php/FuncoesData.php");
include_once("../Resources/php/FuncoesMoeda.php");
include_once("../Resources/php/FuncoesArray.php");
class ReceitasModel extends BaseModel {

    function AddReceitas(){
        $dao = new ReceitasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->codClienteFinal = $_SESSION['cod_cliente_final'];
        return json_encode($dao->AddReceitas($this->objRequest));
    }

    function UpdateReceitas(){
        $dao = new ReceitasDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        return json_encode($dao->UpdateReceitas($this->objRequest));
    }

    function DeletarReceita(){
        $dao = new ReceitasDao();
        return json_encode($dao->DeletarReceita());
    }

    Function ListarReceitas($Json=true){
        $dao = new ReceitasDao();
        $lista = $dao->ListarReceitas($_SESSION['cod_cliente_final']);
        $vlrTotal = 0;
        if($lista[0] && $lista[1] != null && count($lista[1]) > 0) {
            for($i=0;$i<count($lista[1]);$i++) {
                $vlrTotal += $lista[1][$i]['VLR_RECEITA'];
                $lista[1][$i]['DSC_RECEITA'] = strtoupper($lista[1][$i]['DSC_RECEITA']);
            }

            $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_RECEITA', 'DTA_RECEITA_FORMATADA');
            $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_RECEITA');
        }
        $lista[2]['VLR_TOTAL'] = number_format($vlrTotal, 2, '.', '');

        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }

    function ImportarReceitas(){
        $dao = new ReceitasDao();
        $codigos = filter_input(INPUT_POST, 'codReceitas', FILTER_SANITIZE_STRING); 
        $nroAno = filter_input(INPUT_POST, 'anoRef', FILTER_SANITIZE_STRING); 
        $nroMes = filter_input(INPUT_POST, 'mesRef', FILTER_SANITIZE_STRING); 
        $arrCodigos = explode("r", $codigos);

        for($i=0; $i < count($arrCodigos); $i++) {
            $dtaReceita = $nroAno.'-'.$nroMes.'-01';
            $receitaRef = $dao->GetReceitaById($arrCodigos[$i]);
            if($receitaRef[0] && count($receitaRef[1]) > 0){
                $dtaReceitaRef = $receitaRef[1][0]['DTA_RECEITA'];
                $data = explode("-", $dtaReceitaRef);
                $dtaReceita = $nroAno.'-'.$nroMes.'-'.$data[2];
            }
            $codigoRef = $arrCodigos[$i];
            $lista = $dao->ImportarReceita($_SESSION['cod_cliente_final'], $dtaReceita, $codigoRef);
        }
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
