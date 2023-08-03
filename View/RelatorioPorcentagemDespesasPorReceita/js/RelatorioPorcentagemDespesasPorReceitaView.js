var anoAtual = new Date().getFullYear();
var mesAtual = new Date().getMonth()+1;

function montaComboAnoFiltro(arr) {
    CriarSelect('anoFiltro', arr, anoAtual, false);
    $("#anoFiltro").change(function() {
        CarregaGrafico();
    });
}

function montaComboMesFiltro(arr) {
    CriarSelect('mesFiltro', arr, mesAtual, false);
    $("#mesFiltro").change(function() {
        CarregaGrafico();
    });
}

function montaComboStatusFiltro() {
    let arr = [true, [{ID: 'S', DSC: 'Paga'}, {ID: 'N', DSC: 'Em aberto'}]]
    CriarSelect('statusFiltro', arr, -1, false);
    $("#statusFiltro").change(function() {
        CarregaGrafico();
    });
}

function CarregaGrafico() {
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'CarregaRegistros', undefined, MontaGrafico);
    // $.post('../../Controller/Relatorios/RelPorcentagemGastosReceitasController.php',
    //     {method: 'CarregaRegistros',
    //      nroAnoReferencia: $("#comboNroAnoReferencia").val(),
    //      nroMesReferencia: $("#comboNroMesReferencia").val(),
    //      indStatus: $("#comboIndStatus").val()}, function(data){
    //     data = eval('('+data+')');
    //     if (data[0]){
    //         MontaGrafico(data[1]);
    //     }else{
    //         $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
    //         $("#btnOK").show();
    //     }
    // });
}

function MontaGrafico(dados) {
    var lista = dados[1];
    let arrLabels = dados[2];
    let arrValores = [];
    for(var i in lista) {
        percent = parseFloat(lista[i].VLR_DESPESA.replace('.', ','))/parseFloat(lista[i].VLR_RECEITA.replace('.', ','))*100;
        percent = number_format(percent, 2, '.');
        arrValores.push(percent);
    }

    var campo = $("#graficoPorcentagemGastosReceita");

    new Chart(campo, {
        type: 'bar',
        data: {
            labels: arrLabels,
            datasets: [{
                label: '%',
                data: arrValores,
                backgroundColor: 'rgb(30,144,255)',
                borderWidth: 1,
                barPercentage: .7,
            }]
        },
        options: {
            responsive: true,
            scales: {
                yAxes: [{
                    ticks: {
                        min: 0,
                        max: 100,
                        // Include a dollar sign in the ticks
                        callback: function (value) {
                            return value + '%';
                        }
                    },
                }],
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, chart) {
                        var dtsLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                        return tooltipItem.yLabel + dtsLabel;
                    }
                }
            },
        }
    });
};

function MontaGraficoOld(Data) {
    // prepare chart data as an array
    for (i=0;i<Data.length;i++){
        if (Data[i].VLR_RECEITA==null){
            Data[i].VLR_RECEITA='0';
        }
        Data[i].VLR_DESPESA = (parseFloat(Data[i].VLR_DESPESA.replace(',', ''))/parseFloat(Data[i].VLR_RECEITA.replace(',', '')))*100;        
    }
    console.log(Data);    
    var source =
    {
        localdata: Data,
        datatype: "json",
        datafields: [
            { name: 'MES' },
            { name: 'ANO' },
            { name: 'DSC_TIPO_DESPESA' },
            { name: 'VLR_DESPESA' },
            { name: 'VLR_RECEITA' }
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
                                dataField: 'VLR_DESPESA',
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
};
$(document).ready(function() {
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'ListarMesesFiltro', undefined, montaComboMesFiltro);
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'CarregaRegistros', 'anoFiltro<=>'+anoAtual+'|mesFiltro<=>'+mesAtual, MontaGrafico);
    montaComboStatusFiltro();    
});