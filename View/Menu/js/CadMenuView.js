var method;
$(function() {
    $("#btnSalvar").click(function() {
        method = 'AddMenu';
        if ($("#codMenu").val() > 0) {
            method = 'UpdateMenu';
        }
        if ($("#dscMenu").val() == '') {
            swal('Atenção!', 'Informe uma descrição para esse menu.', 'warning');
            return false;
        }
        salvarMenu();
    });

    $("#btnController").click(function () {
        ListarControllers(undefined);
    });

    $("#btnMetodo").click(function () {
        ListarMetodos($("#nmeController").val());
    });
});

function salvarMenu() {
    ExecutaDispatch('Menu', method, undefined, CarregaGridMenu, "Aguarde, salvando o menu.", "Menu salvo com sucesso!");
}

function MontaComboMenuPai(ListarMenus) {
    CriarSelect('codMenuPai', ListarMenus, '-1', false);
}

$(document).ready(function () {
    $("#btnMetodo").prop("disabled", true);
    ExecutaDispatch('Menu', 'ListarComboMenus', undefined, MontaComboMenuPai);
});