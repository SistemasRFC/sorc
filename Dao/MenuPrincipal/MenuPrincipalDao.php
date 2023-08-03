<?php
include_once("Dao/BaseDao.php");
class MenuPrincipalDao extends BaseDao
{
	function CarregaMenu(
		$codUsuario,
		$codMenuPai,
		$path
	) {
		try {
			$sql_localiza = "
        SELECT DSC_MENU_W,
               m.COD_MENU_W,
               CONCAT('" . $path . "','/Controller/',NME_CONTROLLER) AS NME_CONTROLLER,
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
			//echo $sql_localiza; exit;
			$rs_localiza = $this->selectDB("$sql_localiza", false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs_localiza;
	}

	public function CarregaMenuNew($codUsuario, $path)
	{
		try {
			$sql_localiza = "
            SELECT DSC_MENU_W,
                   m.COD_MENU_W,                   
                   NME_CONTROLLER,
                   CONCAT('" . $path . "','/Controller/',NME_CONTROLLER) AS NME_PATH,
                   NME_METHOD,
                   NME_USUARIO_COMPLETO,
                   M.COD_MENU_PAI_W,
                   TXT_SENHA_W,
                   '250px' AS VLR_TAMANHO_SUBMENU
              FROM SE_MENU M
             INNER JOIN SE_MENU_PERFIL MP
                ON M.COD_MENU_W = MP.COD_MENU_W
             INNER JOIN SE_USUARIO U
                ON MP.COD_PERFIL_W = U.COD_PERFIL_W
             WHERE COD_USUARIO = " . $codUsuario . " AND IND_MENU_ATIVO_W = 'S'
             ORDER BY DSC_MENU_W";
			//  echo $sql_localiza; exit;
			$rs_localiza = $this->selectDB("$sql_localiza", false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs_localiza;
	}

	public function CarregaController($codMenu, $path)
	{
		try {
			$sql_localiza = "
            SELECT NME_CONTROLLER,
                   NME_METHOD
              FROM SE_MENU M
             WHERE M.COD_MENU_W = $codMenu";
			//echo $sql_localiza; exit;
			$rs_localiza = $this->selectDB("$sql_localiza");
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs_localiza;
	}

	function CarregaAtalhos(
		$codUsuario,
		$path
	) {
		try {
			$sql_localiza = "
        SELECT DSC_MENU_W,
               m.COD_MENU_W,
               --CONCAT('" . $path . "','/Controller/',NME_CONTROLLER) AS NME_CONTROLLER,
               NME_CONTROLLER,
               NME_METHOD,
               NME_USUARIO_COMPLETO,
               M.COD_MENU_PAI_W,
               M.DSC_CAMINHO_IMAGEM,
               TXT_SENHA_W
          FROM SE_MENU M
         INNER JOIN SE_MENU_PERFIL MP
            ON M.COD_MENU_W = MP.COD_MENU_W
         INNER JOIN SE_USUARIO U
            ON MP.COD_PERFIL_W = U.COD_PERFIL_W
         WHERE COD_USUARIO = " . $codUsuario . "
           AND IND_MENU_ATIVO_W = 'S'
           AND M.IND_ATALHO = 'S'
         ORDER BY DSC_MENU_W";
			$rs_localiza = $this->selectDB("$sql_localiza", false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs_localiza;
	}

	public function CarregaDadosUsuario($codUsuario)
	{
		$sql = " SELECT COD_USUARIO,
						NME_USUARIO_COMPLETO,
						DSC_CLIENTE_FINAL,
						U.COD_PERFIL_W
				   FROM SE_USUARIO U
			 INNER JOIN EN_CLIENTE_FINAL C
			 		 ON U.COD_CLIENTE_FINAL = C.COD_CLIENTE_FINAL
				  WHERE U.COD_USUARIO = " . $codUsuario;
		return $this->selectDB($sql, false);
	}

	public function CarregaDespesasReceitasAnoAtual($codClienteFinal, $anoAtual)
	{
		$sql = " SELECT MESES.DSC_MES,
                 		COALESCE(SUM(VLR_RECEITA), 0) AS VLR_RECEITA,
                    	COALESCE(SUM(VLR_DESPESA), 0) AS VLR_DESPESA
                   FROM (SELECT 1 NRO_MES, 'JANEIRO' DSC_MES
                    	  UNION 
						 SELECT 2 NRO_MES, 'FEVEREIRO' DSC_MES
						  UNION 
						 SELECT 3 NRO_MES, 'MARÇO' DSC_MES
						  UNION 
						 SELECT 4 NRO_MES, 'ABRIL' DSC_MES
						  UNION 
						 SELECT 5 NRO_MES, 'MAIO' DSC_MES
						  UNION 
						 SELECT 6 NRO_MES, 'JUNHO' DSC_MES
						  UNION 
						 SELECT 7 NRO_MES, 'JULHO' DSC_MES
						  UNION 
						 SELECT 8 NRO_MES, 'AGOSTO' DSC_MES
						  UNION 
						 SELECT 9 NRO_MES, 'SETEMBRO' DSC_MES
						  UNION 
						 SELECT 10 NRO_MES, 'OUTUBRO' DSC_MES
						  UNION 
						 SELECT 11 NRO_MES, 'NOVEMBRO' DSC_MES
						  UNION 
						 SELECT 12 NRO_MES, 'DEZEMBRO' DSC_MES) MESES
              LEFT JOIN EN_DESPESA ED 
					 ON MESES.NRO_MES = MONTH(ED.DTA_DESPESA)
					AND YEAR(ED.DTA_DESPESA) = $anoAtual
					AND ED.COD_CLIENTE_FINAL = $codClienteFinal
              LEFT JOIN EN_RECEITA ER
			  		 ON MESES.NRO_MES = MONTH(ER.DTA_RECEITA)
					AND YEAR(ER.DTA_RECEITA) = $anoAtual
					AND ER.COD_CLIENTE_FINAL = $codClienteFinal
               GROUP BY MESES.NRO_MES, MESES.DSC_MES";
		return $this->selectDB($sql, false);
	}
}
