$(function() {
    $("#btnSalvar").click(function() {
        var method = 'AddPerfil';
        if ($("#codPerfilW").val() > 0) {
            method = 'UpdatePerfil';
        }
        if ($("#dscPerfilW").val() == '') {
            swal('Atenção!', 'Informe uma descrição.', 'warning');
            return false;
        }

        ExecutaDispatch('Perfil', method, undefined, CarregaGridPerfil, "Aguarde, salvando o Perfil.", "Perfil salvo com sucesso!");
    });
});

