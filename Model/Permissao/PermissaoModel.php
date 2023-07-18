<?php
include_once("Model/BaseModel.php");
include_once("Dao/Permissao/PermissaoDao.php");
class PermissaoModel extends BaseModel {

    function ListarMenusPerfil($json=false){
        $dao = new PermissaoDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $lista = $dao->ListarMenusPerfil($this->objRequest);
        if ($json){
            return json_encode($lista);
        }else{
            return $lista;
        }
    }

    function AtualizaPermissoes(){
        $dao = new PermissaoDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $atualizado = $dao->RemovePermissoes($this->objRequest->codPerfilW);
        $array = explode("P", $_POST['listaUpdate']);
        for ($i=0;$i<count($array)-1;$i++){
            $registro=explode('=>',$array[$i]);            
            if ($registro[1]=='S'){
                $atualizado = $dao->AddPermissao($_POST['codPerfilW'], $registro[0]);
            }
        }
        return json_encode($atualizado);

        // $dao = new PermissaoDao();        
        // $dao->RemovePermissoes('0');
        // $array = explode("|", $_POST['C']);
        // for ($i=0;$i<count($array)-1;$i++){
        //     $registro=explode(';',$array[$i]);            
        //     if ($registro[1]=='S'){
        //         $atualizado = $dao->AddPermissao($registro[0]);
        //     }else{
        //         $atualizado = $dao->RemovePermissoes($registro[0]);
        //     }
        // }
        // return json_encode($atualizado);
    }
}
?>
