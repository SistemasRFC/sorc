<?php
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
// | PHPBoleto de João Prado Maia e Pablo Martins F. Costa				  |
// | 																	  |
// | Se vc quer colaborar, nos ajude a desenvolver p/ os demais bancos :-)|
// | Acesse o site do Projeto BoletoPhp: www.boletophp.com.br             |
// +----------------------------------------------------------------------+

// +----------------------------------------------------------------------+
// | Equipe Coordenação Projeto BoletoPhp: <boletophp@boletophp.com.br>   |
// | Desenvolvimento Boleto Itaú: Glauber Portella		                    |
// +----------------------------------------------------------------------+
?>

<!DOCTYPE HTML PUBLIC '-//W3C//DTD HTML 4.0 Transitional//EN'>
<HTML>
<HEAD>
<TITLE><?php echo $dadosboleto["identificacao"]; ?></TITLE>
<META http-equiv=Content-Type content=text/html charset=ISO-8859-1>
<meta name="Generator" content="Projeto BoletoPHP - www.boletophp.com.br - Licença GPL" />
<style type=text/css>
<!--.cp {  font: bold 10px Arial; color: black}
<!--.ti {  font: 9px Arial, Helvetica, sans-serif}
<!--.ld { font: bold 15px Arial; color: #000000}
<!--.ct { FONT: 9px "Arial Narrow"; COLOR: #000033}
<!--.cn { FONT: 9px Arial; COLOR: black }
<!--.bc { font: bold 20px Arial; color: #000000 }
<!--.ld2 { font: bold 12px Arial; color: #000000 }
.style1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style2 {font-family: Arial, Helvetica, sans-serif}
-->
</style>
</head>

<BODY text=#000000 bgColor=#ffffff topMargin=0 rightMargin=0>
<table width="100%" border="0" cellpadding="0">
  <tr>
    <td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="2">
	<tr>
	<td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="2"><span class="style2">BANCO ITA&Uacute; S.A. </span></td>
          <td><span class="style1">Recibo do Sacado </span></td>
        </tr>
      </tbody>
    </table>	</td>
    </tr>
    <tr>
    <td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="3" valign=top width=35% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
        </tr>
        <tr>
          <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
          <td class=ct valign=top width=98% height=13>Nome do Aluno:</td>
          <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
        </tr>
        <tr>
          <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=98% height=12><span class="campo"> <?php echo $dadosboleto["sacado"]?> </span></td>
          <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
        </tr>
        <tr>
          <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
          <td valign=top width=98% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
        </tr>
      </tbody>
    </table>	</td>
    </tr>
    <tr>
    <td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="3" valign=top width=35% height=1><img height=1 src=imagens/2.png width=99% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=65% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=35% height=1>Curso/Est&aacute;gio:</td>
          <td class=cp valign=top width=19 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          <td class=cp valign=top width=19 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=65% height=1>Turma:</td>
          <td class=cp valign=top width=19 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=35% height=12><span class="campo"> <?php echo $dadosboleto["curso"]?> </span> </td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=65% height=12><span class="campo"> <?php echo $dadosboleto["turma"]?> </span></td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
        </tr>
        <tr>
          <td colspan="3" valign=top width=35% height=1><img height=1 src=imagens/2.png width=99% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=65% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
        </tr>
      </tbody>
    </table>	</td>
   </tr>
   <tr>
    <td>
	<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="3" valign=top width=40% height=1><img height=1 src=imagens/2.png width=99% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=30% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=30% height=1><img height=1 src=imagens/2.png width=100% border=0></td>		  
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=1>Hor&aacute;rio:</td>
          <td class=cp valign=top width=7 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          <td class=cp valign=top width=1% height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=30% height=1>Matr&iacute;cula:</td>
          <td class=cp valign=top width=1% height=13 align="right"><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>		  
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=30% height=1>Parcela:</td>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>		  
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["horario"]?> </span> </td>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=30% height=12><span class="campo"> <?php echo $dadosboleto["matricula"]?> </span></td>
          <td class=cp valign=top width=7 height=12 align="right"><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=30% height=12><span class="campo"> <?php echo $dadosboleto["parcela"]?> </span></td>
          <td class=cp valign=top width=7 height=12 align="right"><img height=100% src=imagens/1.png width=1 border=0></td>		  
        </tr>
        <tr>
          <td colspan="3" valign=top width=35% height=1><img height=1 src=imagens/2.png width=99% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=65% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=65% height=1><img height=1 src=imagens/2.png width=100% border=0></td>		  
        </tr>
      </tbody>
    </table>	</td>
   </tr> 
<tr>
    <td><table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
      <tbody>
        <tr>
          <td colspan="3" valign=top width=40% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
          <td colspan="3" valign=top width=30% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=80% height=1>Vencimento:</td>
          <td class=cp valign=top width=7 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          <td class=cp valign=middle width=20% height=13 rowspan="34"><img height=100% src=imagens/3.png width=2 border=0>
		  <img src=imagens/am.png width=25 height=75% border=0></td>
          <td class=cp valign=top width=20% height=13><img height=2 src=imagens/2.png width=100% border=0></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["data_vencimento"]?> </span> </td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>		
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>	  
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
        </tr>
		
		
					
        <tr>
          <td colspan="3" valign=top width=40% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=80% height=1>Ag&ecirc;ncia/C&oacute;digo Cedente :</td>
          <td class=cp valign=top width=7 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["agencia"].'/'.$dadosboleto["conta"].'-'.$dadosboleto["conta_dv"]?> </span> </td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
          
        </tr>
        <tr>
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
        </tr>
		
		
						
        <tr>
          <td colspan="3" valign=top width=40% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=80% height=1>Nosso N&uacute;mero :</td>
          <td class=cp valign=top width=7 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["numero_documento"]?> </span> </td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
        </tr>
		
		
		
        <tr>
          <td colspan="3" valign=top width=40% height=1></td>
          <td width="5" height=1 valign="top"></td>
        </tr>		
        <tr>
          <td colspan="3" valign=top width=40% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=80% height=1>Valor do Documento :</td>
          <td class=cp valign=top width=7 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["valor_boleto"]?> </span> </td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
        </tr>


        <tr>
          <td colspan="3" valign=top width=40% height=1><img height=1 src=imagens/2.png width=100% border=0></td>
          <td width="5" height=1 valign="top"></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=80% height=1>Observa&ccedil;&otilde;es:</td>
          <td class=cp valign=top width=7 height=13><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["numero_documento"]?> </span> </td>
          <td class=cp valign=top width=7 height=12><img height=100% src=imagens/1.png width=1 border=0></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
        </tr>
		
		
		
        <tr>
          <td colspan="3" valign=top width=40% height=1></td>
          <td width="5" height=1 valign="top"></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13></td>
          <td class=cp valign=top width=80% height=1>Cedente:</td>
          <td class=cp valign=top width=7 height=13></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["cedente"]?> </span> </td>
          <td class=cp valign=top width=7 height=12></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
        </tr>


		
        <tr>
          <td colspan="3" valign=top width=40% height=1></td>
          <td width="5" height=1 valign="top"></td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=13></td>
          <td class=cp valign=top width=80% height=1>Sacado:</td>
          <td class=cp valign=top width=7 height=13></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td class=cp valign=top width=1 height=12></td>
          <td class=cp valign=top width=40% height=12><span class="campo"> <?php echo $dadosboleto["sacado_resp"]?> </span> </td>
          <td class=cp valign=top width=7 height=12></td>
          <td width="5">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=35% height=1><img height=1 src=imagens/2.png width=98.5% border=0></td>
        </tr>
        <tr>
          <td colspan="4" valign=top width=40% height=1></td>
          <td class=cp valign=top width=20% height=13><img height=2 src=imagens/2.png width=100% border=0></td>		  
        </tr>		
      </tbody>
    </table></td>
   </tr>     
  </table>
  </td> 
  <td>
	<table cellspacing=0 cellpadding=0 width=666 border=0>
      <tr>
        <td class=cp width=150><span class="campo"><img
      src="imagens/logoitau.jpg" width="150" height="40"
      border=0></span></td>
        <td width=3 valign=bottom><img height=22 src=imagens/3.png width=2 border=0></td>
        <td class=cpt width=58 valign=bottom><div align=center><font class=bc><?php echo $dadosboleto["codigo_banco_com_dv"]?></font></div></td>
        <td width=3 valign=bottom><img height=22 src=imagens/3.png width=2 border=0></td>
        <td class=ld align=right width=453 valign=bottom><span class="campotitulo"> <?php echo $dadosboleto["linha_digitavel"]?> </span></td>
      </tr>
      <tbody>
        <tr>
          <td colspan=5><img height=2 src=imagens/2.png width=666 border=0> </td>
        </tr>
      </tbody>
    </table>
        <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=472 height=13>Local de pagamento</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=180 height=13>Vencimento</td>
            </tr>
            <tr>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top width=472 height=12>Pagável em qualquer Banco até o vencimento</td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top align=right width=180 height=12><span class="campo"> <?php echo $dadosboleto["data_vencimento"]?> </span></td>
            </tr>
            <tr>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=472 height=1><img height=1 src=imagens/2.png width=472 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=472 height=13>Cedente</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=180 height=13>Agência/Código cedente</td>
            </tr>
            <tr>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top width=472 height=12><span class="campo"> <?php echo $dadosboleto["cedente"]?> </span></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top align=right width=180 height=12><span class="campo"> <?php echo $dadosboleto["agencia_codigo"]?> </span></td>
            </tr>
            <tr>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=472 height=1><img height=1 src=imagens/2.png width=472 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=113 height=13>Data do documento</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=153 height=13>N&ordm; documento</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=62 height=13>Espécie doc.</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=34 height=13>Aceite</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=82 height=13>Data processamento</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=180 height=13>Nosso número</td>
            </tr>
            <tr>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=113 height=12><div align=left> <span class="campo"> <?php echo $dadosboleto["data_documento"]?> </span> </div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top width=153 height=12><span class="campo"> <?php echo $dadosboleto["numero_documento"]?> </span> </td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=62 height=12><div align=left> <span class="campo"> <?php echo $dadosboleto["especie_doc"]?> </span> </div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=34 height=12><div align=left><span class="campo"> <?php echo $dadosboleto["aceite"]?> </span> </div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=82 height=12><div align=left> <span class="campo"> <?php echo $dadosboleto["data_processamento"]?> </span></div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top align=right width=180 height=12><span class="campo"> <?php echo $dadosboleto["nosso_numero"]?> </span></td>
            </tr>
            <tr>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=113 height=1><img height=1 src=imagens/2.png width=113 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=153 height=1><img height=1 src=imagens/2.png width=153 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=62 height=1><img height=1 src=imagens/2.png width=62 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=34 height=1><img height=1 src=imagens/2.png width=34 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=82 height=1><img height=1 src=imagens/2.png width=82 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top colspan="3" height=13>Uso
                do banco</td>
              <td class=ct valign=top height=13 width=7><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=83 height=13>Carteira</td>
              <td class=ct valign=top height=13 width=7><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=53 height=13>Espécie</td>
              <td class=ct valign=top height=13 width=7><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=123 height=13>Quantidade</td>
              <td class=ct valign=top height=13 width=7><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=72 height=13> Valor Documento</td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=180 height=13>(=)
                Valor documento</td>
            </tr>
            <tr>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td valign=top class=cp height=12 colspan="3"><div align=left> </div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=83><div align=left> <span class="campo"> <?php echo $dadosboleto["carteira"]?> </span></div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=53><div align=left><span class="campo"> <?php echo $dadosboleto["especie"]?> </span> </div></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=123><span class="campo"> <?php echo $dadosboleto["quantidade"]?> </span> </td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top  width=72><span class="campo"> <?php echo $dadosboleto["valor_unitario"]?> </span></td>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top align=right width=180 height=12><span class="campo"> <?php echo $dadosboleto["valor_boleto"]?> </span></td>
            </tr>
            <tr>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=75 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=31 height=1><img height=1 src=imagens/2.png width=31 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=83 height=1><img height=1 src=imagens/2.png width=83 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=53 height=1><img height=1 src=imagens/2.png width=53 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=123 height=1><img height=1 src=imagens/2.png width=123 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=72 height=1><img height=1 src=imagens/2.png width=72 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 width=666 border=0>
          <tbody>
            <tr>
              <td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=1 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
              <td valign=top width=468 rowspan=5><font class=ct>Instruções
                (Texto de responsabilidade do cedente)</font><br>
                            <br>
                            <span class=cp> <font class=campo> <?php echo $dadosboleto["instrucoes1"]; ?><br>
                            <?php echo $dadosboleto["instrucoes2"]; ?><br>
                            <?php // echo $dadosboleto["instrucoes3"]; ?><br>
                            <?php // echo $dadosboleto["instrucoes4"]; ?></font><br>
                            <br>
                          </span></td>
              <td align=right width=188><table cellspacing=0 cellpadding=0 border=0>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                      <td class=ct valign=top width=180 height=13>(-)
                        Desconto / Abatimentos</td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                      <td class=cp valign=top align=right width=180 height=12></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
                      <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
            <tr>
              <td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=1 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
              <td align=right width=188><table cellspacing=0 cellpadding=0 border=0>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                      <td class=ct valign=top width=180 height=13>(-)
                        Outras deduções</td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                      <td class=cp valign=top align=right width=180 height=12></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
                      <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
            <tr>
              <td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=1 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
              <td align=right width=188><table cellspacing=0 cellpadding=0 border=0>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                      <td class=ct valign=top width=180 height=13>(+)
                        Mora / Multa</td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                      <td class=cp valign=top align=right width=180 height=12></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
                      <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
            <tr>
              <td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=1 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
              <td align=right width=188><table cellspacing=0 cellpadding=0 border=0>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                      <td class=ct valign=top width=180 height=13>(+)
                        Outros acréscimos</td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                      <td class=cp valign=top align=right width=180 height=12></td>
                    </tr>
                    <tr>
                      <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
                      <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
            <tr>
              <td align=right width=10><table cellspacing=0 cellpadding=0 border=0 align=left>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                    </tr>
                  </tbody>
              </table></td>
              <td align=right width=188><table cellspacing=0 cellpadding=0 border=0>
                  <tbody>
                    <tr>
                      <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
                      <td class=ct valign=top width=180 height=13>(=)
                        Valor cobrado</td>
                    </tr>
                    <tr>
                      <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
                      <td class=cp valign=top align=right width=180 height=12></td>
                    </tr>
                  </tbody>
              </table></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 width=666 border=0>
          <tbody>
            <tr>
              <td valign=top width=666 height=1><img height=1 src=imagens/2.png width=666 border=0></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=659 height=13>Sacado</td>
            </tr>
            <tr>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top width=659 height=12><span class="campo"> <?php echo $dadosboleto["sacado_resp"]?> </span> </td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=cp valign=top width=7 height=12><img height=12 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top width=659 height=12><span class="campo"> <?php echo $dadosboleto["endereco1"]?> </span> </td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0>
          <tbody>
            <tr>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=cp valign=top width=472 height=13><span class="campo"> <?php echo $dadosboleto["endereco2"]?> </span></td>
              <td class=ct valign=top width=7 height=13><img height=13 src=imagens/1.png width=1 border=0></td>
              <td class=ct valign=top width=180 height=13>Cód.
                baixa</td>
            </tr>
            <tr>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=472 height=1><img height=1 src=imagens/2.png width=472 border=0></td>
              <td valign=top width=7 height=1><img height=1 src=imagens/2.png width=7 border=0></td>
              <td valign=top width=180 height=1><img height=1 src=imagens/2.png width=180 border=0></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 border=0 width=666>
          <tbody>
            <tr>
              <td class=ct  width=7 height=12></td>
              <td class=ct  width=409 >Sacador/Avalista</td>
              <td class=ct  width=250 ><div align=right>Autenticação
                mecânica - <b class=cp>Ficha de Compensação</b></div></td>
            </tr>
            <tr>
              <td class=ct  colspan=3 ></td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 width=666 border=0>
          <tbody>
            <tr>
              <td valign=bottom align=left height=50><?php fbarcode($dadosboleto["codigo_barras"]); ?>
              </td>
            </tr>
          </tbody>
        </table>
      <table cellspacing=0 cellpadding=0 width=666 border=0>
          <tr>
            <td class=ct width=666></td>
          </tr>
          <tbody>
            <tr>
              <td class=ct width=666><div align=right>Corte
                na linha pontilhada</div></td>
            </tr>
            <tr>
              <td class=ct width=666><img height=1 src=imagens/6.png width=665 border=0></td>
            </tr>
          </tbody>
      </table></td>
  </tr>
</table>
</BODY></HTML>
