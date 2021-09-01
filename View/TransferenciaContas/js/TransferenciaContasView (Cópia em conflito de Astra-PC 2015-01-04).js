$(function() {
    $( "#dtaMovimentacao" ).datepicker({ dateFormat: 'dd/mm/yy' });
    $( "#dialogInformacao" ).dialog({
        autoOpen: false,
        width: 450,
        title: 'Listagem das Transferências',
        buttons: [
                {
                    text: "Ok",
                    id: "btnOK",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
        ],
        close: function(ev, ui) { $("#CadastroForm").dialog("close");}
    });
    $( "#ListagemForm" ).dialog({
        autoOpen: true,
        width: 1000,
        height: 700,
        title: 'Listagem das Transferências',
        buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
        ],
        close: function(ev, ui) { window.location='../MenuPrincipal.php'; }
    });
    $( "#CadastroForm" ).dialog({
        autoOpen: false,
        width: 400,
        show: 'explode',
        hide: 'explode',
        title: 'Transferência entre contas',
        modal: true,
        buttons: [
                {
                        text: "Salvar",
                        click: function() {
                            $( "#dialogInformacao" ).html('Aguarde, salvando transferência de conta!');
                            $("#btnOK").hide();
                            $( "#dialogInformacao" ).dialog( "open" );
                            if ($("#codTransferencia").val()=="0"){
                                valMethod = "AddTransferenciaContas";
                            }else{
                                valMethod = " UpdateTransferenciaContas";
                            }
                            $.post('../../Controller/TransferenciaContas/TransferenciaContasController.php',
                                {method: valMethod,
                                codTransferencia: $("#codTransferencia").val(),
                                dtaMovimentacao: $("#dtaMovimentacao").val(),
                                vlrMovimentacao: $("#vlrMovimentacao").val(),
                                codContaOrigem: $("#codContaOrigem").val(),
                                codContaDestino: $("#codContaDestino").val()
                            }, function(data){
                                data = eval('('+data+')');
                                if (data==1){
                                    $.post('../../Controller/TransferenciaContas/TransferenciaContasController.php',
                                        {method: 'ListarTransferencias',
                                        nroAnoReferencia: $("#nroAnoReferencia").val(),
                                        nroMesReferencia: $("#nroMesReferencia").val(),
                                        ordenacao: $("#ordenacao").val(),
                                        orientaOrdenacao: $("#orientaOrdenacao").val()},function(data){

                                            data = eval('('+data+')');

                                            if (data!=null){

                                                carregaTabela(data);

                                            }
                                    });
                                    $( "#dialogInformacao" ).html('Transferência salva com sucesso!');
                                    $("#btnOK").show();
                                    window.setTimeout(function() { $( "#dialogInformacao" ).dialog( "close" ); }, 1500);
                                }else{
                                    $( "#dialogInformacao" ).html('Erro ao salvar Transferência!');
                                    $("#btnOK").show();
                                }
                                $("#codTransferencia").val('0');
                                $("#dtaTransferencia").val('');
                                $("#vlrTransferencia").val('');
                                $("#codContaOrigem").val('');
                                $("#codContaDestino").val('');
                            });

                        }
                }
        ]
    });

    $( "#btnPesquisa" ).click(function( event ) {
        $("#tabela").html('Sem Dados para a pesquisa');
        $.post('../../Controller/TransferenciaContas/TransferenciaContasController.php',
            {method: 'ListarTransferencias',
            nroAnoReferencia: $("#nroAnoReferencia").val(),
            nroMesReferencia: $("#nroMesReferencia").val(),
            ordenacao: $("#ordenacao").val(),
            orientaOrdenacao: $("#orientaOrdenacao").val()},function(data){

                data = eval('('+data+')');

                if (data!=null){

                    carregaTabela(data);

                }
        });
    });
    $( "#btnNovo" ).click(function( event ) {
        CadTransferencia('AddTransferenciaContas', '0', '', '0', '', '');
    });
});

function preencheCampos(obj, valor){
    obj.value=valor;
}
function carregaModal(){
   $( "#CadastroForm" ).dialog( "open" );
}
function carregaTabela(data){
    linha = '<table border="0" width="100%" cellpadding="0" cellspacing="0" id="resultado"> '+
            '  <tr bgcolor="#E8E8E8"> '+
            "    <th class=\"coluna150px\"><a href=\"javascript:OrdenarListaReceita('DTA_MOVIMENTACAO', '"+$("#orientaOrdenacao").val()+"');\">Data</a></th> "+
            "    <th class=\"coluna75px\"><a href=\"javascript:OrdenarListaReceita('DSC_CONTA_ORIGEM', '"+$("#orientaOrdenacao").val()+"');\">Conta Origem</a></th> "+
            "    <th class=\"coluna150px\"><a href=\"javascript:OrdenarListaReceita('DSC_CONTA_DESTINO', '"+$("#orientaOrdenacao").val()+"');\">Conta Destino</a></th> "+
            "    <th class=\"coluna75px\" align=\"right\"><a href=\"javascript:OrdenarListaReceita('VLR_MOVIMENTACAO', '"+$("#orientaOrdenacao").val()+"');\">Valor</a></th> "+
            '    <th class="coluna75px" align="right">&nbsp;</th> '+
            '    <th class="coluna75px" align="right">&nbsp;</th> '+
            '  </tr> ';
            cor='';
            total=0;
            result_receitas = data;

            for(i=0;i<result_receitas.length;i++){

                id = i;
                if (cor=="#E8E8E8"){
                    cor="#FFFFFF";
                }else{
                    cor="#E8E8E8";
                }
                linha = linha + ' <tr bgcolor="'+cor+'" class="trcor" id="'+id+'"> '+
                        ' <td>'+result_receitas[i].dtaMovimentacao+'</td> '+
                        ' <td>'+result_receitas[i].dscContaOrigem+'</td> '+
                        ' <td>'+result_receitas[i].dscContaDestino+'</td> '+
                        ' <td align=\"right\">'+result_receitas[i].vlrMovimentacao+'</td> '+
                        " <td><a href=\"javascript:deletarTransferencia("+id+","+
                                                                  " "+result_receitas[i].nroSequencial+","+
                                                                  " '"+result_receitas[i].vlrMovimentacao+"');\"><img src='../../Resources/images/delete.png' width='15' heigth='15'></a></td> "+
                        " <td><a href=\"javascript:CadTransferencia('UpdateTransferenciaContas', "+result_receitas[i].nroSequencial+","+
                                                                 " '"+result_receitas[i].vlrMovimentacao+"',"+
                                                                 " '"+result_receitas[i].codContaOrigem+"',"+
                                                                 " '"+result_receitas[i].codContaDestino+"',"+
                                                                 " '"+result_receitas[i].dtaMovimentacao+"');\"><img src='../../Resources/images/edit.png' width='15' heigth='15'></a></td> "+
                    ' </tr>';
                valor = result_receitas[i].vlrMovimentacao;
                valor = valor.replace('.','');
                valor = valor.replace(',','.');
                total = parseFloat(total)+parseFloat(valor);
            }
            linha = linha + ' <tr><td colspan="3" align="right">Total</td> '+
                '<td align="right"><input id="vlrTotalTransferencia" name="vlrTotalTransferencia" '+
                                                    'style="border:0px; '+
                                                           'background-color: transparent;" '+
                                                    'readonly '+
                                                    'value="'+Formata(total,2,'.',',')+'"></td> '+
                '<td class="coluna25px"><br></td> '+
                '<td class="coluna25px"><br></td> '+
                '<td class="coluna25px"><br></td> '+
            '</tr> '+
        '</table> ';
    $("#tabela").html(linha);
}

function deletarTransferencia(trId, codTransferencia, vlrTransferencia){
    $( "#dialogInformacao" ).html('Aguarde Removendo a transferência');
    $("#btnOK").hide();
    $( "#dialogInformacao" ).dialog( "open" );
    $.post('../../Controller/TransferenciaContas/TransferenciaContasController.php',
          {method:'DeletarTransferencia',
           codTransferencia: codTransferencia}, function(data){

                if(data==1){
                    $('#' + trId).remove();
                    valor = $("#vlrTotalTransferencia").val().replace(',', '');
                    valor = valor - vlrTransferencia;
                    $("#vlrTotalTransferencia").val(valor);
                    $("#vlrTotalTransferencia").val(Formata($("#vlrTotalTransferencia").val(),2,'.',','));
                    $( "#dialogInformacao" ).html('Transferência removida com sucesso!');
                    $("#btnOK").show();
                }else{
                    $( "#dialogInformacao" ).html('Erro ao remover transferência!');
                    $("#btnOK").show();
                }
           }
    );
}

function CadTransferencia(method, nroSequencial, vlrMovimentacao, codContaOrigem, codContaDestino, dtaMovimentacao){
     $( "#CadastroForm" ).dialog( "open" );
     $("#method").val(method);
     $("#codTransferencia").val(nroSequencial);
     $("#vlrMovimentacao").val(vlrMovimentacao);
     $("#codContaOrigem").val(codContaOrigem);
     $("#codContaDestino").val(codContaDestino);
     $("#dtaMovimentacao").val(dtaMovimentacao);
}

function OrdenarListaReceita(campo, orientacao){
        if (campo!=$("#ordenacao").val()){
            $("#orientaOrdenacao").val('ASC');
            $("#ordenacao").val(campo);
        }else{
            if (orientacao=='ASC'){
                $("#orientaOrdenacao").val('DESC');
            }else{
                $("#orientaOrdenacao").val('ASC');
            }
        }
        $.post('../../Controller/TransferenciaContas/TransferenciaContasController.php',
            {method: 'ListarTransferencias',
            nroAnoReferencia: $("#nroAnoReferencia").val(),
            nroMesReferencia: $("#nroMesReferencia").val(),
            ordenacao: campo,
            orientaOrdenacao: $("#orientaOrdenacao").val()},function(data){

                data = eval('('+data+')');

                if (data!=null){

                    carregaTabela(data);

                }
        });
}