<?php
include_once("Model/BaseModel.php");
include_once("Dao/Receitas/ReceitasDao.php");
class ReceitasModel extends BaseModel {

    function AddReceitas(){
        $dao = new ReceitasDao();
        return json_encode($dao->AddReceitas($_SESSION['cod_cliente_final']));
    }

    function UpdateReceitas(){
        $dao = new ReceitasDao();
        return json_encode($dao->UpdateReceitas());
    }

    function DeletarReceita(){
        $dao = new ReceitasDao();
        return json_encode($dao->DeletarReceita());
    }

    Function ListarReceitas($Json=true){
        $dao = new ReceitasDao();
        $lista = $dao->ListarReceitas($_SESSION['cod_cliente_final']);
        if ($lista[0]){
            $lista = BaseModel::AtualizaDataInArray($lista, 'DTA_RECEITA');
        }
        if ($Json){
            $lista = json_encode($lista);
        }
        return $lista;
    }

    function ImportarReceita(){
        $mes = filter_input(INPUT_POST, 'dtaReceita', FILTER_SANITIZE_STRING);  
        $codigo = filter_input(INPUT_POST, 'codReceita', FILTER_SANITIZE_STRING); 
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
            $dao = new ReceitasDao();
            $ret = $dao->VerificaReceita($codigo);
            if ($ret[0]){
                if ($ret[1][0]['QTD']>0){
                    $lista[0]=false;
                    $lista[1]='Esta despesa já foi importada para este mês';
                }else{
                    $lista = $dao->ImportarReceita($_SESSION['cod_cliente_final'],
                                              $data,
                                              $codigo);
                }
            }else{
                $lista=$ret;
            }
            
        }
        return json_encode($lista);
    }

}
?>
