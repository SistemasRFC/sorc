<?php
include_once("Dao/BaseDao.php");
class LoginDao extends BaseDao
{
    protected $tableName = "SE_USUARIO";

    protected $columns = array(
      "nmeUsuario"          => array("column" => "NME_USUARIO", "typeColumn" => "S"),
      "nmeUsuarioCompleto"  => array("column" => "NME_USUARIO_COMPLETO", "typeColumn" => "S"),
      "txtSenhaW"           => array("column" => "TXT_SENHA_W", "typeColumn" => "P"),
      "txtEmail"            => array("column" => "TXT_EMAIL", "typeColumn" => "S"),
      "codPerfilW"          => array("column" => "COD_PERFIL_W", "typeColumn" => "I"),
      "codClienteFinal"     => array("column" => "COD_CLIENTE_FINAL", "typeColumn" => "I"),
      "indAtivo"            => array("column" => "IND_ATIVO", "typeColumn" => "S"),
      "codUsuarioPai"       => array("column" => "COD_USUARIO_PAI", "typeColumn" => "I"),
      "dscLogin"            => array("column" => "DSC_LOGIN", "typeColumn" => "S"),
      "nroCpf"              => array("column" => "NRO_CPF", "typeColumn" => "S")
    );

    protected $columnKey = array("codUsuario" => array("column" => "COD_USUARIO", "typeColumn" => "I"));

    Public Function Logar($nmeLogin, $txtSenha){
        $sql = " SELECT COD_USUARIO,
                        COD_PERFIL_W,
                        U.COD_CLIENTE_FINAL,
                        '".session_id()."' AS 'SESSAO'
                   FROM SE_USUARIO U
             INNER JOIN EN_CLIENTE_FINAL C
                     ON U.COD_CLIENTE_FINAL = C.COD_CLIENTE_FINAL
                  WHERE NME_USUARIO = '$nmeLogin'
                    AND TXT_SENHA_W='$txtSenha'"; 
        return $this->selectDB($sql, false);
    }

}
?>
