<?php
// +----------------------------------------------------------------------+
// | BoletoPhp - Vers�o Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo est� dispon�vel sob a Licen�a GPL dispon�vel pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Voc� deve ter recebido uma c�pia da GNU Public License junto com     |
// | esse pacote; se n�o, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colabora��es de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de Jo�o Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordena��o Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Ita�: Glauber Portella                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DIN�MICOS DO SEU CLIENTE PARA A GERA��O DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formul�rio c/ POST, GET ou de BD (MySql,Postgre,etc)	//
ob_start();
//Inicia a sess�+�o
session_start();
include_once "../ArquivosGerais/SQLServer.php";
$obj = new SQLServer();
$obj->conectar();
if (!isset($loja)){
  $loja = $_SESSION['codLoja'];
}
$sql_dados_boleto = "
SELECT VLR_BOLETO,
       NRO_NOSSO_NUMERO,
       CONVERT(VARCHAR(10),GETDATE(),103) AS DATA_1,
       '25/11/2013' AS DATA
  FROM EN_PAGAMENTO
 WHERE COD_LOJA = ".$loja."
   AND CONVERT(VARCHAR(10), DTA_BOLETO, 103) = '$dtaBoleto'";
//echo $sql_dados_boleto;
$result_dados_boleto = mssql_query("$sql_dados_boleto");
$rs_dados_boleto = mssql_fetch_array($result_dados_boleto);	 
//echo $dtaBoleto;
$sql_dados_cliente = "
SELECT DSC_LOJA,
       ENDERECO,
			 CEP,
			 SGL_UF,
			 BAIRRO,
			 NRO_CNPJ
	FROM EN_LOJA
 WHERE COD_LOJA = $loja";
$result_dados_cliente = mssql_query("$sql_dados_cliente");
$rs_dados_cliente = mssql_fetch_array($result_dados_cliente);
// DADOS DO BOLETO PARA O SEU CLIENTE
$dataBoleto = substr($dtaBoleto,6,4).substr($dtaBoleto,3,2).substr($dtaBoleto,0,2);
$dataAtual = substr($rs_dados_boleto['DATA'],6,4).substr($rs_dados_boleto['DATA'],3,2).substr($rs_dados_boleto['DATA'],0,2);
//echo $dataBoleto."<br>";
//echo $dataAtual."<br>";
$ano1 = substr($dtaBoleto,6,4); 
$mes1 = substr($dtaBoleto,3,2); 
$dia1 = substr($dtaBoleto,0,2); 

//defino data 2 
$ano2 = substr($rs_dados_boleto['DATA'],6,4); 
$mes2 = substr($rs_dados_boleto['DATA'],3,2); 
$dia2 = substr($rs_dados_boleto['DATA'],0,2); 

//calculo timestam das duas datas 
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
$timestamp2 = mktime(4,12,0,$mes2,$dia2,$ano2); 

//diminuo a uma data a outra 
$segundos_diferenca = $timestamp1 - $timestamp2; 
//echo $segundos_diferenca; 

//converto segundos em dias 
$dias_diferenca = $segundos_diferenca / (60 * 60 * 24); 

//obtenho o valor absoluto dos dias (tiro o poss�vel sinal negativo) 
$dias_diferenca = abs($dias_diferenca); 

//tiro os decimais aos dias de diferenca 
$dias_diferenca = floor($dias_diferenca); 

//echo $dias_diferenca."<br>"; 
if ($dataBoleto>=$dataAtual){
//echo "aqui";
	$dias_de_prazo_para_pagamento = $dtaBoleto;
	$taxa_boleto = 0.00;
	$data_venc = $dias_de_prazo_para_pagamento;//date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
	$valor_cobrado = $rs_dados_boleto['VLR_BOLETO']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
}else{
//echo "aqui";
	$dias_de_prazo_para_pagamento = $rs_dados_boleto['DATA'];
	$taxa_boleto = 0.00;
	$data_venc = $dias_de_prazo_para_pagamento;//date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
	$valor_cobrado = $rs_dados_boleto['VLR_BOLETO']+(0.02*$rs_dados_boleto['VLR_BOLETO'])+(($dias_diferenca)*1.50); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
  //echo ($dataAtual-$dataBoleto);
} 
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $rs_dados_boleto['NRO_NOSSO_NUMERO'];  // Nosso numero - REGRA: M�ximo de 8 caracteres!
$dadosboleto["numero_documento"] = $rs_dados_boleto['NRO_NOSSO_NUMERO'];;	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emiss�o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com v�rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $rs_dados_cliente['DSC_LOJA'];
$dadosboleto["endereco1"] = $rs_dados_cliente['ENDERECO'];
$dadosboleto["endereco2"] = $rs_dados_cliente['BAIRRO'].' '.$rs_dados_cliente['SGL_UF'].' '.$rs_dados_cliente['CEP'];

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "Mensalidade referente a Sistema Capa Taxa banc�ria - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% ap�s o vencimento";
$dadosboleto["instrucoes2"] = "MORA + IOF R$ 1,50 ao dia";
$dadosboleto["instrucoes3"] = "";
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURA��O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITA�
$dadosboleto["agencia"] = "6244"; // Num da agencia, sem digito
$dadosboleto["conta"] = "06248";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "2"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITA�
$dadosboleto["carteira"] = "157";  // C�digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "BOLETO - Sistema CAPA";
$dadosboleto["cpf_cnpj"] = "701.676.641-15";
$dadosboleto["endereco"] = "";
$dadosboleto["cidade_uf"] = "Bras�lia - DF";
$dadosboleto["cedente"] = "Rafael Freitas Carneiro";

// N�O ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");
?>
