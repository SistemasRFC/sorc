function CadTipoDespesa(method, codTipoDespesa, dscTipoDespesa, vlrPiso, vlrTeto, ativo, investimento){
     $( "#CadastroForm" ).jqxWindow( "open" );
     $("#method").val(method);
     $("#codTipoDespesa").val(codTipoDespesa);
     $("#dscTipoDespesa").val(dscTipoDespesa);
     $("#vlrPiso").val(vlrPiso);
     $("#vlrTeto").val(vlrTeto);   
     if (ativo){
         $("#indAtivo").jqxCheckBox('check');
     }else{
         $("#indAtivo").jqxCheckBox('uncheck');
     }
     if (investimento){
         $("#indInvestimento").jqxCheckBox('check');
     }else{
         $("#indInvestimento").jqxCheckBox('uncheck');
     }     
}
function CarregaGridTipoDespesa(){
    $("#tdGrid").html('');
    $("#tdGrid").html('<div id="ListagemForm"></div>');
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
    $( "#dialogInformacao" ).jqxWindow("open");
    $.post('../../Controller/TipoDespesa/TipoDespesaController.php',
        {method: 'ListarTiposDespesas'},function(data){

            data = eval('('+data+')');
            if (data[0]){
                MontaTabelaTipoDespesa(data[1]);         
                $( "#dialogInformacao" ).jqxWindow("close");      

            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
            }
    });
}
function MontaTabelaTipoDespesa(listaTipoDespesa){
    var nomeGrid = 'ListagemForm';
    var source =
    {
        localdata: listaTipoDespesa,
        datatype: "json",
        datafields:
        [
            { name: 'COD_TIPO_DESPESA', type: 'int' },
            { name: 'DSC_TIPO_DESPESA', type: 'string' },
            { name: 'VLR_PISO', type: 'float' },
            { name: 'VLR_TETO', type: 'float' },
            { name: 'ATIVO', type: 'boolean' },
            { name: 'INVESTIMENTO', type: 'boolean' }
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
          { text: 'Tipo de Despesa', datafield: 'DSC_TIPO_DESPESA', columntype: 'textbox', width: 280},
          { text: 'Piso', columntype: 'numberinput', cellsalign: 'right', datafield: 'VLR_PISO', width: 80, cellsformat: "f2"},
          { text: 'Teto', columntype: 'numberinput', cellsalign: 'right', datafield: 'VLR_TETO', width: 80, cellsformat: "f2"},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 80}
        ]
    });
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        CadTipoDespesa('UpdateTipoDespesa',
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_TIPO_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DSC_TIPO_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_PISO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_TETO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).ATIVO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).INVESTIMENTO);
    });
    $("#dialogInformacao" ).jqxWindow("close");  
}
