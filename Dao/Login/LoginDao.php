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

	function Logar(stdClass $obj)
	{
		$sql = " SELECT COD_USUARIO,
						COD_PERFIL_W,
						U.COD_CLIENTE_FINAL
				   FROM SE_USUARIO U
			 INNER JOIN EN_CLIENTE_FINAL C
					 ON U.COD_CLIENTE_FINAL = C.COD_CLIENTE_FINAL
				  WHERE NME_USUARIO = '$obj->nmeUsuario'
					AND TXT_SENHA_W = '$obj->txtSenhaW'";
		return $this->selectDB($sql, false);
	}

	function CarregaMenu($codUsuario, $codMenuPai, $path)
	{
		try {
			$sql = "SELECT DSC_MENU_W,
						   M.COD_MENU_W,
						   '" . $path . "'+'/Controller/'+NME_CONTROLLER AS NME_CONTROLLER,
						   NME_METHOD,
						   NME_USUARIO_COMPLETO,
						   M.COD_MENU_PAI_W,
						   TXT_SENHA_W
					  FROM SE_MENU M
				INNER JOIN SE_MENU_PERFIL MP
						ON M.COD_MENU_W = MP.COD_MENU_W
				INNER JOIN SE_USUARIO U
						ON MP.COD_PERFIL_W = U.COD_PERFIL_W
					 WHERE COD_USUARIO = " . $codUsuario . " AND IND_MENU_ATIVO_W = 'S'
					   AND M.COD_MENU_PAI_W = '$codMenuPai'
				  ORDER BY DSC_MENU_W";
			$rs = $this->selectDB("$sql", false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs;
	}

	function AlteraSenha(stdClass $obj)
	{
		$sql = "UPDATE SE_USUARIO
				   SET TXT_SENHA_W = '" . $obj->txtSenhaNova . "'
				 WHERE COD_USUARIO = " . $obj->codUsuario;
		return $this->insertDB($sql);
	}

	function VerificaSenhaAtual(stdClass $obj)
	{
		$sql = "SELECT COUNT(COD_USUARIO) AS QTD
              	  FROM SE_USUARIO
             	 WHERE COD_USUARIO = " . $obj->codUsuario . "
               	   AND TXT_SENHA_W   = '" . $obj->txtSenhaW . "'";
		return $this->selectDB($sql, false);
	}
}
