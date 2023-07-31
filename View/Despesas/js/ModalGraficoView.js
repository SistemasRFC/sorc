function carregaGrafico() {
    $("#graficoTipoDespesa").html('');
    ExecutaDispatch('TipoDespesa', 'ListarSomaTipoDespesas', 'anoFiltro<=>'+$("#anoFiltro").val()+'|mesFiltro<=>'+$("#mesFiltro").val(), montaGrafico);
}
function montaGrafico(dados) {
    CriarGraficoBarras('graficoTipoDespesa', dados[1], dados[2]);
    $("#graficoDespesa").modal('show');
    $("#graficoDespesaTitle").html('Gráfico por tipo de despesa '+$("#mesFiltro").val()+'/'+$("#anoFiltro").val());
}