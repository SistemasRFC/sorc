<?php
include_once("../Dao/BaseDao.php");
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

    function ListarResponsavelFiltro($codClienteFinal) {
        $sql = "SELECT COD_USUARIO as ID,
                       NME_USUARIO_COMPLETO as DSC
                  FROM SE_USUARIO
                 WHERE COD_CLIENTE_FINAL = $codClienteFinal";
        return $this->selectDB($sql, false);
    }
}
?>
