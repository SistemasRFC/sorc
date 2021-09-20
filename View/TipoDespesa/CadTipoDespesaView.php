<script src="js/CadTipoDespesaView.js?<?php echo time();?>"></script>
<input type="hidden" name="method" id="method" value="">
<input type="hidden" name="codTipoDespesa" id="codTipoDespesa" value="0">
<table width="40%" align="center">
    <tr>
        <td>
            <table width="100%" align="center">
                <tr>
                    <td>Digite o Tipo Despesa</td>
                </tr>
                <tr>
                    <td><input type="text" size="50" name="dscTipoDespesa" id="dscTipoDespesa" value=""></td>
                </tr>
                <tr>
                    <td>Valor do Piso</td>
                </tr>
                <tr>
                    <td><input type="text" size="50" name="vlrPiso" id="vlrPiso" value=""></td>
                </tr>
                <tr>
                    <td>Valor do Teto</td>
                </tr>
                <tr>
                    <td><input type="text" size="50" name="vlrTeto" id="vlrTeto" value=""></td>
                </tr>
                <tr>
                    <td><div id="indInvestimento">Investimento</div></td>
                </tr>                
                <tr>
                    <td><div id="indAtivo">Ativo</div></td>
                </tr>
                <tr>
                    <td><input type="button" id="btnSalvar" value="Salvar"></td>
                </tr>
            </table>
        </td>
    </tr>
</table>