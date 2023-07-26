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
            if (DadosMenu[i].COD_MENU_PAI_W == 0 || DadosMenu[i].COD_MENU_PAI_W == -1) {
                html += "<li class='nav-item'>"
                if (temFilho(DadosMenu[i].COD_MENU_W)) {
                    html += "    <a href='' class='nav-link collapsed' id='menu'" + DadosMenu[i].COD_MENU_W + "' data-toggle='collapse' data-target='#collapse" + DadosMenu[i].COD_MENU_W + "' aria-expanded='true' aria-controls='collapse" + DadosMenu[i].COD_MENU_W + "'>";
                    // html += "        <i class='" + DadosMenu[i].dscIcone + "' style='color: #858796 !important;'></i>";
                    html += "        <span><b>" + DadosMenu[i].DSC_MENU_W + "</b></span>";
                    html += "    </a>";
                    html += "    <div id='collapse" + DadosMenu[i].COD_MENU_W + "' class='collapse mx-1' aria-labelledby='heading" + DadosMenu[i].COD_MENU_W + "' data-parent='#accordionSidebar'>";
                    html += "        <div class='bg-white py-2 collapse-inner'>";
                    for (var j in DadosMenu) {
                        if (DadosMenu[j].COD_MENU_PAI_W == DadosMenu[i].COD_MENU_W) {
                            html += "   <a class='collapse-item' style='white-space: normal;' href='/sorc/Dispatch.php?controller=" + DadosMenu[j].NME_CONTROLLER + "&method=" + DadosMenu[j].NME_METHOD + "' style='white-space: pre-wrap;'>";
                            // html += "       <i class='" + DadosMenu[j].dscIcone + "'></i>";
                            html += "       <span><b>" + DadosMenu[j].DSC_MENU_W + "</b></span>";
                            html += "   </a>";
                        }
                    }
                    html += "        </div>";
                    html += "    </div>";
                } else {
                    html += "   <a class='nav-link collapsed' href='/sorc/Dispatch.php?controller=" + DadosMenu[i].NME_CONTROLLER + "&method=" + DadosMenu[i].NME_METHOD + "'>";
                    // html += "       <i class='" + DadosMenu[i].dscIcone + "' style='color: #858796 !important;'></i>";
                    html += "       <span><b>" + DadosMenu[i].DSC_MENU_W + "</b></span>";
                    html += "   </a>";
                }
                html += "</li>";
            }
        }

        $('#menuNavegacao').html(html);
    }
}

function temFilho(COD_MENU_PAI_W) {
    var filhos = listaMenus.filter(elm => elm.COD_MENU_PAI_W == COD_MENU_PAI_W);

    return filhos.length > 0 ? true : false;
}

function ListarMenusAtivos(DadosMenu) {
    MontaMenu(DadosMenu[1]);
}

$(document).ready(function () {
    ExecutaDispatch('MenuPrincipal', 'CarregaMenuNew', undefined, ListarMenusAtivos);
});