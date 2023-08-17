function CarregaAtalhos(){
    $("#divAtalhos").html("<span style='align:center;'>Aguarde, Carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></span>");
    ExecutaDispatch('MenuPrincipal', 'CarregaAtalhos', undefined, MontaTabelaAtalhos);
}

function MontaTabelaAtalhos(listaAtalhos){
    listaAtalhos = listaAtalhos[1];
    grid = '';
    if (listaAtalhos!=null) {
        j=0;
        for(i=0;i<listaAtalhos.length;i++){
            if (j==0) {
                grid = '<div class="row">';
            }
            grid += '<div class="col-1 text-center">';
            grid += '   <button class="btn btn-link border-white" onClick="javascript:chamaAtalho(\''+listaAtalhos[i].NME_CONTROLLER+'\', \''+listaAtalhos[i].NME_METHOD+'\')" title="'+listaAtalhos[i].DSC_MENU+'">';
            grid += '       <i class="'+listaAtalhos[i].DSC_ICONE_ATALHO+' fa-3x"></i> ';
            grid += '   </button>';
            grid += '   <span>'+listaAtalhos[i].DSC_MENU+'</span>';
            grid += '</div>';
            j++;
            if (j==12){
                grid += "</div>";
                j=0;
            }
        }
    }
    $("#divAtalhos").html(grid);
}

function chamaAtalho(controller, method){    
    window.location.href = "/sorc/Dispatch.php?controller="+controller+"&method="+method;
}

function CarregaGrafico(){
    ExecutaDispatch('MenuPrincipal', 'CarregaDespesasReceitasAnoAtual', undefined, MontaGrafico);
}

function MontaGrafico(dados) {
    var lista = dados[1];
    let arrLabels = [];
    let arrReceitas = [];
    let arrDespesasAbertas = [];
    let arrDespesas = [];
    for(var i in lista) {
        arrLabels.push(lista[i].DSC_MES);
        arrReceitas.push(lista[i].VLR_RECEITA);
        arrDespesasAbertas.push(lista[i].VLR_DESPESA_ABERTA);
        arrDespesas.push(lista[i].VLR_DESPESA);
    }
    CriarGraficoBarrasNovo('graficoResumo', arrLabels, arrReceitas, arrDespesas, arrDespesasAbertas);
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
    CarregaAtalhos();   
    CarregaGrafico();
});
