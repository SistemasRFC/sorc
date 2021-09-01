<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <script language="JavaScript" src="js/Funcoes.js"></script>
    <script language="JavaScript" src="js/TransferenciaContasView.js"></script>
    </head>
    <body> 
        <table width="100%">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Ano</td>
                        <td>
                            <div id="comboNroAnoReferencia"></div>
                            <select name="nroAnoReferencia" id="nroAnoReferencia" style="display:none">
                            <?$result_receitas = unserialize(urldecode($_POST['ListaAnos']));
                            $nroAnoReferencia = unserialize(urldecode($_POST['nroAnoReferencia']));
                            for($i=0;$i<count($result_receitas);$i++){
                                if ($nroAnoReferencia==$result_receitas[$i]['NRO_ANO_REFERENCIA']){
                                    echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                                }else{
                                    echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                                }
                            }
                            ?>
                            </select>
                        </td>
                        <td>Mês</td>
                        <td>
                            <div id="comboNroMesReferencia"></div>
                            <select name="nroMesReferencia" id="nroMesReferencia" style="display:none">
                            <?$result_receitas = unserialize(urldecode($_POST['ListaMeses']));
                            $nroMesReferencia = unserialize(urldecode($_POST['nroMesReferencia']));
                            for($i=0;$i<count($result_receitas);$i++){
                                if ($nroMesReferencia==$result_receitas[$i]['NRO_MES_REFERENCIA']){
                                    echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                                }else{
                                    echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                                }
                            }
                            ?>
                            </select>
                        </td>

                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>                
                <table>
                    <tr>
                        <td>
                            <input type="button" id="btnPesquisa" value="Pesquisar">
                        </td>
                        <td>
                            <input type="button" id="btnNovo" value="Nova Transferencia">
                        </td>                       
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td id="tdGrid">
                <div id="ListagemForm">
                </div>   
            </td>
        </tr>
        </table>        
      <div id="CadastroForm">
            <div id="windowHeader">
            </div>
            <div style="overflow: hidden;" id="windowContent">
                <? include_once "CadTransferenciaContasView.php";?>
            </div>            
      </div>                 
    </body>
</html>