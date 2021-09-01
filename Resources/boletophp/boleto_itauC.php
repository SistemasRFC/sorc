<?php
include_once('../../model/Loja/LojaModel.php');
$loja = new LojaModel();
$boleto = $loja->CarregaBoleto(false);

$dtaBoleto = $boleto[1][0]['DTA_BOLETO'];
$dtaAtual = $_REQUEST['dtaAtual'];

$dscLoja = utf8_decode($boleto[1][0]['DSC_LOJA']);
$txtEndereco = $boleto[1][0]['ENDERECO'].' '.$boleto[1][0]['COMPLEMENTO'];
$nroCEP = $boleto[1][0]['CEP'];
$sglUf = $boleto[1][0]['SGL_UF'];
$dscBairro = $boleto[1][0]['BAIRRO'];
$cnpj=$boleto[1][0]['NRO_CNPJ'];
$nossoNumero = $boleto[1][0]['NRO_NOSSO_NUMERO'];
// DADOS DO BOLETO PARA O SEU CLIENTE
$dataBoleto = substr($dtaBoleto,6,4).substr($dtaBoleto,3,2).substr($dtaBoleto,0,2);
$dataAtual = substr($dtaAtual,6,4).substr($dtaAtual,3,2).substr($dtaAtual,0,2);
//echo $dataBoleto."<br>";
//echo $dataAtual."<br>";
$ano1 = substr($dtaBoleto,6,4); 
$mes1 = substr($dtaBoleto,3,2); 
$dia1 = substr($dtaBoleto,0,2); 

//defino data 2 
$ano2 = substr($dtaAtual,6,4);
$mes2 = substr($dtaAtual,3,2);
$dia2 = substr($dtaAtual,0,2);

//calculo timestam das duas datas 
$timestamp1 = mktime(0,0,0,$mes1,$dia1,$ano1); 
$timestamp2 = mktime(0,0,0,$mes2,$dia2,$ano2); 

//diminuo a uma data a outra 
$segundos_diferenca = $timestamp1 - $timestamp2; 
//echo $segundos_diferenca; 

//converto segundos em dias 
$dias_diferenca = $segundos_diferenca / (60 * 60 * 24); 

//obtenho o valor absoluto dos dias (tiro o possï¿½vel sinal negativo) 
$dias_diferenca = abs($dias_diferenca); 

//tiro os decimais aos dias de diferenca 
$dias_diferenca = floor($dias_diferenca); 

//echo $dias_diferenca."<br>"; 
if ($dataBoleto>=$dataAtual){
	$dias_de_prazo_para_pagamento = $dtaBoleto;
	$taxa_boleto = 0.00;
	$data_venc = $dias_de_prazo_para_pagamento;//date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
	$valor_cobrado = $boleto[1][0]['VLR_BOLETO']; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
}else{
	$dias_de_prazo_para_pagamento = $dtaAtual;
        $dtaBoleto = $dtaAtual;
	$taxa_boleto = 0.00;
	$data_venc = $dias_de_prazo_para_pagamento;//date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
	$valor_cobrado = $boleto[1][0]['VLR_BOLETO']+(0.02*$boleto[1][0]['VLR_BOLETO'])+(($dias_diferenca)*1.50); // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
}
$valor_cobrado = str_replace(",", ".",$valor_cobrado);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $nossoNumero;  // Nosso numero - REGRA: Mï¿½ximo de 8 caracteres!
$dadosboleto["numero_documento"] = $nossoNumero;	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $dtaBoleto; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissï¿½o do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vï¿½rgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $dscLoja;
$dadosboleto["endereco1"] = $txtEndereco;
$dadosboleto["endereco2"] = $dscBairro.' '.$sglUf.' '.$nroCEP;

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "";
$dadosboleto["demonstrativo2"] = "Mensalidade referente a Sistema Capa Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "MORA + IOF R$ 1,50 ao dia";
$dadosboleto["instrucoes3"] = "";
$dadosboleto["instrucoes4"] = "";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "";


// ---------------------- DADOS FIXOS DE CONFIGURAï¿½ï¿½O DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAï¿½
$dadosboleto["agencia"] = "6244"; // Num da agencia, sem digito
$dadosboleto["conta"] = "06248";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "2"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAï¿½
$dadosboleto["carteira"] = "157";  // Cï¿½digo da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "BOLETO - Sistema CAPA";
$dadosboleto["cpf_cnpj"] = "701.676.641-15";
$dadosboleto["endereco"] = "";
$dadosboleto["cidade_uf"] = "Brasília - DF";
$dadosboleto["cedente"] = "Rafael Freitas Carneiro";

// Nï¿½O ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau.php");
?>