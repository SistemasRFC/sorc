$(function() {
    $( "#dialogInformacao" ).dialog({
        autoOpen: false,
        width: 450,
        show: 'explode',
        hide: 'explode',
        title: 'Informação',
        modal: true,
        buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
        ]/*,
        close: function(ev, ui) { $("#CadastroForm").dialog("close");}*/
    });
    $( "#CadastroForm" ).dialog({
        autoOpen: true,
        width: "90%",
        position: [0,0],
        title: 'Relatório de tipo de despesas',
        close: function(ev, ui) { window.location='../MenuPrincipal.php'; }
    });

    $("#btnPesquisar").click(function(){
        $.post('../../Controller/Despesas/DespesasController.php',
            {method: 'ListarSomaTipoDespesas',
             nroAnoReferencia: $("#nroAnoReferencia").val(),
             nroMesReferencia: $("#nroMesReferencia").val(),
             tpoDespesa: $("#tpoDespesa").val(),
             indStatus: -1,
             ordenacao: 'DTA_DESPESA',
             orientaOrdenacao: 'ASC'}, function(data){
            data = eval('('+data+')');
            if (data!=null){
                carregaTabela(data);
                CarregaGrafico(data);
            }else{
                $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
                $("#btnOK").show();
            }
        });
    });
});

function carregaTabela(data){
    linha = '<table border="0" width="100%" cellpadding="0" cellspacing="0" id="resultado" class="tabela"> '+
            '  <thead>'+
            '  <tr bgcolor="#E8E8E8"> '+
            "    <th class=\"coluna150px\">Tipo de Despesa</th> "+
            "    <th class=\"coluna75px\" align='right'>Valor</th> "+
            '  </tr> '+
            '  </thead>'+
            '  <tbody> ';
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
                if (result_receitas[i].indDespesaPaga=='S'){
                    status = 'Despesa paga';
                }else{
                    status = 'Em aberto';
                }

                linha = linha + ' <tr bgcolor="'+cor+'" class="trcor" id="'+id+'"> '+
                        ' <td>'+result_receitas[i].dscTipoDespesa+'</td> '+
                        ' <td align="right">'+result_receitas[i].vlrDespesa+'</td> '+
                    ' </tr>';                
                
            }
            linha = linha + ' </tbody>'+
        '</table> ';
    $("#ListaDespesas").html(linha);    
}
function CarregaGrafico(Data) {
    // prepare chart data as an array
    total = 0;
    for (i=0;i<Data.length;i++){
        total = parseFloat(Data[i].vlrDespesa.replace(',', ''))+parseFloat(total);
    }
    for (i=0;i<Data.length;i++){
        Data[i].vlrDespesa = (parseFloat(Data[i].vlrDespesa.replace(',', ''))/parseFloat(total))*100;
        Data[i].dscTipoDespesa = Data[i].dscTipoDespesa+' '+Formata(Data[i].vlrDespesa,2,',','.')+'%';
    }
    console.log(Data);
    var source =
    {
        localdata: Data,
        datatype: "json",
        datafields: [
            { name: 'dscTipoDespesa' },
            { name: 'vlrDespesa' }
        ]        
    };
    var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
    // prepare jqxChart settings
    var settings = {
        title: "Gastos por Tipos de despesas",
        description: "",
        enableAnimations: true,
        showLegend: true,
        legendLayout: { left: 550, top: 140, width: 300, height: 300, flow: 'vertical' },
        padding: { left: -150, top: 5, right: 5, bottom: 5 },
        titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
        source: dataAdapter,
        colorScheme: 'scheme01',
        seriesGroups:
            [
                {
                    type: 'pie',
                    showLabels: true,
                    series:
                        [
                            {
                                dataField: 'vlrDespesa',
                                displayText: 'dscTipoDespesa',
                                labelRadius: 230,
                                initialAngle: 35,
                                radius: 205,
                                centerOffset: 0,
                                formatSettings: { sufix: ' %', decimalPlaces: 2 }
                            }
                        ]
                }
            ]
    };
    // setup the chart
    $('#jqxChart').jqxChart(settings);
};