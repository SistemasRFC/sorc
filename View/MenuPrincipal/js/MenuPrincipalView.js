$(function() {
    $( "#dialogDespesa" ).jqxWindow({
        autoOpen: false,
        isModal: true,
        theme: theme,
        width: $(window).width()-100,
        height: $(window).height()-200,
        position: 'center',
        title: 'Lista'
    });
    
});
function CarregaAtalhos(){
    $("#divAtalhos").html("<span style='align:center;'>Aguarde, Carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></span>");
    ExecutaDispatch('MenuPrincipal', 'CarregaAtalhos', undefined, MontaTabelaAtalhos);
    // $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php',
    //     {
    //         method: 'CarregaAtalhos'
    //     },
    //     function(listaAtalhos){
    //          listaAtalhos = eval ('('+listaAtalhos+')');
    //          if (listaAtalhos[0]==true){
    //              MontaTabelaAtalhos(listaAtalhos[1]);
    //          }else{
    //              $("#divAtalhos").html("<span style='align:center;'>Erro ao buscar atalhos!<br>"+listaAtalhos[1]);
    //          }
    //     }
    // );
}

function MontaTabelaNoticias(listaNoticias){
    if (listaNoticias!=null){
        tabela = '<table width="100%">';
        for(i=0;i<listaNoticias.length;i++){
            tabela = tabela + '<tr><td style="font-size:20;font-family: arial, helvetica, serif;height:10%;">'+listaNoticias[i].DTA_NOTICIA+' - '+listaNoticias[i].DSC_TITULO+'</td></tr>';
            tabela = tabela + '<tr><td>'+listaNoticias[i].TXT_NOTICIA+'</td></tr>';
            tabela = tabela + '<tr><td style="border-bottom:1px solid #000000;"><br><br></td></tr>';
        }
        tabela = tabela + '</table>';
    }else{
        tabela = '';
    }
    $("#divNoticias").html(tabela);
}
function chamaAtalho(controller, method){    
    window.location.href = controller+'?method='+method;
}
function MontaTabelaAtalhos(listaAtalhos) {
    listaAtalhos = listaAtalhos[1];
    if (listaAtalhos!=null){
        tabela = '<table width="100%" border="0">';
        colunas = 5;
        j=5;
        for(i=0;i<listaAtalhos.length;i++){
            if (j==colunas){
                tabela = tabela + "<tr style=''><td style='font-size:20;font-family: arial, helvetica, serif;height:10%;padding-top:20px;'>"
                j=0;
            }
            tabela = tabela + "<a style='padding-left:45px;' href='"+listaAtalhos[i].NME_CONTROLLER+"?method="+listaAtalhos[i].NME_METHOD+"'><img src='"+listaAtalhos[i].DSC_CAMINHO_IMAGEM+"' title='"+listaAtalhos[i].DSC_MENU_W+"' width='65' height='65'></a>";
            j++;
            if (j==colunas){
                tabela = tabela + "</td></tr>";
            }
        }
        tabela = tabela + '</table>';
    }else{
        tabela = '';
    }
    $("#divAtalhos").html(tabela);
}
function CarregaGrafico(){
    ExecutaDispatch('TipoDespesa', 'ListarSomaTipoDespesas', undefined, MontaGrafico);

    // $.post('../../Controller/Despesas/DespesasController.php',
    //     {method: 'ListarSomaTipoDespesas',
    //      nroAnoReferencia: '',
    //      nroMesReferencia: '',
    //      tpoDespesa: $("#tpoDespesa").val(),
    //      indStatus: -1,
    //      ordenacao: 'DTA_DESPESA',
    //      orientaOrdenacao: 'ASC'}, function(data){
    //     data = eval('('+data+')');
    //     if (data[0]){
    //         MontaGrafico(data[1]);
    //     }else{
    //         $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
    //         $("#btnOK").show();
    //     }
    // });
}
function MontaGrafico(Data) {
    Data = Data[1];
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
//    var settings = {
//        title: "Resumo Mensal de Gastos",
//        description: "",
//        enableAnimations: true,
//        showLegend: true,
//        legendLayout: { left: 400, top: 140, width: 300, height: 300, flow: 'vertical' },
//        padding: { left: -150, top: 5, right: 5, bottom: 5 },
//        titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
//        source: dataAdapter,
//        colorScheme: 'scheme01',
//        seriesGroups:
//            [
//                {
//                    type: 'pie',
//                    showLabels: true,
//                    series:
//                        [
//                            {
//                                dataField: 'VALOR',
//                                displayText: 'DSC_TIPO_DESPESA',
//                                labelRadius: 170,
//                                initialAngle: 35,
//                                radius: 155,
//                                centerOffset: 0,
//                                formatSettings: { sufix: ' %', decimalPlaces: 2 }
//                            }
//                        ]
//                }
//            ]
//    };
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
            CarregaDespesas(dataAdapter.records[e.elementIndex].COD_TIPO_DESPESA);
            console.log(e.elementIndex);
            console.log(e.serie.dataField);
        }
    }    
};
function CarregaDespesas(codTipoDespesa){
    $( "#dialogDespesa" ).jqxWindow('setContent', '');
    $( "#dialogDespesa" ).jqxWindow('setContent', '<div id="grid"></div>');
    $( "#dialogDespesa" ).jqxWindow('open');
    data = new Date();
    ano = data.getFullYear();
    mes = data.getMonth();
    mes++;
    if (mes<10){
        mes = '0'+mes;
    }    
    $.post('../../Controller/Despesas/DespesasController.php',
        {method: 'ListarDespesas',
        nroAnoReferencia: ano,
        nroMesReferencia: mes,
        indStatus: '-1',
        tpoDespesa: codTipoDespesa}, function(data){
        data = eval('('+data+')');
        if (data[0]){
            MontaTabela(data[1]);
        }else{
            $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
            $("#btnOK").show();
        }
    });    
}

function MontaTabela(listaDespesas){
    var nomeGrid = 'grid';
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
$(document).ready(function() {
    // ExecutaDispatch('MenuPrincipal', 'CarregaDadosUsuario', undefined, undefined);
    CarregaAtalhos();   
    CarregaGrafico();
});
