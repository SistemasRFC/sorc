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

$(document).ready(function() {
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'ListarMesesFiltro', undefined, montaComboMesFiltro);
    ExecutaDispatch('RelatorioPorcentagemDespesasPorReceita', 'CarregaRegistros', 'anoFiltro<=>'+anoAtual+'|mesFiltro<=>'+mesAtual, MontaGrafico);
    montaComboStatusFiltro();    
});