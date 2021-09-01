<script language="JavaScript" src="js/CadDespesasView.js"></script>
<form name="CadastroForm" method="post">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="codDespesa" name="codDespesa" value="">
<table>
    <tr>
        <td>
        Descrição
        </td>
        <td><input type="text" id="dscDespesa" name="dscDespesa"></td>
    </tr>
    <tr>
        <td>
        Data
        </td>
        <td><input type="text" id="dtaDespesa" name="dtaDespesa"></td>
    </tr>
    <tr>
        <td>
        Valor
        </td>
        <td><input type="text" id="vlrDespesa" name="vlrDespesa"></td>
    </tr>
    <tr>
        <td>
        Qtd Parcelas
        </td>
        <td><input type="text" id="qtdParcelas" name="qtdParcelas"></td>
    </tr>
    <tr>
        <td>
        Parcela Atual
        </td>
        <td><input type="text" id="nroParcelaAtual" name="nroParcelaAtual"></td>
    </tr>
    <tr>
        <td>
        Tipo de Conta
        </td>
        <td><div id="comboCodTipoDespesa"></div>
            <select name="codTipoDespesa" id="codTipoDespesa" style="display:none;">
                    <?
                    $rs_tpoDespesa = unserialize(urldecode($_POST['ListaTipoDespesa']));

                    $total = count($rs_tpoDespesa[1]);
                    $i=0;
                    echo "<option value=\"-1\">Selecione</option>";
                    while($i<$total ) {
                        echo "<option value=\"".$rs_tpoDespesa[1][$i]['COD_TIPO_DESPESA']."\">".$rs_tpoDespesa[1][$i]['DSC_TIPO_DESPESA']."</option>";
                        $i++;
                    }
                    ?>
            </select>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div id="divValores">
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <input type="checkbox" id="indDespesaPaga" name="indDespesaPaga" checked>Despesa Paga?
        </td>
    </tr>
    <tr>
        <td>
            <div id="trDtaDespesaPaga" style="display:block">
                <table>
                    <tr>
                        <td>
                        Conta
                        </td>
                        <td><div id="comboCodConta"></div>
                            <select name="codConta" id="codConta" style="display:none;">
                            <?$rs_conta = unserialize(urldecode($_POST['ListaContasBancarias']));
                            $total = count($rs_conta[1]);
                            $i=0;
                            echo "<option value=\"-1\">Selecione</option>";
                            while($i<$total ) {
                                echo "<option value=\"".$rs_conta[1][$i]['COD_CONTA']."\">".$rs_conta[1][$i]['CONTA']."</option>";
                                $i++;
                            }
                            ?>
                            </select>
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            Data do Pagamento
                        </td>
                        <td>
                            <input type="text" id="dtaPagamento" name="dtaPagamento">
                        </td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <input type="button" id="btnSalvar" value="Salvar">
        </td>
        <td>
            <input type="button" id="btnDeletar" value="Deletar">
        </td>
    </tr>
</table>
</form>