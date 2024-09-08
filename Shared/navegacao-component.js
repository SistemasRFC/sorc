var anoAtual = new Date().getFullYear();
var mesAtual = new Date().getMonth()+1;
var listaMenus;
class NavBar extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <ul class="navbar-nav bg-primary sidebar sidebar-light accordion" id="accordionSidebar">
        
                <div id="menuNavegacao"></div>
                <div id="progressoGastos" class="mt-auto mb-1"></div>
        
            </ul>`;
    }
}

customElements.define('navegacao-component', NavBar);

function MontaMenu(DadosMenu) {
    if (DadosMenu.length > 0) {
        listaMenus = DadosMenu;
        var html = "";
        for (var i in DadosMenu) {
            if (DadosMenu[i].COD_MENU_PAI == 0 || DadosMenu[i].COD_MENU_PAI == -1) {
                html += "<li class='nav-item' style='border-bottom: 1px solid white;'>"
                if (temFilho(DadosMenu[i].COD_MENU)) {
                    html += "    <a href='' class='nav-link collapsed' id='menu'" + DadosMenu[i].COD_MENU + "' data-toggle='collapse' data-target='#collapse" + DadosMenu[i].COD_MENU + "' aria-expanded='true' aria-controls='collapse" + DadosMenu[i].COD_MENU + "'>";
                    // html += "        <i class='" + DadosMenu[i].dscIcone + "' style='color: #858796 !important;'></i>";
                    html += "        <span><b>" + DadosMenu[i].DSC_MENU + "</b></span>";
                    html += "    </a>";
                    html += "    <div id='collapse" + DadosMenu[i].COD_MENU + "' class='collapse mx-1' aria-labelledby='heading" + DadosMenu[i].COD_MENU + "' data-parent='#accordionSidebar'>";
                    html += "        <div class='bg-white collapse-inner mb-1'>";
                    for (var j in DadosMenu) {
                        if (DadosMenu[j].COD_MENU_PAI == DadosMenu[i].COD_MENU) {
                            html += "   <a class='collapse-item mb-1' style='white-space: normal;border-bottom: 1px solid #929292;border-radius: 0px' href='/sorc/Dispatch.php?controller=" + DadosMenu[j].NME_CONTROLLER + "&method=" + DadosMenu[j].NME_METHOD + "' style='white-space: pre-wrap;'>";
                            html += "       <span><b>" + DadosMenu[j].DSC_MENU + "</b></span>";
                            html += "   </a>";
                        }
                    }
                    html += "        </div>";
                    html += "    </div>";
                } else {
                    html += "   <a class='nav-link collapsed' href='/sorc/Dispatch.php?controller=" + DadosMenu[i].NME_CONTROLLER + "&method=" + DadosMenu[i].NME_METHOD + "'>";
                    html += "       <span><b>" + DadosMenu[i].DSC_MENU + "</b></span>";
                    html += "   </a>";
                }
                html += "</li>";
            }
        }

        $('#menuNavegacao').html(html);
    }
}

function MontaProgressoGastos(arrSomaGastos) {
    if (arrSomaGastos[1] !=null && arrSomaGastos[1].length > 0) {
        listaGastos = arrSomaGastos[1];
        var html = "<div class='mx-1' style='border: 1px solid white;'>";
            html += "<h5 align=center class='text-white'><b>Resumo de gastos</b></h5>";
        for (var i in listaGastos) {
                var valor = parseFloat(listaGastos[i].VALOR)
                var teto = parseFloat(listaGastos[i].VLR_TETO)
                valor = number_format(valor,2,',','.');
                teto = number_format(teto,2,',','.');
                html += "<li class='nav-item mx-1 mb-1'>"
                html += "   <label class='pb-0 mb-0 text-white'><b>" + listaGastos[i].DSC_TIPO_DESPESA + "</b></label>";
                if(listaGastos[i].PORCENT < 65){
                    html += "   <div class='progress' title='R$ " + teto + "'>";
                    html += "       <div class='progress-bar' role='progressbar' style='width: " + listaGastos[i].PORCENT + "%; background-color: green;' title='R$ " + valor + "' aria-valuemin='0' aria-valuemax='100'></div>";
                    html += "   </div>";
                } else if (listaGastos[i].PORCENT < 90){
                    html += "   <div class='progress' title='R$ " + teto + "'>";
                    html += "       <div class='progress-bar' role='progressbar' style='width: " + listaGastos[i].PORCENT + "%; background-color: orange;' title='R$ " + valor + "' aria-valuemin='0' aria-valuemax='100'></div>";
                    html += "   </div>";
                } else {
                    html += "   <div class='progress'>";
                    html += "       <div class='progress-bar' role='progressbar' style='width: " + listaGastos[i].PORCENT + "%; background-color: red;' title='R$ " + valor + "' aria-valuemin='0' aria-valuemax='100'></div>";
                    html += "   </div>";
                }
                html += "</li>";
        }
        html += "</div>";

        $('#progressoGastos').html(html);
    }
}

function temFilho(COD_MENU_PAI) {
    var filhos = listaMenus.filter(elm => elm.COD_MENU_PAI == COD_MENU_PAI);

    return filhos.length > 0 ? true : false;
}

function ListarMenusAtivos(DadosMenu) {
    MontaMenu(DadosMenu[1]);
}

function montaSumarioTipoDespesa(dadosSumario){
    var div="";
    var col=0;
    for (i in dadosSumario[1]){
        if (col==0){
            div+='<div class="row text-white">';
        }
        div+='  <div class="col-md-3 px-1 py-0">';
        div+='      <small><b>'+dadosSumario[1][i].DSC_TIPO_DESPESA+':</b> R$ '+number_format(dadosSumario[1][i].VLR_TOTAL,2,',','.')+'</small>';
        div+='  </div>';
        col++;
        if (col==4){
            div+='</div>'
            col=0;
        }
    }
    $("#listaSumario").html(div);
}

$(document).ready(function () {
    ExecutaDispatch('MenuPrincipal', 'CarregaMenuNew', undefined, ListarMenusAtivos);
    ExecutaDispatch('TipoDespesa', 'SumarizaPorTipoDespesa', undefined, montaSumarioTipoDespesa);
    ExecutaDispatch('TipoDespesa', 'ListarSomaTipoDespesas', 'anoFiltro<=>'+anoAtual+'|mesFiltro<=>'+mesAtual, MontaProgressoGastos);
});