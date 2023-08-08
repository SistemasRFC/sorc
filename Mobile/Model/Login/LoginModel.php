<?php
include_once("Dao/Login/LoginDao.php");
class LoginModel extends BaseModel
{
    Public Function Logar(){
        $dao = new LoginDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $logar = $dao->Logar($this->objRequest);
        if ($logar[0]) {
            if ($logar[1] != NULL) {
                $logar[2]['redirecionaInicio'] = true;
                if ($logar[1][0]['COD_USUARIO'] > 0) {
                    $codigo = "'".$logar[1][0]['COD_USUARIO']."'";
                    $_SESSION['cod_usuario'] = $codigo;
                    $_SESSION['cod_cliente_final'] = $logar[1][0]['COD_CLIENTE_FINAL'];
                    $_SESSION['cod_perfil'] = $logar[1][0]['COD_PERFIL_W'];
                    if ($this->objRequest->txtSenhaW == base64_encode('123459')) {
                        $logar[2]['redirecionaInicio'] = false;
                    }
                } else {
                    $logar[0]=false;
                }
            } else {
                $logar[0]=false;
                $logar[1]="Usuário não encontrado. Verique Login e Senha e tente novamente.";
            }
        }

        return json_encode($logar);
    }
}
?>
