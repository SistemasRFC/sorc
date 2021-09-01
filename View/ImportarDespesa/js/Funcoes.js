function CarregaGridDespesa(){
    $("#tdGrid").html('');
    $("#tdGrid").html('<div id="ListagemForm"></div>');
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
    $( "#dialogInformacao" ).jqxWindow("open");
    $.post('../../Controller/ImportarDespesa/ImportarDespesaController.php',
        {method: 'ListarDespesas',
        nroAnoReferencia: $("#nroAnoReferencia").val(),
        nroMesReferencia: $("#nroMesReferencia").val(),
        indStatus: $("#indStatus").val(),
        tpoDespesa: $("#tpoDespesa").val()},function(data){

            data = eval('('+data+')');
            if (data[0]){

                MontaTabelaDespesa(data[1]);
                totalValor = 0;
                for (i=0;i<data[1].length;i++){            
                    totalValor = parseFloat(totalValor)+parseFloat(data[1][i].VLR_DESPESA);
                }        
                totalValor = Formata(totalValor,2,'.',',');
                $("#vlrTotal").html(totalValor);                
                $( "#dialogInformacao" ).jqxWindow("close");      

            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
            }
    });
}
function MontaTabelaDespesa(listaDespesas){
    var nomeGrid = 'ListagemForm';
    var contextMenu = $("#jqxMenu").jqxMenu({ width: '120px', autoOpenPopup: false, mode: 'popup', theme: theme });
    var source =
    {
        localdata: listaDespesas,
        datatype: "json",
        datafields:
        [
            { name: 'COD_DESPESA', type: 'int' },
            { name: 'DTA_DESPESA', type: 'string' },
            { name: 'VLR_DESPESA', type: 'float' },
            { name: 'DSC_DESPESA', type: 'string' },
            { name: 'TPO_DESPESA', type: 'string' },
            { name: 'DSC_TIPO_DESPESA', type: 'string' },
            { name: 'COD_TIPO_DESPESA', type: 'int' },
            { name: 'CONTA', type: 'string' },
            { name: 'COD_CONTA', type: 'int' },
            { name: 'IND_DESPESA_PAGA', type: 'string' },
            { name: 'IND_PAGO', type: 'string' },
            { name: 'DTA_PAGAMENTO', type: 'string' },
            { name: 'QTD_PARCELAS', type: 'int' },
            { name: 'NRO_PARCELA_ATUAL', type: 'int' },
            { name: 'NRO_PARCELA_RESTANTES', type: 'int' },
            { name: 'IND_ORIGEM_DESPESA', type: 'string' }
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
          { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_DESPESA', columntype: 'textbox', width: 280},
          { text: 'Data', datafield: 'DTA_DESPESA', columntype: 'datetimeinput', width: 80},
          { text: 'Valor', columntype: 'numberinput', cellsalign: 'right', datafield: 'VLR_DESPESA', width: 80, cellsformat: "f2"},
          { text: 'Parcelas', columntype: 'number', cellsalign: 'right', datafield: 'QTD_PARCELAS', width: 80},
          { text: 'Parcela Atual', columntype: 'number', cellsalign: 'right', datafield: 'NRO_PARCELA_ATUAL', width: 80},
          { text: 'Parcelas Restantes', columntype: 'number', cellsalign: 'right', datafield: 'NRO_PARCELA_RESTANTES', width: 80},
          { text: 'Tipo', datafield: 'DSC_TIPO_DESPESA', columntype: 'textbox', width: 150},
          { text: 'Conta', datafield: 'CONTA', columntype: 'textbox', width: 150},
          { text: 'Status', datafield: 'IND_DESPESA_PAGA', columntype: 'textbox', width: 150}
        ]
    });
    $('#'+nomeGrid).on('rowselect', function (event) 
    {
        selectedrowindexes = $('#'+nomeGrid).jqxGrid('selectedrowindexes');
        $("#codDespesaSelecao").val('');
        for (i=0;i<selectedrowindexes.length;i++){            
            $("#codDespesaSelecao").val($("#codDespesaSelecao").val()+';'+$('#'+nomeGrid).jqxGrid('getrowdatabyid', selectedrowindexes[i]).COD_DESPESA);
        }    
    });
    
    $('#'+nomeGrid).on('rowunselect', function (event) 
    {
        selectedrowindexes = $('#'+nomeGrid).jqxGrid('selectedrowindexes');
        $("#codDespesaSelecao").val('');
        for (i=0;i<selectedrowindexes.length;i++){            
            $("#codDespesaSelecao").val($("#codDespesaSelecao").val()+';'+$('#'+nomeGrid).jqxGrid('getrowdatabyid', selectedrowindexes[i]).COD_DESPESA);
        }    
    });
    $("#dialogInformacao" ).jqxWindow("close");  
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