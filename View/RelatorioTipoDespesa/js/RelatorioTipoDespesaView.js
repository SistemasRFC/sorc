var anoAtual = new Date().getFullYear();
var mesAtual = new Date().getMonth()+1;

$(function() {
    $( "#btnGrafico" ).click(() => {
        carregaGrafico();
    });
});

function carregaGrafico() {
    document.getElementById("grafico").innerHTML = '&nbsp;';
    document.getElementById("grafico").innerHTML = '<canvas id="graficoTipoDespesa"></canvas>';
    ExecutaDispatch('TipoDespesa', 'ListarSomaTipoDespesasPorPeriodo', 'dtaInicio<=>'+$("#dtaInicio").val()+'|dtaFim<=>'+$("#dtaFim").val(), montaGrafico);
    // ExecutaDispatch('TipoDespesa', 'ListarSomaTipoDespesas', 'anoFiltro<=>'+$("#anoFiltro").val()+'|mesFiltro<=>'+$("#mesFiltro").val(), montaGrafico);
}

function montaGrafico(dados) {
    CriarGraficoBarras('graficoTipoDespesa', dados[1], dados[2]);
    // $("#graficoDespesa").modal('show');
    // $("#graficoDespesaTitle").html('Gráfico por tipo de despesa '+$("#mesFiltro").val()+'/'+$("#anoFiltro").val());
}

$(document).ready(function() {

});