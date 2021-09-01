var selectedrowindexes='';
var totalValor = 0;
var contextMenu = '';
var nomeGrid = 'ListagemForm';
function CadDespesa(method, codDespesa, dscDespesa, vlrDespesa, tpoDespesa, qtdParcelas, nroParcelaAtual, codConta, dtaDespesa, indPago, dtaPago){
    $( "#CadastroForm" ).jqxWindow( "open" );
    $("#method").val(method);
    if (codDespesa>0){
        $("#btnDeletar").show();
        if(indPago=='S'){
            $("#trDtaDespesaPaga").show("slow");
        }else{
            $("#trDtaDespesaPaga").hide("slow");
        }        
    }else{
        $("#btnDeletar").hide();
        $("#trDtaDespesaPaga").hide("slow");
    }
    $("#codDespesa").val(codDespesa);
    $("#dscDespesa").val(dscDespesa);
    $("#dtaDespesa").val(dtaDespesa);
    $("#dtaPagamento").val(dtaPago);
    $("#qtdParcelas").val(qtdParcelas);
    $("#nroParcelaAtual").val(nroParcelaAtual);     
    vlrDespesa = String(vlrDespesa).replace('.',',');     
    $("#vlrDespesa").val(vlrDespesa);
    $("#comboCodConta").val(codConta);
    $("#comboCodTipoDespesa").val(tpoDespesa);
    if (indPago=='S'){
        $("#indDespesaPaga").attr('checked');
    }else{
        $("#indDespesaPaga").removeAttr('checked');
    }          
}

function CarregaGridDespesa(){
    $("#tdGrid").html('');
    $("#tdGrid").html('<div id="ListagemForm"></div>');
    //$("#tdMenu").html('');
    //$("#tdMenu").html('<div id="jqxMenu"><ul><li><a href="#">Importar</a></li><li><a href="#">Editar</a></li><li><a href="#">Excluir</a></li></ul></div>');
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
    $( "#dialogInformacao" ).jqxWindow("open");
    $.post('../../Controller/Despesas/DespesasController.php',
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
                $("#vlrSelecionado").html('0');
                $( "#dialogInformacao" ).jqxWindow("close");      

            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
            }
    });
}
function MontaTabelaDespesa(listaDespesas){
    
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
    // events
    $('#'+nomeGrid).on('rowclick', function (event)
    {
        var args = event.args;
        var row = args.rowindex;
        $("#codDespesa").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_DESPESA);
        $("#dscDespesa").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DSC_DESPESA);
        $("#dtaDespesa").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_DESPESA);
        $("#vlrDespesa").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_DESPESA);
        $("#qtdParcelas").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).QTD_PARCELAS);
        $("#nroParcelaAtual").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).NRO_PARCELA_ATUAL);
        $("#comboCodConta").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA);
        $("#comboCodTipoDespesa").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_TIPO_DESPESA);
        $("#dtaPagamento").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_PAGAMENTO);       
        $("#indAtivo").prop("checked", $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).IND_PAGO);       
        if (event.args.rightclick) {

            $("#"+nomeGrid).jqxGrid('selectrow', event.args.rowindex);
            var scrollTop = $(window).scrollTop();
            var scrollLeft = $(window).scrollLeft();
            contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
            return false;
        }        
    });
    $('#'+nomeGrid).on('rowselect', function (event) 
    {
        selectedrowindexes = $('#'+nomeGrid).jqxGrid('selectedrowindexes');
        soma = 0;
        for (i=0;i<selectedrowindexes.length;i++){            
            soma = parseFloat(soma)+parseFloat($('#'+nomeGrid).jqxGrid('getrowdatabyid', selectedrowindexes[i]).VLR_DESPESA);            
        }    
        AtualizaValores(soma);
    });
    
    $('#'+nomeGrid).on('rowunselect', function (event) 
    {
        selectedrowindexes = $('#'+nomeGrid).jqxGrid('selectedrowindexes');
        soma = 0;
        for (i=0;i<selectedrowindexes.length;i++){            
            soma = parseFloat(soma)+parseFloat($('#'+nomeGrid).jqxGrid('getrowdatabyid', selectedrowindexes[i]).VLR_DESPESA);
        }    
        AtualizaValores(soma);
    });
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {
        var args = event.args;
        CadDespesa('UpdateDespesa',
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DSC_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).TPO_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).QTD_PARCELAS,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).NRO_PARCELA_ATUAL,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_DESPESA,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).IND_PAGO,
                   $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_PAGAMENTO);
    });
    
    $("#dialogInformacao" ).jqxWindow("close");  
}

function ImportarDespesa(codDespesa, dtaDespesa){
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, Removendo a despesa!");
    $( "#dialogInformacao" ).jqxWindow("open"); 
    $.post('../../Controller/Despesas/DespesasController.php',
        {method:'ImportarDespesa',
         codDespesa: codDespesa,
         dtaDespesa: dtaDespesa,
         qtdParcelas: 0,
         nroParcelaAtual:0}, function(data){
            data = eval('('+data+')');
            if(data[0]){
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Despesa importada com sucesso!'); 
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    CarregaGridTurma();
                },"2000");                
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao importada despesa! '+data[1]);                
            }
         }
    );
}
function AtualizaValores(soma){
    soma = String(soma);
    soma = soma.replace(',','');
    soma = soma.replace(',','.');   
    totalValor = String(totalValor);
    totalValor = totalValor.replace(',',''); 
    totalValor = totalValor.replace(',','.');             
    total = totalValor;
    total = parseFloat(total)-parseFloat(soma);      
    soma = Formata(soma,2,'.',',');
    total = Formata(total,2,'.',',');        
    $("#vlrSelecionado").html(soma);
    $("#vlrTotal").html(total);
}

function deletarDespesa(codDespesa){        
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, Removendo a despesa!");
    $( "#dialogInformacao" ).jqxWindow("open"); 
    $.post('../../Controller/Despesas/DespesasController.php',
        {method:'DeletarDespesa',
         codDespesa: codDespesa}, function(data){
            data = eval('('+data+')');
            if(data[0]){
                CarregaGridDespesa();
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Despesa removida com sucesso!');
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

function CarregaGrafico(){
    $("#GraficoForm").jqxWindow('open');
    $.post('../../Controller/Despesas/DespesasController.php',
        {method: 'ListarSomaTipoDespesas',
         nroAnoReferencia: $("#nroAnoReferencia").val(),
         nroMesReferencia: $("#nroMesReferencia").val(),
         tpoDespesa: $("#tpoDespesa").val(),
         indStatus: -1,
         ordenacao: 'DTA_DESPESA',
         orientaOrdenacao: 'ASC'}, function(data){
        data = eval('('+data+')');
        if (data[0]){
            MontaGrafico(data[1]);
        }else{
            $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
            $("#btnOK").show();
        }
    });
}
function MontaGrafico(Data) {
    // prepare chart data as an array
    total = 0;
    for (i=0;i<Data.length;i++){
        total = parseFloat(Data[i].VALOR.replace(',', ''))+parseFloat(total);
    }
    for (i=0;i<Data.length;i++){
        Data[i].VALOR = (parseFloat(Data[i].VALOR.replace(',', ''))/parseFloat(total))*100;
        Data[i].DSC_TIPO_DESPESA = Data[i].DSC_TIPO_DESPESA+' '+Formata(Data[i].VALOR,2,',','.')+'%';
    }
    console.log(Data);
    var source =
    {
        localdata: Data,
        datatype: "json",
        datafields: [
            { name: 'DSC_TIPO_DESPESA' },
            { name: 'COD_TIPO_DESPESA' },
            { name: 'VALOR' }
        ]        
    };
    var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
    // prepare jqxChart settings
    var settings = {
        title: "Despesas por Tipo",
        description: "",
        enableAnimations: true,
        showLegend: false,
        legendLayout: { left: 400, top: 140, width: 300, height: 300, flow: 'vertical' },
        padding: { left: 5, top: 5, right: 10, bottom: 5 },
        titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
        source: dataAdapter,
        colorScheme: 'scheme01',
        xAxis:
                    {
                        dataField: 'DSC_TIPO_DESPESA',
                        showGridLines: true,
                        flip: false
                    },        
        seriesGroups:
            [
                {
                    type: 'column',
                    valueAxis:
                    {
                        unitInterval: 50,
                        minValue: 0,
                        maxValue: 100,
                        displayValueAxis: true,
                    },
                    showLabels: true,
                    series: [
                            { 
                                dataField: 'VALOR',
                                displayText: 'Tipos ',
                                labelRadius: 170,
                                initialAngle: 35,
                                radius: 155,
                                centerOffset: 0,
                                formatSettings: { sufix: ' %', decimalPlaces: 2 } }
                        ]
                }
            ]
    };    
    // setup the chart
    $('#jqxChart').jqxChart(settings);
    var groups = $('#jqxChart').jqxChart('seriesGroups');
    
    // add a click event handler function to the 1st group    
    if (groups.length > 0)
    {
        groups[0].click = function(e)
        {   
            $("#comboTpoDespesa").val(dataAdapter.records[e.elementIndex].COD_TIPO_DESPESA);
            CarregaGridDespesa();
            $("#GraficoForm").jqxWindow('close');
        }
    }    
};