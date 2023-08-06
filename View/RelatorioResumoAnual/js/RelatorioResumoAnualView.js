var anoAtual = new Date().getFullYear();

function montaComboAnoFiltro(arr) {
    CriarSelect('anoFiltro', arr, anoAtual, false);
    $("#anoFiltro").change(function() {
        CarregaGrafico();
    });
}

function CarregaGrafico() {
    ExecutaDispatch('RelatorioResumoAnual', 'CarregaRegistros', undefined, MontaGrafico);
}

function MontaGrafico(dados) {
    var lista = dados[1];
    let arrLabels = [];
    let arrReceitas = [];
    let arrDespesas = [];
    for(var i in lista) {
        arrLabels.push(lista[i].DSC_MES);
        arrReceitas.push(lista[i].VLR_RECEITA);
        arrDespesas.push(lista[i].VLR_DESPESA);
    }

    document.getElementById("grafico").innerHTML = '&nbsp;';
    document.getElementById("grafico").innerHTML = '<canvas id="graficoResumoAnual" width="1180" height="465"></canvas>';
    const campo = $("#graficoResumoAnual");

    new Chart(campo, {
        type: 'line',
        data: {
            labels: arrLabels,
            datasets: [
                {
                    label: 'Receita',
                    data: arrReceitas,
                    fill: false,
                    borderColor: 'rgb(60,179,113)',
                    tension: 0
                },
                {
                    label: 'Despesa',
                    data: arrDespesas,
                    fill: false,
                    borderColor: 'rgb(250,128,114)',
                    tension: 0
                }
            ]
        }
    });
};

$(document).ready(function() {
    ExecutaDispatch('RelatorioResumoAnual', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('RelatorioResumoAnual', 'CarregaRegistros', 'anoFiltro<=>'+anoAtual, MontaGrafico);
});