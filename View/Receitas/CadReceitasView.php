<script language="JavaScript" src="js/CadReceitasView.js"></script>
<form name="CadastroForm" method="post">
    <input type="hidden" id="method" name="method">
    <input type="hidden" id="codReceita" name="codReceita" value="0">
<table>
    <tr>
        <td>
        Descrição
        </td>
        <td><input type="text" id="dscReceita" name="dscReceita" size="80"></td>
    </tr>
    <tr>
        <td>
        Data
        </td>
        <td><input type="text" id="dtaReceita" name="dtaReceita"></td>
    </tr>
    <tr>
        <td>
        Valor
        </td>
        <td><input type="text" id="vlrReceita" name="vlrReceita"></td>
    </tr>
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
            <input type="button" id="btnSalvar" value="Salvar">
        </td>
        <td>
            <input type="button" id="btnDeletar" value="Deletar">
        </td>
    </tr>    
</table>
</form>