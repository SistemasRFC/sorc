$(function(){
    $( "#btnGrafico" ).click(function( event ) {
        CarregaGrafico(); 
    }); 
});
function MontaComboAno(){
    var source =
    {
        datatype: "json",
        type: "POST",
        datafields: [
            { name: 'NRO_ANO_REFERENCIA', type: 'string'}
        ],
        cache: false,
        url: '../../Controller/Relatorios/RelResumoAnualController.php',
        data:{
              method: 'ListarAnos'
        }
    };        
    var dataAdapter = new $.jqx.dataAdapter(source,{
        loadComplete: function (records){         
            $("#comboNroAnoReferencia").jqxDropDownList(
            {
                source: records,
                theme: theme,
                width: 200,
                height: 25,
                selectedIndex: 0,
                displayMember: 'NRO_ANO_REFERENCIA',
                valueMember: 'NRO_ANO_REFERENCIA'
            });  
        },
        async:true
                     
    });  
    dataAdapter.dataBind();    
}

function CarregaGrafico(){
    $.post('../../Controller/Relatorios/RelResumoAnualController.php',
        {method: 'CarregaRegistros',
         nroAnoReferencia: $("#comboNroAnoReferencia").val()}, function(data){
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
    var source =
    {
        localdata: Data,
        datatype: "json",
        datafields: [
            { name: 'MES' },
            { name: 'ANO' },
            { name: 'VALOR' }
        ]        
    };
    var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
    // prepare jqxChart settings
    var settings = {
                title: "Resumo Anual de gastos",
                description: "",
                enableAnimations: true,
                showLegend: true,
                padding: { left: 10, top: 5, right: 10, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: dataAdapter,
                xAxis:
                    {
                        dataField: 'MES',
                        showTickMarks: true,
                        valuesOnTicks: false,
                        tickMarksInterval: 1,
                        tickMarksColor: '#888888',
                        unitInterval: 1,
                        gridLinesInterval: 1,
                        gridLinesColor: '#888888',
                        axisSize: 'auto'
                    },
                colorScheme: 'scheme05',
                seriesGroups:
                    [
                        {
                            formatSettings:
                            {
                                prefix: 'R$ ',
                                decimalPlaces: 2,
                                decimalSeparator: ',',
                                thousandsSeparator: '.',
                                sufix: ''
                            },
                            type: 'line',
                            showLabels: true,
                            valueAxis:
                            {
                                unitInterval: 5000,
                                minValue: 0,
                                maxValue: 25000,
                                description: 'Valor Gasto',
                                axisSize: 'auto',
                                tickMarksColor: '#888888'
                            },
                            series: [
                                    { dataField: 'VALOR', displayText: 'Meses do ano', symbolType: 'square'}
                                ]
                        }
                    ]
            };
    // setup the chart
    $('#jqxChart').jqxChart(settings);  
};
$(document).ready(function(){
    MontaComboAno();    
});