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

function CarregaGrafico() {
    ExecutaDispatch('RelatorioReceitaDespesaMensal', 'CarregaRegistros', undefined, MontaGrafico);
}

function MontaGrafico(dados) {
    var lista = dados[1];
    let arrLabels = ['Receita','Despesa'];
    let arrValores = [number_format(lista[0].VLR_RECEITA, 2, '.', ''), number_format(lista[0].VLR_DESPESA, 2, '.', '')];

    document.getElementById("grafico").innerHTML = '&nbsp;';
    document.getElementById("grafico").innerHTML = '<canvas id="graficoPizzaReceitaDespesa" width="1170" height="450"></canvas>';
    const campo = $("#graficoPizzaReceitaDespesa");

    new Chart(campo, {
        type: 'pie',
        data: {
            labels: arrLabels,
            datasets: [{
                data: arrValores,
                backgroundColor: [
                    'rgb(60,179,113)',
                    'rgb(250,128,114)'
                ],
                hoverOffset: 4
            }]
        }
    });
};

function MontaGraficoOld(Data) {
    Data = [{'DSC_VALOR':'Valor Receita', 'VLR_VALOR':Data[0].VLR_RECEITA},
            {'DSC_VALOR':'Valor Despesa', 'VLR_VALOR':Data[0].VLR_DESPESA}]
    var source =
    {
        localdata: Data,
        datatype: "json",
        datafields: [
            { name: 'DSC_VALOR' },
            { name: 'VLR_VALOR' }
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
                colorScheme: 'scheme01',
                seriesGroups:
                    [
                        {
                            type: 'pie',
                            showLabels: true,
                    series:
                        [
                            {
                                dataField: 'VLR_VALOR',
                                displayText: 'DSC_VALOR',
                                labelRadius: 170,
                                initialAngle: 35,
                                radius: 155,
                                centerOffset: 0,
                                formatSettings: { prefix: 'R$ ', decimalPlaces: 2 }
                            }
                        ]
                        }
                    ]
            };
    // setup the chart
    $('#jqxChart').jqxChart(settings);  
};

$(document).ready(function() {
    ExecutaDispatch('RelatorioReceitaDespesaMensal', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('RelatorioReceitaDespesaMensal', 'ListarMesesFiltro', undefined, montaComboMesFiltro);
    ExecutaDispatch('RelatorioReceitaDespesaMensal', 'CarregaRegistros', 'anoFiltro<=>'+anoAtual+'|mesFiltro<=>'+mesAtual, MontaGrafico);
});