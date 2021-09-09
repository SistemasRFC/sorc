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
        url: '../../Controller/Relatorios/RelReceitasXDespesasMensalController.php',
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
            $("#comboNroAnoReferencia").val(new Date().getFullYear());
        },
        async:true
                     
    });  
    dataAdapter.dataBind();    
}

function MontaComboMes(){
    var source =
    {
        datatype: "json",
        type: "POST",
        datafields: [
            { name: 'NRO_MES_REFERENCIA', type: 'string'},
            { name: 'DSC_MES_REFERENCIA', type: 'string'}
        ],
        cache: false,
        url: '../../Controller/Relatorios/RelReceitasXDespesasMensalController.php',
        data:{
              method: 'ListarMeses'
        }
    };        
    var dataAdapter = new $.jqx.dataAdapter(source,{
        loadComplete: function (records){         
            $("#comboNroMesReferencia").jqxDropDownList(
            {
                source: records,
                theme: theme,
                width: 200,
                height: 25,
                selectedIndex: 0,
                displayMember: 'DSC_MES_REFERENCIA',
                valueMember: 'NRO_MES_REFERENCIA'
            });  
            mes = new Date().getMonth();
            mes = String(mes+1).padStart(2, "0");
//            alert(mes);
            $("#comboNroMesReferencia").val(mes);
        },
        async:true
                     
    });  
    dataAdapter.dataBind();    
}

function CarregaGrafico(){
    $.post('../../Controller/Relatorios/RelReceitasXDespesasMensalController.php',
        {method: 'CarregaRegistros',
         nroAnoReferencia: $("#comboNroAnoReferencia").val(),
         nroMesReferencia: $("#comboNroMesReferencia").val()}, function(data){
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
            { name: 'VLR_DESPESA' },
            { name: 'VLR_RECEITA' }
        ]        
    };
    var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
    // prepare jqxChart settings
    var settings = {
                title: "Resumo Mensal de Gastos X Receitas",
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
                            type: 'pie',
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
                                    { dataField: 'VLR_RECEITA', displayText: 'Receitas', symbolType: 'square'},
                                    { dataField: 'VLR_DESPESA', displayText: 'Despesas', symbolType: 'square'}
                                ]
                        }
                    ]
            };
    // setup the chart
    $('#jqxChart').jqxChart(settings);  
};
$(document).ready(function(){
    MontaComboAno();
    MontaComboMes();
});