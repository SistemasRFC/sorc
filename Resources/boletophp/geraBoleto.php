<?
include_once "../ArquivosGerais/SQLServer.php";
ob_start();
//INICIALIZA A SESSÃO
session_start();
if (!isset($_SESSION['codUsuario'])){
  header("Location: ../Index.php");
}
$usuario=$_SESSION['codUsuario'];
$cliente=$_SESSION['codCliente'];
$obj = new SQLServer();
$obj->conectar();

$sql_data = "
SELECT GETDATE() AS DATA";
$result_data = mssql_query("$sql_data") or die("Erro ao executar a Query"."<br>".mssql_get_last_message());
$rs_data=mssql_fetch_array($result_data);

$sql_boletos = "SELECT CONVERT(VARCHAR(10), DTA_BOLETO, 103) AS DTA_BOLETO,
                       DTA_BOLETO AS DATA
                  FROM EN_PAGAMENTO
								 WHERE DTA_PAGAMENTO ISNULL
								 ORDER DATA DESC";
$result_boletos = mssql_query("$sql_boletos");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Geração de Boletos</title>
<style type="text/css">
<!--
.style1 {font-size: 24px}
-->
</style>
</head>

<body>
<form name="GeraBoleto" method="post">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="style1">Boletos Pendentes</p>
<table width="6%" height="6%" align="center" cellpadding="0" cellspacing="0">
  <tr>
	  <td width="95%" height="100%">Data</td>
	  <td width="5%"></br></td>		
	</tr>
<?
while ($rs_boleto = mssql_fetch_array($result_boletos)){
  echo "<tr>
	        <td>".$rs_boleto['DTA_BOLETO']."</td>
					<td><a href=\"../boletophp/boleto_itau.php?dtaBoleto=".$rs_boleto['DTA_BOLETO']."&vlrBoleto=".$rs_boleto['VLR_BOLETO'].">Gerar Boleto</a></td>
				</tr>";
}
?>
</table>
</form>
</body>
</html>
