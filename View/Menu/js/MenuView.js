var arrMenus;
$(function() {
    $("#btnNovo").click(function() {
        LimparCampos();
        $("#cadastroMenuTitle").html("Novo Menu");
        $("#cadastroMenu").modal("open");
    });
});

function CarregaGridMenu() {
    $("#cadastroMenu").modal("hide");
    ExecutaDispatch('Menu', 'ListarMenusGrid', undefined, MontaTabelaMenu);
}

function MontaTabelaMenu(listaMenus) {
    var objeto = listaMenus[1];
    arrMenus = listaMenus[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaMenus' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th>Código</th>";
    tabela += "         <th>Descrição</th>";
    tabela += "         <th>Menu Pai</th>";
    tabela += "         <th>Controller</th>";
    tabela += "         <th>Method</th>";
    tabela += "         <th>Atalho</th>";
    tabela += "         <th>Status</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            var ativo = objeto[i].ATIVO? 'Ativo' : 'Inativo'; 
            var atalho = objeto[i].ATALHO? 'Sim' : 'Não';
            tabela += " <tr>";
            tabela += "     <td>" + (objeto[i].COD_MENU_W != null ? objeto[i].COD_MENU_W : '') + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_MENU_W != null ? objeto[i].DSC_MENU_W : '') + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_MENU_PAI != null ? objeto[i].DSC_MENU_PAI : 'Sem pai') + "</td>";
            tabela += "     <td>" + (objeto[i].NME_CONTROLLER != null ? objeto[i].NME_CONTROLLER : '') + "</td>";
            tabela += "     <td>" + (objeto[i].NME_METHOD != null ? objeto[i].NME_METHOD : '') + "</td>";
            tabela += "     <td align='center'>" + atalho + "</td>";
            tabela += "     <td align='center'>" + ativo + "</td>";
            tabela += "     <td align='center'><button class='btn btn-primary btn-sm' title='Editar' onclick='javascript:ChamaCadastroMenu(" + objeto[i].COD_MENU_W + ");'><i class='fas fa-pen'></i></button></td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaMenus").html(tabela);

    MontaDataTable('tableListaMenus', true, 1);
}

function ChamaCadastroMenu(codMenu) {
    let menu = arrMenus.filter(elm => elm.COD_MENU_W == codMenu);
    PreencheCamposForm(menu[0], 'indMenuAtivoW;B|indAtalho;B');
    $("#cadastroMenuTitle").html("Menu "+codMenu);
    $("#cadastroMenu").modal("show");
}

$(document).ready(function() {
    CarregaGridMenu();
    $(document).on('contextmenu', function (e) {
        return false;
    });
    $("input[type='button']").button();
});