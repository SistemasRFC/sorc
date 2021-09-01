<script language="JavaScript" src="js/CadTransferenciaContasView.js"></script>
<form name="TransferenciaContasForm" method="post">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="codTransferencia" name="codTransferencia" value="0">
    <table>
        <tr>
            <td>
            Data
            </td>
            <td><input type="text" id="dtaMovimentacao" name="dtaMovimentacao"></td>
        </tr>
        <tr>
            <td>
            Valor
            </td>
            <td><input type="text" id="vlrMovimentacao" name="vlrMovimentacao"></td>
        </tr>
        <tr>
            <td>
            Conta Origem
            </td>
            <td><div id="comboCodContaOrigem"></div>
                <select name="codContaOrigem" id="codContaOrigem" style="display:none;">
                <?$rs_conta = unserialize(urldecode($_POST['ListaContasBancariasOrigem']));
                $total = count($rs_conta);
                $i=0;
                while($i<$total ) {
                    echo "<option value=\"".$rs_conta[$i]['COD_CONTA']."\">".$rs_conta[$i]['CONTA']."</option>";
                    $i++;
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
            Conta Destino
            </td>
            <td><div id="comboCodContaDestino"></div>
                <select name="codContaDestino" id="codContaDestino" style="display:none;">
                <?$rs_conta = unserialize(urldecode($_POST['ListaContasBancariasDestino']));
                $total = count($rs_conta);
                $i=0;
                while($i<$total ) {
                    echo "<option value=\"".$rs_conta[$i]['COD_CONTA']."\">".$rs_conta[$i]['CONTA']."</option>";
                    $i++;
                }
                ?>
                </select>
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