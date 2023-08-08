<?php
include_once("Dao/Login/LoginDao.php");
class LoginModel extends BaseModel
{
    /**
     * Encripta a senha e verifica se o login existe
     * @param type $nmeLogin
     * @param type $txtSenha
     * @return type
     */
    function Logar(){
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
                $logar[1]['mensagem'] = "Usuário não encontrado. Verique Login e Senha e tente novamente.";
            }
        }

        return json_encode($logar);
    }

    function AlteraSenha(){
        $dao = new LoginDao();
        BaseModel::PopulaObjetoComRequest($dao->getColumns());
        $this->objRequest->codUsuario = $_SESSION['cod_usuario'];
        $this->objRequest->txtSenhaNova = base64_encode(filter_input(INPUT_POST, 'txtNova', FILTER_SANITIZE_STRING));
        $result = $this->VerificaSenhaAtual();
        if ($result[0]){
            $result = $dao->AlteraSenha($this->objRequest);
            if ($result[0]) {
                if ($result[1] == 'sucesso') {
                    $result[1] = [];
                    $result[1]['mensagem'] = 'Senha Alterada!';
                    $result[1]['DSC_PAGINA'] = 'MenuPrincipal';
                    $result[1]['NME_METHOD'] = 'CarregaMenu';
                }
            } else {
                $result[1]['mensagem'] = 'Erro ao alterar a senha!';
            }
        }
        return json_encode($result);
    }
    
    Public Function VerificaSenhaAtual(){
        $dao = new LoginDao();
        $verifica = $dao->VerificaSenhaAtual($this->objRequest);
        if ($verifica[0]){
            if ($verifica[1][0]['QTD'] == 0) {
                $verifica[0] = false;
                $verifica[1]['mensagem'] = 'Senha atual não confere!';
                return $verifica;
            }
        }else {
            $verifica[1]['mensagem'] = 'Problema ao executar a consulta!';
            return $verifica;
        }
        return [true, 'ok'];
    }

    function AtualizaCliente(){
        $codCliente = filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        if ($codCliente!=-1){
            $_SESSION['cod_cliente_final_old']=$_SESSION['cod_cliente_final'];
            $_SESSION['cod_cliente_final']= filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        }else{
            $_SESSION['cod_cliente_final']=$_SESSION['cod_cliente_final_old'];
            $_SESSION['cod_cliente_final_old']= filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT);
        }
    }
}
?>
