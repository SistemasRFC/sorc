$(function() {
    $("#btnSalvar").click(function() {
        var method = 'AddCliente';
        if ($("#codClienteFinal").val() > 0) {
            method = 'UpdateCliente';
        }
        if ($("#dscClienteFinal").val() == '') {
            swal('Atenção!', 'Informe uma descrição.', 'warning');
            return false;
        }

        ExecutaDispatch('ClienteFinal', method, undefined, CarregaGridCliente, "Aguarde, salvando o Cliente.", "Cliente salvo com sucesso!");
    });
});

