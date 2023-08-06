var anoAtual = new Date().getFullYear();

function montaComboAnoFiltro(arr) {
    CriarSelect('anoFiltro', arr, anoAtual, false);
    $("#anoFiltro").change(function() {
        CarregaGrafico();
    });
}

function CarregaGrafico() {
    ExecutaDispatch('RelatorioDespesasAnual', 'CarregaRegistros', undefined, MontaGrafico);
}

function MontaGrafico(dados) {
    var lista = dados[1];
    let arrLabels = [];
    let arrDespesas = [];
    let arrPagos = [];
    for(var i in lista) {
        arrLabels.push(lista[i].DSC_MES);
        arrDespesas.push(lista[i].VLR_DESPESA);
        arrPagos.push(lista[i].VLR_PAGO);
    }

    document.getElementById("grafico").innerHTML = '&nbsp;';
    document.getElementById("grafico").innerHTML = '<canvas id="graficoResumoDespesasAnual" width="1180" height="465"></canvas>';
    const campo = $("#graficoResumoDespesasAnual");

    new Chart(campo, {
        type: 'line',
        data: {
            labels: arrLabels,
            datasets: [
                {
                    label: 'Valor Total',
                    data: arrDespesas,
                    fill: false,
                    borderColor: 'rgb(250,128,114)',
                    tension: 0
                },
                {
                    label: 'Valor Pago',
                    data: arrPagos,
                    fill: false,
                    borderColor: 'rgb(60,179,113)',
                    tension: 0
                }
            ]
        }
    });
};

$(document).ready(function() {
    ExecutaDispatch('RelatorioDespesasAnual', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('RelatorioDespesasAnual', 'CarregaRegistros', 'anoFiltro<=>'+anoAtual, MontaGrafico);
});