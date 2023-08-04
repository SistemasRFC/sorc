var anoAtual = new Date().getFullYear();

function montaComboAnoFiltro(arr) {
    CriarSelect('anoFiltro', arr, anoAtual, false, '');
    $("#anoFiltro").change(function() {
        CarregaGrafico();
    });
}

function CarregaGrafico(){
    ExecutaDispatch('RelatorioMediaDiaria', 'BuscarMediaDiaria', 'anoFiltro<=>'+$("#anoFiltro").val(), MontaGrafico);
}

function MontaGrafico(dados) {
    var lista = dados[1];
    let arrLabels = [];
    let arrValores = [];
    for(var i in lista) {
        arrLabels.push(lista[i].NRO_DIA);
        arrValores.push(lista[i].VALOR);
    }

    document.getElementById("grafico").innerHTML = '&nbsp;';
    document.getElementById("grafico").innerHTML = '<canvas id="graficoMediaDiaria" width="1150" height="500"></canvas>';
    const campo = document.getElementById("graficoMediaDiaria");

    new Chart(campo, {
        type: 'horizontalBar',
        data: {
            labels: arrLabels,
            datasets: [{
                label: 'Valor: R$ ',
                data: arrValores,
                backgroundColor: 'rgb(30,144,255)',
                borderWidth: 1,
                barPercentage: .6,
            }]
        },
        options: {
            responsive: true,
        }
    });
};

$(document).ready(function() {
    ExecutaDispatch('RelatorioMediaDiaria', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('RelatorioMediaDiaria', 'BuscarMediaDiaria', 'anoFiltro<=>'+anoAtual, MontaGrafico);
});