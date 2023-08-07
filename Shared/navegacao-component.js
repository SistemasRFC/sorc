var listaMenus;
class NavBar extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <ul class="navbar-nav bg-primary sidebar sidebar-light accordion" id="accordionSidebar">
        
                <div id="menuNavegacao"></div>
        
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

function temFilho(COD_MENU_PAI) {
    var filhos = listaMenus.filter(elm => elm.COD_MENU_PAI == COD_MENU_PAI);

    return filhos.length > 0 ? true : false;
}

function ListarMenusAtivos(DadosMenu) {
    MontaMenu(DadosMenu[1]);
}

$(document).ready(function () {
    ExecutaDispatch('MenuPrincipal', 'CarregaMenuNew', undefined, ListarMenusAtivos);
});