$(function() {
    $( "#dialogInformacao" ).dialog({
            autoOpen: false,
            width: 450,
            show: 'explode',
            hide: 'explode',
            title: 'Mensagem',
            modal: true,
            buttons: [
                    {
                            text: "Ok",
                            click: function() {
                                    $( this ).dialog( "close" );
                            }
                    }
            ]
    });
    $( "#ListaContasBancarias" ).dialog({
            autoOpen: false,
            width: 450,
            show: 'explode',
            hide: 'explode',
            title: 'Lista de Contas Bancárias',
            modal: true,
            buttons: [
                    {
                            text: "Ok",
                            click: function() {
                                    $( this ).dialog( "close" );
                            }
                    }
            ]
    });
    $( "#CadastroForm" ).dialog({
            autoOpen: true,
            width: 400,
            title: 'Cadastro de Contas Bancárias',
            buttons: [
                {
                    text: "Salvar",
                    click: function() {
                        if ($('#codigo').val()==0){
                            $('#method').val('AddContaBancaria');
                        }else{
                            $('#method').val('UpdateContaBancaria');
                        }
                        $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
                            {method: $("#method").val(),
                            codigo: $("#codigo").val(),
                            nmeBanco: $("#nmeBanco").val(),
                            nroAgencia: $("#nroAgencia").val(),
                            nroConta: $("#nroConta").val()}, function(data){
                            data = eval('('+data+')');
                            if (data==1){
                                $( "#dialogInformacao" ).html('Conta salva com sucesso!');
                                $( "#dialogInformacao" ).dialog( "open" );
                            }else{
                                $( "#dialogInformacao" ).html('Erro ao salvar conta!');
                                $( "#dialogInformacao" ).dialog( "open" );
                            }
                        });
                    }
                },
                {
                    text: "Listar Contas",
                    click: function() {
                        $("#ListaContasBancarias").attr('style', 'text-align:center;');
                        $("#btnOK").hide();
                        $("#ListaContasBancarias").html('<img src="../../Resources/images/carregando.gif">');
                        $("#ListaContasBancarias").dialog("open");
                        $('#method').val('ListarContasBancarias');
                        
                        $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
                            {method: $("#method").val()}, function(data){
                            data = eval('('+data+')');
                            MontaTabelaContas(data);
                        });
                    }
                }
            ],
        close: function(ev, ui) { window.location='../MenuPrincipal.php'; }
    });

});
function preencheCampos(obj, valor){
    obj.value=valor;
}
function carregaModal(){
   $( "#CadastroForm" ).dialog( "open" );
}

function MontaTabelaContas(data){
    $( "#ListaContasBancarias" ).html( "" );
    tabela = '<table width="100%">';
    tabela += '    <tr>';
    tabela += '        <td>Conta</td>';
    tabela += '        <td>&nbsp;</td>';
    tabela += '        <td>&nbsp;</td>';
    tabela += '    </tr>';
    for (i=0;i<data.length;i++){
        tabela += '    <tr>';
        tabela += '        <td>'+data[i].CONTA+'</td>';
        tabela += "        <td><a href=\"javascript:EditaConta("+data[i].COD_CONTA+",\n\
                                                              '"+data[i].NME_BANCO+"',\n\
                                                              '"+data[i].NRO_CONTA+"',\n\
                                                              '"+data[i].NRO_AGENCIA+"')\">\n\
                                  <img src=\"../../Resources/images/edit.png\" width=\"25\" height=\"25\"></a></td>";
        tabela += "        <td><a href=\"javascript:RemoveConta("+data[i].COD_CONTA+")\">\n\
                                  <img src=\"../../Resources/images/delete.png\" width=\"25\" height=\"25\"></a></td>";
        tabela += '    </tr>';
    }
    $( "#ListaContasBancarias" ).html( tabela );
}

function EditaConta(codConta, nmeBanco, nroConta, nroAgencia){
    $("#codigo").val(codConta);
    $("#nmeBanco").val(nmeBanco);
    $("#nroAgencia").val(nroAgencia);
    $("#nroConta").val(nroConta);
    $( "#ListaContasBancarias" ).dialog( "close" );
}

function RemoveConta(codConta){
    $('#method').val('RemoveContaBancaria');
    $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
        {method: $("#method").val(),
        codigo: codConta}, function(data){
        data = eval('('+data+')');
        if (data>0){
            $('#method').val('ListarContasBancarias');

            $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
                {method: $("#method").val()}, function(data){
                data = eval('('+data+')');
                MontaTabelaContas(data);               
            });
        }else{
            $( "#dialogInformacao" ).html('Erro ao remover conta!');
            $( "#dialogInformacao" ).dialog( "open" );
        }
    });
}