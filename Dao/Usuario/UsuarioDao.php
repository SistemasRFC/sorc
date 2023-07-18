<?php
include_once("Dao/BaseDao.php");
class UsuarioDao extends BaseDao
{
    protected $tableName = "SE_USUARIO";

    protected $columns = array(
      "nmeUsuario"              => array("column" => "NME_USUARIO",          "typeColumn" => "S"),
      "nmeUsuarioCompleto"      => array("column" => "NME_USUARIO_COMPLETO", "typeColumn" => "S"),
      "txtSenhaW"               => array("column" => "TXT_SENHA_W",          "typeColumn" => "P"),
      "txtEmail"                => array("column" => "TXT_EMAIL",            "typeColumn" => "S"),
      "codPerfilW"              => array("column" => "COD_PERFIL_W",         "typeColumn" => "I"),
      "codClienteFinal"         => array("column" => "COD_CLIENTE_FINAL",    "typeColumn" => "I"),
      "indAtivo"                => array("column" => "IND_ATIVO",            "typeColumn" => "S"),
      "codUsuarioPai"           => array("column" => "COD_USUARIO_PAI",      "typeColumn" => "I"),
      "nroCpf"                  => array("column" => "NRO_CPF",              "typeColumn" => "S")
    );

    protected $columnKey = array("codUsuario" => array("column" => "COD_USUARIO", "typeColumn" => "I"));


    function ListarUsuario($codUsuarioPai, $codPerfil, $codClienteFinal){
        $sql = "SELECT DISTINCT U.COD_USUARIO,
                       NME_USUARIO_COMPLETO,
                       NME_USUARIO,
                       U.TXT_EMAIL,
                       U.COD_PERFIL_W,
                       P.DSC_PERFIL_W,
                       U.IND_ATIVO,
                       U.COD_CLIENTE_FINAL,
                       CF.DSC_CLIENTE_FINAL
                  FROM SE_USUARIO U 
            INNER JOIN SE_PERFIL P 
                    ON U.COD_PERFIL_W = P.COD_PERFIL_W
            INNER JOIN EN_CLIENTE_FINAL CF 
                    ON U.COD_CLIENTE_FINAL = CF.COD_CLIENTE_FINAL
              ORDER BY NME_USUARIO_COMPLETO";
        if ($codPerfil !=1 ) {
            $sql = "SELECT DISTINCT U.COD_USUARIO,
                           NME_USUARIO_COMPLETO,
                           NME_USUARIO,
                           U.TXT_EMAIL,
                           U.COD_PERFIL_W,
                           P.DSC_PERFIL_W,
                           u.IND_ATIVO,
                           U.COD_CLIENTE_FINAL
                      FROM SE_USUARIO U 
                INNER JOIN SE_PERFIL P 
                        ON U.COD_PERFIL_W = P.COD_PERFIL_W
                INNER JOIN EN_CLIENTE_FINAL CF 
                        ON U.COD_CLIENTE_FINAL = CF.COD_CLIENTE_FINAL
                     WHERE U.COD_CLIENTE_FINAL = " . $codClienteFinal;
        }
        
        return $this->selectDB($sql, false);
    }
    
    function AddUsuario(stdClass $obj) {
        return $this->MontarInsert($obj);       
        // $codUsuario = $this->CatchUltimoCodigo('SE_USUARIO', 'COD_USUARIO');
        // $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_STRING)));
        // $senha = base64_encode("123459");
        // $codPerfil = $codPerfil==3?1:filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT);
        // $sql_lista = "INSERT INTO SE_USUARIO (
        //                      COD_USUARIO,
        //                      NME_USUARIO,
        //                      NME_USUARIO_COMPLETO,
        //                      TXT_SENHA_W,
        //                      TXT_EMAIL,
        //                      COD_PERFIL_W,
        //                      IND_ATIVO,
        //                      NRO_CPF,
        //                      COD_USUARIO_PAI,
        //                      COD_CLIENTE_FINAL)
        //              VALUES(".$codUsuario.",
        //                     '".filter_input(INPUT_POST, 'nmeLogin', FILTER_SANITIZE_ADD_SLASHES)."',
        //                     '".filter_input(INPUT_POST, 'nmeUsuario', FILTER_SANITIZE_ADD_SLASHES)."',
        //                     '".$senha."',
        //                     '".filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_ADD_SLASHES)."',
        //                     '".$codPerfil."',
        //                     '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
        //                     '".$nroCpf."', ".
        //                     $codUsuarioPai.",
        //                     ".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT).")";
        // $result = $this->insertDB("$sql_lista");
        // if ($result[0]){
        //     $result[1]= $codUsuario;
        // }
        // return $result;
    }
    
    function UpdateUsuario(stdClass $obj) {
        return $this->MontarUpdate($obj);    
        // $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT)));
        // $codPerfil = $codPerfil==3?1:filter_input(INPUT_POST, 'codPerfil', FILTER_SANITIZE_NUMBER_INT);
        // $sql_lista =  "UPDATE SE_USUARIO
        //                   SET NME_USUARIO          = '".filter_input(INPUT_POST, 'nmeLogin', FILTER_SANITIZE_ADD_SLASHES)."',
        //                       NME_USUARIO_COMPLETO = '".filter_input(INPUT_POST, 'nmeUsuario', FILTER_SANITIZE_ADD_SLASHES)."',
        //                       TXT_EMAIL            = '".filter_input(INPUT_POST, 'txtEmail', FILTER_SANITIZE_ADD_SLASHES)."',
        //                       COD_PERFIL_W         = '".$codPerfil."',
        //                       IND_ATIVO            = '".filter_input(INPUT_POST, 'indAtivo', FILTER_SANITIZE_STRING)."',
        //                       COD_CLIENTE_FINAL    = '".filter_input(INPUT_POST, 'codCliente', FILTER_SANITIZE_NUMBER_INT)."'
        //    WHERE COD_USUARIO = ".filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);        
        // $result = $this->insertDB("$sql_lista");        
        // if ($result[0]){
        //     $result[1]=  filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        // }
        // return $result;
    }

    function DeleteUsuario(){        
        $sql_lista = "
        DELETE FROM SE_USUARIO
         WHERE COD_USUARIO = ".filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        $result = $this->insertDB("$sql_lista");
        return $result;
    }

    function ReiniciarSenha(){        
        $senha = base64_encode("123459");
        $sql_lista =  "UPDATE SE_USUARIO
                          SET TXT_SENHA_W          = '".$senha."'
           WHERE COD_USUARIO = ".filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        if ($this->insertDB("$sql_lista")){
            return filter_input(INPUT_POST, 'codUsuario', FILTER_SANITIZE_NUMBER_INT);
        }else{
            return 0;
        }

    }

    Public Function ResetaSenha(){
        $nroCpf = str_replace('-','',str_replace('.', '', filter_input(INPUT_POST, 'nroCpf', FILTER_SANITIZE_NUMBER_INT)));
        $sql = "SELECT COD_USUARIO FROM SE_USUARIO WHERE NRO_CPF = '".$nroCpf."'";
        $rs = $this->selectDB($sql, false);
        if ($rs[0]){
            if ($rs[1][0]['COD_USUARIO']>0){
                $senha = base64_encode("123459");
                $sql_lista =  "UPDATE SE_USUARIO
                                  SET TXT_SENHA_W = '".$senha."'
                   WHERE COD_USUARIO = ".$rs[1][0]['COD_USUARIO'];
                $rs = $this->insertDB("$sql_lista");
            }else{
                $rs[0]=false;
                $rs[1]='CPF n&atilde;o encontrado na base de dados!';
            }
        }
        return $rs;
    }  
}
?>
