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
			$sql_localiza = " SELECT DSC_MENU,
        				       M.COD_MENU,
        				       CONCAT($path, '/Controller/', NME_CONTROLLER) AS NME_CONTROLLER,
        				       NME_METHOD,
        				       NME_USUARIO_COMPLETO,
        				       M.COD_MENU_PAI
        				  FROM SE_MENU_NOVO M
        				 INNER JOIN SE_MENU_NOVO_PERFIL MP
        				    ON M.COD_MENU = MP.COD_MENU
        				 INNER JOIN SE_USUARIO U
        				    ON MP.COD_PERFIL_W = U.COD_PERFIL_W
        				 WHERE COD_USUARIO = $codUsuario
						   AND M.IND_ATIVO = 'S'
        				   AND M.COD_MENU_PAI = $codMenuPai
        				 ORDER BY DSC_MENU";
			//echo $sql_localiza; exit;
			$rs_localiza = $this->selectDB("$sql_localiza", false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs_localiza;
	}

	public function CarregaMenuNew($codUsuario)
	{
		try {
			$sql = " SELECT DSC_MENU,
							M.COD_MENU,
							NME_CONTROLLER,
							NME_METHOD,
							NME_USUARIO_COMPLETO,
							M.COD_MENU_PAI
					   FROM SE_MENU_NOVO M
				 INNER JOIN SE_MENU_NOVO_PERFIL MNP
					     ON M.COD_MENU = MNP.COD_MENU
				 INNER JOIN SE_USUARIO U
					     ON MNP.COD_PERFIL_W = U.COD_PERFIL_W
					  WHERE COD_USUARIO = $codUsuario
					    AND M.IND_ATIVO = 'S'
				   ORDER BY DSC_MENU";
			//  echo $sql_localiza; exit;
			$rs_localiza = $this->selectDB($sql, false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs_localiza;
	}

	public function CarregaController($codMenu, $path)
	{
		try {
			$sql = " SELECT NME_CONTROLLER,
            		        NME_METHOD
            		   FROM SE_MENU_NOVO M
            		  WHERE M.COD_MENU = $codMenu";
			//echo $sql; exit;
			$rs = $this->selectDB("$sql");
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs;
	}

	function CarregaAtalhos($codUsuario) {
		try {
			$sql = " SELECT DSC_MENU,
         			        M.COD_MENU,
         			        NME_CONTROLLER,
         			        NME_METHOD,
         			        NME_USUARIO_COMPLETO,
         			        M.COD_MENU_PAI,
         			        M.DSC_ICONE_ATALHO
         			   FROM SE_MENU_NOVO M
         	  	 INNER JOIN SE_MENU_NOVO_PERFIL MNP
         			     ON M.COD_MENU = MNP.COD_MENU
         		 INNER JOIN SE_USUARIO U
         			     ON MNP.COD_PERFIL_W = U.COD_PERFIL_W
         			  WHERE COD_USUARIO = $codUsuario
         			    AND M.IND_ATIVO = 'S'
         			    AND M.IND_ATALHO = 'S'
         			  ORDER BY DSC_MENU";
			$rs = $this->selectDB("$sql", false);
		} catch (Exception $e) {
			echo "erro" . $e;
		}
		return $rs;
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
						(SELECT COALESCE(SUM(VLR_RECEITA),0) AS VLR_RECEITA FROM EN_RECEITA ER
						  WHERE ER.COD_CLIENTE_FINAL = $codClienteFinal
							AND MONTH(DTA_RECEITA) = MESES.NRO_MES
							AND YEAR(DTA_RECEITA)=$anoAtual) AS VLR_RECEITA,
						(SELECT COALESCE(SUM(VLR_DESPESA),0) AS VLR_DESPESA FROM EN_DESPESA ED 
						  WHERE DTA_PAGAMENTO IS NOT NULL
							AND ED.COD_CLIENTE_FINAL = $codClienteFinal
							AND MONTH(DTA_DESPESA) = MESES.NRO_MES
							AND YEAR(DTA_DESPESA)=$anoAtual) AS VLR_DESPESA,
						(SELECT COALESCE(SUM(VLR_DESPESA),0) AS VLR_DESPESA FROM EN_DESPESA EDA 
						  WHERE DTA_PAGAMENTO IS NULL
							AND EDA.COD_CLIENTE_FINAL = $codClienteFinal
							AND MONTH(DTA_DESPESA) = MESES.NRO_MES
							AND YEAR(DTA_DESPESA)=$anoAtual) AS VLR_DESPESA_ABERTA
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
						 SELECT 12 NRO_MES, 'DEZEMBRO' DSC_MES) AS MESES
				ORDER BY MESES.NRO_MES";
		return $this->selectDB($sql, false);
	}
}
