<?php
include_once("Model/BaseModel.php");
include_once("Dao/Receitas/ReceitasDao.php");
include_once("Resources/php/FuncoesArray.php");
include_once("Resources/php/FuncoesData.php");
include_once("Resources/php/FuncoesMoeda.php");
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
        if ($lista[0] && $lista[1]!=null && count($lista[1]) > 0){
            $lista = FuncoesData::AtualizaDataInArrayCamposNovos($lista, 'DTA_RECEITA', 'DTA_RECEITA_FORMATADA');
            $lista = FuncoesMoeda::FormataMoedaInArray($lista, 'VLR_RECEITA');
        }
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

        // $mes = filter_input(INPUT_POST, 'dtaReceita', FILTER_SANITIZE_STRING);  
        // $codigo = filter_input(INPUT_POST, 'codReceita', FILTER_SANITIZE_STRING); 
        // $mes = explode('/', $mes);
        // $mesAtual = date("m");
        // $anoAtual = date("Y");
        // if ($mes[1]==$mesAtual){
        //     $lista[0]=false;
        //     $lista[1]="Esta receita pertence a este mês já!";
        // }else{
        //     if ($mes[1]==12){
        //         $mes[1]='01';
        //         $mes[2]=$mes[2]+1;
        //     }else{
        //         $mes[1]=$mes[1]+1;
        //     }
        //     if ($mes[1]<10){
        //         $mes[1]='0'.$mes[1];
        //     }
        //     $data = $mes[0].'/'.$mesAtual.'/'.$anoAtual;
        //     $dao = new ReceitasDao();
        //     $ret = $dao->VerificaReceita($codigo);
        //     if ($ret[0]){
        //         if ($ret[1][0]['QTD']>0){
        //             $lista[0]=false;
        //             $lista[1]='Esta receita já foi importada para este mês';
        //         }else{
        //             $lista = $dao->ImportarReceita($_SESSION['cod_cliente_final'],
        //                                       $data,
        //                                       $codigo);
        //         }
        //     }else{
        //         $lista=$ret;
        //     }
            
        // }
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
