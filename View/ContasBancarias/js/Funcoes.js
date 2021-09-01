function CadContaBancaria(method, codConta, nmeBanco, nroAgencia, nroConta, ativo){
     $( "#CadastroForm" ).jqxWindow( "open" );
     $("#method").val(method);
     $("#codConta").val(codConta);
     $("#nmeBanco").val(nmeBanco);
     $("#nroAgencia").val(nroAgencia);
     $("#nroConta").val(nroConta);   
     if (ativo){
         $("#indAtivo").jqxCheckBox('check');
     }else{
         $("#indAtivo").jqxCheckBox('uncheck');
     }
}
function CarregaGridConta(){
    $("#tdGrid").html('');
    $("#tdGrid").html('<div id="ListagemForm"></div>');
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
    $( "#dialogInformacao" ).jqxWindow("open");
    $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
        {method: 'ListarContasBancarias'},function(data){

            data = eval('('+data+')');
            if (data[0]){
                MontaTabelaConta(data[1]);         
                $( "#dialogInformacao" ).jqxWindow("close");      

            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
            }
    });
}
function MontaTabelaConta(listaContas){
    var nomeGrid = 'ListagemForm';
    var source =
    {
        localdata: listaContas,
        datatype: "json",
        datafields:
        [
            { name: 'COD_CONTA', type: 'int' },
            { name: 'NME_BANCO', type: 'string' },
            { name: 'NRO_CONTA', type: 'string' },
            { name: 'NRO_AGENCIA', type: 'string' },
            { name: 'CONTA', type: 'string' },
            { name: 'ATIVO', type: 'boolean' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 600,
        source: dataAdapter,
        theme: theme,
        sortable: true,
        filterable: true,
        pageable: false,
        columnsresize: true,
        selectionmode: 'singlerow',
        columns: [
          { text: 'Banco', datafield: 'NME_BANCO', columntype: 'textbox', width: 280},
          { text: 'Conta', datafield: 'NRO_CONTA', columntype: 'textbox', width: 80},
          { text: 'Agência', datafield: 'NRO_AGENCIA', columntype: 'textbox', width: 80},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 80}
        ]
    });
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        CadContaBancaria('UpdateContaBancaria',
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).NME_BANCO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).NRO_AGENCIA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).NRO_CONTA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).ATIVO);
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
