<?php
include_once("Dao/BaseDao.php");
class LoginDao extends BaseDao
{

    Public Function Logar($nmeLogin,
                   $txtSenha){
        $sql = " SELECT COD_USUARIO,
                        COD_PERFIL_W,
                        u.COD_CLIENTE_FINAL,
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
