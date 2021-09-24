<?php
include_once("Dao/Login/LoginDao.php");
class LoginModel
{
    Public Function Logar(){
        $nmeLogin = filter_input(INPUT_POST, 'nmeUsuario', FILTER_SANITIZE_MAGIC_QUOTES);
        $txtSenha = filter_input(INPUT_POST, 'txtSenha', FILTER_SANITIZE_MAGIC_QUOTES);
        if (($nmeLogin=="adm")&&($txtSenha=="adm")){
            $senha = $txtSenha;
        }else{           
            $senha = base64_encode($txtSenha);            
        }
        $dao = new LoginDao();
        $logar = $dao->Logar($nmeLogin, $senha);
        
        if ($logar[0]){
            if ($logar[1]!=NULL){
                $result[1][0]['DSC_PAGINA'] = 'MenuPrincipal';
                $result[1][0]['NME_METHOD'] = 'ChamaView';
                if ((int)$logar[1][0]['COD_USUARIO']>0){
                    $codigo = "'".$logar[1][0]['COD_USUARIO']."'";
                    $_SESSION['cod_usuario']=$codigo;
                    $_SESSION['cod_cliente_final']=$logar[1][0]['COD_CLIENTE_FINAL'];
                    $_SESSION['cod_perfil']=$logar[1][0]['COD_PERFIL_W'];
                    if ($txtSenha=='123459'){
                        $result[1][0]['DSC_PAGINA'] = 'MenuPrincipal';
                        $result[1][0]['NME_METHOD'] = 'AlteraSenhaView';
                    }
                }else{
                    $logar[0]=false;
                }
                $logar[1]=$result[1];
            }else{
                $logar[0]=false;
            }
        }
//        var_dump($_SESSION); die;
        return json_encode($logar);
    }
}
?>
