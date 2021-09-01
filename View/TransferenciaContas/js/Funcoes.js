var selectedrowindexes='';
var totalValor = 0;
var contextMenu = '';
var nomeGrid = 'ListagemForm';
function CadTransferenciaContas(method, codTransferencia, dtaMovimentacao, vlrMovimentacao, comboCodContaOrigem, comboCodContaDestino){
     $( "#CadastroForm" ).jqxWindow( "open" );
     $("#method").val(method);
     if (codTransferencia>0){
         $("#btnDeletar").show();
     }else{
         $("#btnDeletar").hide();
     }
     $("#codTransferencia").val(codTransferencia);
     $("#dtaMovimentacao").val(dtaMovimentacao);
     $("#vlrMovimentacao").val(vlrMovimentacao);
     $("#comboCodContaOrigem").val(comboCodContaOrigem);
     $("#comboCodContaDestino").val(comboCodContaDestino);
}

function CarregaGridTransferenciaContas(){
    $("#tdGrid").html('');
    $("#tdGrid").html('<div id="ListagemForm"></div>');
    //$("#tdMenu").html('');
    //$("#tdMenu").html('<div id="jqxMenu"><ul><li><a href="#">Importar</a></li><li><a href="#">Editar</a></li><li><a href="#">Excluir</a></li></ul></div>');
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
    $( "#dialogInformacao" ).jqxWindow("open");
    $.post('../../Controller/TransferenciaConta/TransferenciaContasController.php',
    {
        method: 'ListarTransferencias',
        nroAnoReferencia: $("#nroAnoReferencia").val(),
        nroMesReferencia: $("#nroMesReferencia").val()
    },function(data){

            data = eval('('+data+')');
            if (data[0]){

                MontaTabelaTransferenciaConta(data[1]);

                $("#vlrSelecionado").html('0');
                $( "#dialogInformacao" ).jqxWindow("close");      

            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
            }
    });
}
function MontaTabelaTransferenciaConta(listaDespesas){
    
    var source =
    {
        localdata: listaDespesas,
        datatype: "json",
        datafields:
        [
            { name: 'NRO_SEQUENCIAL', type: 'int' },
            { name: 'DSC_CONTA_ORIGEM', type: 'string' },
            { name: 'VLR_MOVIMENTACAO', type: 'float' },
            { name: 'DSC_CONTA_DESTINO', type: 'string' },
            { name: 'DTA_MOVIMENTACAO', type: 'string' },
            { name: 'COD_CONTA_ORIGEM', type: 'string' },
            { name: 'COD_CONTA_DESTINO', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 1200,
        source: dataAdapter,
        theme: theme,
        sortable: true,
        filterable: true,
        pageable: false,
        columnsresize: true,
        selectionmode: 'multiplerows',
        columns: [
          { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_CONTA_ORIGEM', columntype: 'textbox', width: 280},
          { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_CONTA_DESTINO', columntype: 'textbox', width: 280},
          { text: 'Data', datafield: 'DTA_MOVIMENTACAO', columntype: 'datetimeinput', width: 80},
          { text: 'Valor', columntype: 'numberinput', cellsalign: 'right', datafield: 'VLR_MOVIMENTACAO', width: 80, cellsformat: "f2"}
        ]
    });
    // events
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        CadTransferenciaContas('UpdateTransferenciaContas',
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).NRO_SEQUENCIAL,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_MOVIMENTACAO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_MOVIMENTACAO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA_ORIGEM,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA_DESTINO);
    });
    
    $("#dialogInformacao" ).jqxWindow("close");  
}

function deletarTransferenciaConta(codTransferencia){        
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, Removendo a despesa!");
    $( "#dialogInformacao" ).jqxWindow("open"); 
    $.post('../../Controller/TransferenciaConta/TransferenciaContasController.php',
        {method:'DeletarTransferencia',
         codTransferencia: codTransferencia}, function(data){
            data = eval('('+data+')');
            if(data[0]){
                CarregaGridTransferenciaContas();
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Transferencia removida com sucesso!');
                $( "#CadastroForm" ).jqxWindow( "close" );
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao remover despesa!');                
            }
         }
    );
}

function MontaComboFixo(nmeCombo, nmeSelect, seleciona){
    $("#"+nmeCombo).jqxDropDownList({ width: '200px', height: '25px'});
    $("#"+nmeCombo).jqxDropDownList('loadFromSelect', nmeSelect);  
    $("#"+nmeSelect).val(seleciona);
    var index = $("#"+nmeSelect)[0].selectedIndex;
    $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
    $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);    
    
    $("#"+nmeCombo).on('select', function (event) {
        var args = event.args;
        // select the item in the 'select' tag.
        var index = args.item.index;
        $("#"+nmeSelect).val(args.item.value);
        
    });  
    $("#"+nmeSelect).on('change', function (event) {
        updating = true;
        $("#"+nmeSelect).val(seleciona);
        var index = $("#"+nmeSelect)[0].selectedIndex;
        $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
        $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);
        updating = false;
    });    
}