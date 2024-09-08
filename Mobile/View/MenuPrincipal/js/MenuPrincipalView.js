var anoAtual = new Date().getFullYear();
var mesAtual = new Date().getMonth()+1;

function MontaProgressoGastos(arrSomaGastos) {
    if (arrSomaGastos[1] !=null && arrSomaGastos[1].length > 0) {
        listaGastos = arrSomaGastos[1];
        var html = "";
        for (var i in listaGastos) {
                var valor = parseFloat(listaGastos[i].VALOR)
                var teto = parseFloat(listaGastos[i].VLR_TETO)
                valor = number_format(valor,2,',','.');
                teto = number_format(teto,2,',','.');
                html += "<li class='nav-item mx-1 mb-1' style='list-style-type: none;'>"
                html += "   <label class='pb-0 mb-0'><b>" + listaGastos[i].DSC_TIPO_DESPESA + "</b> (R$ "+valor+" de R$ "+teto+")</label>";
                if(listaGastos[i].PORCENT < 65){
                    html += "   <div class='progress'>";
                    html += "       <div class='progress-bar' role='progressbar' style='width: " + listaGastos[i].PORCENT + "%; background-color: green;' aria-valuemin='0' aria-valuemax='100'></div>";
                    html += "   </div>";
                } else if (listaGastos[i].PORCENT < 90){
                    html += "   <div class='progress'>";
                    html += "       <div class='progress-bar' role='progressbar' style='width: " + listaGastos[i].PORCENT + "%; background-color: orange;' aria-valuemin='0' aria-valuemax='100'></div>";
                    html += "   </div>";
                } else {
                    html += "   <div class='progress'>";
                    html += "       <div class='progress-bar' role='progressbar' style='width: " + listaGastos[i].PORCENT + "%; background-color: red;' aria-valuemin='0' aria-valuemax='100'></div>";
                    html += "   </div>";
                }
                html += "</li>";
        }

        $('#listaGastos').html(html);
    }
}

$(document).ready(function () {
    ExecutaDispatch('TipoDespesa', 'ListarSomaTipoDespesas', 'anoFiltro;'+anoAtual+'|mesFiltro;'+mesAtual+'|verificaPermissao;N', MontaProgressoGastos);
});