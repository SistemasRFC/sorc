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
if (!isset($insere)){
  $insere="N";
}
if (!isset($dscDepartamento)){
  $dscDepartamento="";
}
if (!isset($mensagem)){
  $mensagem="";
}
if (!isset($ordenacao)){
  $ordenacao="DSC_DEPARTAMENTO";
}
$sql_data = "SELECT CONVERT(VARCHAR(10), GETDATE(), 103) AS DATA_ATUAL,
                    CONVERT(VARCHAR(10), GETDATE(), 108) AS HORA_ATUAL";
$result_data = mssql_query("$sql_data");
$rs_data = mssql_fetch_array($result_data);
$dia = substr($rs_data['DATA_ATUAL'],0,2);
$mes = substr($rs_data['DATA_ATUAL'],3,2);
$ano = substr($rs_data['DATA_ATUAL'],6,4);
$hra = substr($rs_data['HORA_ATUAL'],0,2);
$min = substr($rs_data['HORA_ATUAL'],3,2);			
$nosso_numero = substr($ano,2,2).$mes.$hra.$min;
$sql_insere = " SELECT COD_LOJA,
                       VLR_MENSALIDADE,
											 NRO_DIA_PAGAMENTO
                  FROM EN_LOJA
								 WHERE COD_LOJA NOT IN (
								SELECT COD_LOJA
									FROM EN_PAGAMENTO P
								 WHERE (MONTH(DTA_BOLETO)=$mes
									 AND YEAR(DTA_BOLETO)=$ano))
									 AND COD_CLIENTE = $cliente
									 AND IND_ATIVA = 'S'";
$result_insere = mssql_query("$sql_insere");
$data = $ano.'-'.$mes.'-';

while ($rs_insere = mssql_fetch_array($result_insere)){
	$sql_insert = "
	INSERT INTO EN_PAGAMENTO
	SELECT ".$rs_insere['COD_LOJA'].",
				 '$data'+convert(varchar(2),".$rs_insere['NRO_DIA_PAGAMENTO'].")+' 00:00:00.000',
				 NULL,
				 ".$rs_insere['VLR_MENSALIDADE'].",
				 'S',
				 $nosso_numero";
	//echo $sql_insert;
	mssql_query("$sql_insert");
	$nosso_numero++;
}

$sql_departamentos="
SELECT L.COD_LOJA,
       L.DSC_LOJA,
       CONVERT(VARCHAR(10), P.DTA_BOLETO, 103) AS DTA_BOLETO,
			 DTA_BOLETO AS DATA,
       P.VLR_BOLETO,
			 DTA_PAGAMENTO,
			 NRO_NOSSO_NUMERO
	FROM EN_PAGAMENTO P
 INNER JOIN EN_LOJA L
    ON P.COD_LOJA = L.COD_LOJA
 WHERE COD_CLIENTE = $cliente
 ORDER BY DATA DESC";
$result_departamentos = mssql_query("$sql_departamentos");

?>
<html>

<head>
<title> Pagamentos </title>
<link href="style.css" rel="stylesheet" type="text/css">
<link href="../ArquivosGerais/style.css" rel="stylesheet" type="text/css">
<script src="../ArquivosGerais/JavaScriptRM.js"></script>
<style type="text/css">

ul li a:hover {
	background: #0150D3;
	color: #EEDD82;
	border: #F5F5DC 1px solid;
	border-bottom: 1px #F5F5DC solid;
	text-decoration: none;
	padding: 5px 7px;
	margin: 0px;
	float: left;
	display: inline;
	}
</style>
</head>

<body style="background: #FFFFFF;
	color: #000;
    font-size: 11px;
	font-family: Verdana, sans-serif;
	margin: 0;
    padding: 0;
	text-align: center;
             scrollbar-arrow-color:#EEDD82;
            scrollbar-3dlight-color:#0150D3;
            scrollbar-highlight-color:#0150D3;
            scrollbar-face-color:#0150D3;
            scrollbar-shadow-color:#EEDD82;
            scrollbar-darkshadow-color:#EEDD82;
            scrollbar-track-color:#FFFFF;">
<form name="cadastroDepartamentosForm" method="post">
  <input type="hidden" name="codDepartamento">
  <input type="hidden" name="insere">
  <input type="hidden" value="" name="Ativo">
<?
  echo"<input type=\"hidden\" name=\"ordenacao\" value=\"".$ordenacao."\">";
?>
<table width="100%">
<tr>
<td colspan="2">
<table style="background: #FFFFFF;" width="98%">
  <tr>
  <td style="background: #FFFFFF;">
<?
  include_once "../ArquivosGerais/Cabecalho.php";
?>
  </td>
  </tr>
</table>
</td>
</tr>
<tr>
<td colspan="2">
<table style="background: #FFFFFF;" width="98%">
  <tr>
  <td style="background: #FFFFFF;">
<?
  if ($mensagem!=""){
    echo "<font color=\"#FF0000\">".$mensagem."</font>";
  }
?>
  </td>
  </tr>
</table>
</td>
</tr>
<tr>
<td style="text-align:left;" colspan="2">
<table align="left" width="70%">
  <tr>
    <td style="font-size:20px;
               color:#0150D3;
               text-align:left;
               padding:0px;
               margin:0px;
               border-bottom:1px solid #0150D3;">
      Controle de Boletos
    </td>
  </tr>
</table>
</td>
</tr>
<tr>
<td style="text-align:left;">
  <table width="70%">
  <tr>
  <td style="font-size: 11px;
	font-family: Verdana, sans-serif;
	margin: 0;
    padding: 0;
	text-align: left;
    color:#0150D3;">
     Loja
  </td>
  <td style="font-size: 11px;
	font-family: Verdana, sans-serif;
	margin: 0;
    padding: 0;
	text-align: left;
    color:#0150D3;">
    Data do Boleto
  </td>
<td style="font-size: 11px;
	font-family: Verdana, sans-serif;
	margin: 0;
    padding: 0;
	text-align: left;
    color:#0150D3;">
    Nosso número
  </td>	
  <td style="font-size: 11px;
	font-family: Verdana, sans-serif;
	margin: 0;
    padding: 0;
	text-align: left;
    color:#0150D3;">Valor
  </td>	
  <td style="font-size: 11px;
	font-family: Verdana, sans-serif;
	margin: 0;
    padding: 0;
	text-align: left;
    color:#0150D3;">Emitir
  </td>	
  </tr>
  <?while ($rs_departamentos = mssql_fetch_array($result_departamentos)){
      echo "<tr>
             <td style=\"text-align:left; color:#0150D3;\">".$rs_departamentos['DSC_LOJA']."</td>
             <td style=\"text-align:left; color:#0150D3;\">".$rs_departamentos['DTA_BOLETO']."</td>
             <td style=\"text-align:left; color:#0150D3;\">".$rs_departamentos['NRO_NOSSO_NUMERO']."</td>						 
             <td style=\"text-align:left; color:#0150D3;\">".$rs_departamentos['VLR_BOLETO']."</td>
             <td style=\"text-align:left; color:#0150D3;\">".$rs_departamentos['DTA_PAGAMENTO'];
						 if ($rs_departamentos['DTA_PAGAMENTO']!=''){
						   echo "Pago";
						 }else{
						   echo "<a href=\"javascript:java('boleto_itau.php?loja=".$rs_departamentos['COD_LOJA']."&dtaBoleto=".$rs_departamentos['DTA_BOLETO']."',800,800);\">Emitir</a></td>";
						 }
    }
  ?>
  </table>
</td>
</tr>
</table>
</form>
</body>
</html>
