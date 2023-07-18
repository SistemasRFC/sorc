<script>
$(function() {
    $( "#btnPesquisa" ).click(function( event ) {
        $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
            {method: 'ListarSaldoContasBancarias',
            nroAnoReferencia: $("#nroAnoReferencia").val(),
            nroMesReferencia: $("#nroMesReferencia").val()},function(data){

                data = eval('('+data+')');

                if (data!=null){

                    carregaTabela(data);

                }
        });
    });
});

</script>
        <script type="text/javascript">
        function preencheCampos(obj, valor){
            obj.value=valor;
        }
        function carregaModal(){
           $( "#CadastroForm" ).dialog( "open" );
        }
        function carregaTabela(data){
            linha = '<table border="0" width="100%" cellpadding="0" cellspacing="0"> '+
                    '  <tr bgcolor="#E8E8E8"> '+
                    '    <th class="coluna150px">Banco</th> '+
                    '    <th class="coluna75px">Agência</th> '+
                    '    <th class="coluna150px">Conta</th> '+
                    '    <th class="coluna75px" align="right">Valor</th> '+
                    '  </tr> ';
                    cor='';
                    total=0;
                    result_receitas = data;

                    for(i=0;i<result_receitas.length;i++){
                        if (cor=="#E8E8E8"){
                            cor="#FFFFFF";
                        }else{
                            cor="#E8E8E8";
                        }
                        linha = linha + ' <tr bgcolor="'+cor+'" class="trcor"> '+
                                ' <td>'+result_receitas[i].nmeBanco+'</td> '+
                                ' <td>'+result_receitas[i].nroAgencia+'</td> '+
                                ' <td>'+result_receitas[i].nroConta+'</td> '+
                                ' <td align=\"right\">'+result_receitas[i].valor+'</td> '+
                            ' </tr>';
                        valor = result_receitas[i].valor;
                        valor = valor.replace(',','');
                        total = parseFloat(total)+parseFloat(valor);
                    }
                    linha = linha + ' <tr><td colspan="3" align="right">Total</td> '+
                        '<td align="right">'+Formata(total,2,'.',',')+'</td> '+
                        '<td class="coluna25px"><br></td> '+
                        '<td class="coluna25px"><br></td> '+
                        '<td class="coluna25px"><br></td> '+
                    '</tr> '+
                '</table> ';
            $("#tabela").html(linha);
        }
        </script>
<table width="100%">
<tr>
    <td>
        <table>
            <tr>
                <td>Ano
                    <select name="nroAnoReferencia" id="nroAnoReferencia">
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
                <td>Mês
                    <select name="nroMesReferencia" id="nroMesReferencia">
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
                    <input type="button" id="btnPesquisa" value="Pesquisar">
                </td>

            </tr>
        </table>
    </td>
</tr>
</table>
<div id="tabela">

</div>