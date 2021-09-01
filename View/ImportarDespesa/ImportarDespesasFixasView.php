<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <script language="JavaScript" src="js/Funcoes.js"></script>
    <script language="JavaScript" src="js/ImportarDespesasFixasView.js"></script>
    </head>
    <body> 
        <input type="hidden" id="codDespesaSelecao">
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
                        <td>
                        Tipo de Conta
                        </td>
                        <td>
                            <div id="comboTpoDespesa"></div>
                            <select name="tpoDespesa" id="tpoDespesa" style="display:none">
                                    <?
                                    $rs_tpoDespesa = unserialize(urldecode($_POST['ListaTipoDespesa']));

                                    $total = count($rs_tpoDespesa[1]);
                                    $i=0;
                                    echo "<option value=\"-1\">Todos</option>";
                                    while($i<$total ) {
                                        echo "<option value=\"".$rs_tpoDespesa[1][$i]['COD_TIPO_DESPESA']."\">".$rs_tpoDespesa[1][$i]['DSC_TIPO_DESPESA']."</option>";
                                        $i++;
                                    }
                                    ?>
                            </select>
                        </td>
                        <td>
                        Status
                        </td>
                        <td>
                            <div id="comboIndStatus"></div>
                            <select name="indStatus" id="indStatus" style="display:none">
                                <option value="-1">Todos</option>
                                <option value="N">Em Aberto</option>
                                <option value="S">Despesa Paga</option>
                            </select>
                        </td>
                        <td>
                            <input type="button" id="btnPesquisar" value="Pesquisar">
                        </td>
                        <td>
                            <input type="button" id="btnImportar" value="Importar">
                        </td>
                    </tr>
                    <tr>
                        <td>Valor Total</td>
                        <td>Valor Selecionado</td>
                    </tr>
                    <tr>
                        <td id="vlrTotal">0</td>
                        <td id="vlrSelecionado">0</td>
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
    </body>
</html>