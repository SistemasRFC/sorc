<?php
header("Content-Type: text/html;  charset=ISO-8859-1;",true);
// +----------------------------------------------------------------------+
// | BoletoPhp - Versão Beta                                              |
// +----------------------------------------------------------------------+
// | Este arquivo está disponível sob a Licença GPL disponível pela Web   |
// | em http://pt.wikipedia.org/wiki/GNU_General_Public_License           |
// | Você deve ter recebido uma cópia da GNU Public License junto com     |
// | esse pacote; se não, escreva para:                                   |
// |                                                                      |
// | Free Software Foundation, Inc.                                       |
// | 59 Temple Place - Suite 330                                          |
// | Boston, MA 02111-1307, USA.                                          |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Originado do Projeto BBBoletoFree que tiveram colaborações de Daniel |
// | William Schultz e Leandro Maniezo que por sua vez foi derivado do	  |
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				        |
// | 														                                   			  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Itaú: Glauber Portella                        |
// +----------------------------------------------------------------------+


// ------------------------- DADOS DINÂMICOS DO SEU CLIENTE PARA A GERAÇÃO DO BOLETO (FIXO OU VIA GET) -------------------- //
// Os valores abaixo podem ser colocados manualmente ou ajustados p/ formulário c/ POST, GET ou de BD (MySql,Postgre,etc)	//
include_once "../ArquivosGerais/SQLServer.php";
$obj = new SQLServer();
$obj->conectar();

$sql_dados = "
SELECT CONVERT(VARCHAR(10), DTA_PARCELA, 103) AS DTA_PARCELA,
       VLR_PARCELA,
	   COD_PAGAMENTO,
	   NME_ALUNO,
	   TXT_ENDERECO,
	   NME_BAIRRO,
	   NRO_CEP,
	   DSC_TURMA,
	   I.NME_IDIOMA+' - '+C.DSC_CURSO AS DSC_CURSO,
	   CASE WHEN R.NRO_CPF='000.000.000-00' THEN NME_ALUNO
	        ELSE R.NME_RESPONSAVEL
	   END AS NME_RESPONSAVEL,
	   PL.QTD_PARCELAS,
	   CONVERT(VARCHAR(5), NRO_HORARIO,108) AS NRO_HORARIO,
	   A.NRO_MATRICULA
  FROM EN_PAGAMENTOS P
 INNER JOIN EN_ALUNO A
    ON P.COD_ALUNO = A.COD_ALUNO
 INNER JOIN EN_TURMA T
    ON P.COD_TURMA = T.COD_TURMA
 INNER JOIN RE_TURMA_DIA_AULA TDA
    ON T.COD_TURMA = TDA.COD_TURMA
 INNER JOIN EN_HORARIO_AULA HA
    ON TDA.COD_HORARIO = HA.COD_HORARIO
 INNER JOIN EN_MODULO M
    ON T.COD_MODULO = M.COD_MODULO
 INNER JOIN EN_CURSO C
    ON M.COD_CURSO = C.COD_CURSO
 INNER JOIN EN_IDIOMAS I
    ON C.COD_IDIOMA = I.COD_IDIOMA
 INNER JOIN EN_RESPONSAVEL R
    ON A.COD_RESPONSAVEL = R.COD_RESPONSAVEL
 INNER JOIN EN_PLANOS PL
    ON P.COD_PLANO = PL.COD_PLANO
 WHERE P.COD_ALUNO = $codAluno
   AND COD_PAGAMENTO = $codPagamento
   AND P.COD_TURMA = $codTurma";
//echo $sql_dados;
$result_dados = mssql_query("$sql_dados");
$rs_dados = mssql_fetch_array($result_dados);
 
// DADOS DO BOLETO PARA O SEU CLIENTE
$dias_de_prazo_para_pagamento = 10;
$taxa_boleto = 0;
$data_venc = $rs_dados['DTA_PARCELA'];//date("d/m/Y", time() + ($dias_de_prazo_para_pagamento * 86400));  // Prazo de X dias OU informe data: "13/04/2006"; 
$valor_cobrado = "80,00"; // Valor - REGRA: Sem pontos na milhar e tanto faz com "." ou "," ou com 1 ou 2 ou sem casa decimal
$valor_cobrado = str_replace(",", ".",$rs_dados['VLR_PARCELA']);
$valor_boleto=number_format($valor_cobrado+$taxa_boleto, 2, ',', '');

$dadosboleto["nosso_numero"] = $rs_dados['COD_PAGAMENTO'];  // Nosso numero - REGRA: Máximo de 8 caracteres!
$dadosboleto["numero_documento"] = $rs_dados['COD_PAGAMENTO'];	// Num do pedido ou nosso numero
$dadosboleto["data_vencimento"] = $data_venc; // Data de Vencimento do Boleto - REGRA: Formato DD/MM/AAAA
$dadosboleto["data_documento"] = date("d/m/Y"); // Data de emissão do Boleto
$dadosboleto["data_processamento"] = date("d/m/Y"); // Data de processamento do boleto (opcional)
$dadosboleto["valor_boleto"] = $valor_boleto; 	// Valor do Boleto - REGRA: Com vírgula e sempre com duas casas depois da virgula

// DADOS DO SEU CLIENTE
$dadosboleto["sacado"] = $rs_dados['NME_ALUNO'];
$dadosboleto["sacado_resp"] = $rs_dados['NME_RESPONSAVEL'];
$dadosboleto["endereco1"] = $rs_dados['TXT_ENDERECO'];
$dadosboleto["endereco2"] = $rs_dados['NME_BAIRRO']."&nbsp; CEP: ".$rs_dados['NRO_CEP'];//"Cidade - Estado -  CEP: 00000-000";
$dadosboleto["turma"] = $rs_dados['DSC_TURMA'];
$dadosboleto["curso"] = $rs_dados['DSC_CURSO'];
$dadosboleto["parcela"] = $parcela.'/'.$rs_dados['QTD_PARCELAS'];
$dadosboleto["matricula"] = $rs_dados['NRO_MATRICULA'];
$acrescimo = 90;
$formato = strtotime($rs_dados['NRO_HORARIO']);
$converte = strtotime("+$acrescimo minutes", $formato);
$nova_hora = date('H:i:s', $converte);

$dadosboleto["horario"] = $rs_dados['NRO_HORARIO'].' - '.$nova_hora;

// INFORMACOES PARA O CLIENTE
$dadosboleto["demonstrativo1"] = "Pagamento de Compra na Loja Nonononono";
$dadosboleto["demonstrativo2"] = "Mensalidade referente a nonon nonooon nononon<br>Taxa bancária - R$ ".number_format($taxa_boleto, 2, ',', '');
$dadosboleto["demonstrativo3"] = "BoletoPhp - http://www.boletophp.com.br";
$dadosboleto["instrucoes1"] = "- Sr. Caixa, cobrar multa de 2% após o vencimento";
$dadosboleto["instrucoes2"] = "- Receber até 10 dias após o vencimento";
//$dadosboleto["instrucoes3"] = "- Em caso de dúvidas entre em contato conosco: xxxx@xxxx.com.br";
//$dadosboleto["instrucoes4"] = "&nbsp; Emitido pelo sistema Projeto BoletoPhp - www.boletophp.com.br";

// DADOS OPCIONAIS DE ACORDO COM O BANCO OU CLIENTE
$dadosboleto["quantidade"] = "";
$dadosboleto["valor_unitario"] = "";
$dadosboleto["aceite"] = "N";		
$dadosboleto["especie"] = "R$";
$dadosboleto["especie_doc"] = "OU";


// ---------------------- DADOS FIXOS DE CONFIGURAÇÃO DO SEU BOLETO --------------- //


// DADOS DA SUA CONTA - ITAÚ
$dadosboleto["agencia"] = "0479"; // Num da agencia, sem digito
$dadosboleto["conta"] = "43963";	// Num da conta, sem digito
$dadosboleto["conta_dv"] = "0"; 	// Digito do Num da conta

// DADOS PERSONALIZADOS - ITAÚ
$dadosboleto["carteira"] = "175";  // Código da Carteira: pode ser 175, 174, 104, 109, 178, ou 157

// SEUS DADOS
$dadosboleto["identificacao"] = "Ability Instituto de Línguas";
$dadosboleto["cpf_cnpj"] = "04480157/0001-12";
$dadosboleto["endereco"] = "";
$dadosboleto["cidade_uf"] = "";
$dadosboleto["cedente"] = "Ability Instituto de Líguas";

// NÃO ALTERAR!
include("include/funcoes_itau.php"); 
include("include/layout_itau_novo.php");
?>
