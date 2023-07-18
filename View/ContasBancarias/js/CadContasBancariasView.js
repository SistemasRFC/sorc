$(function() {
    $("#btnSalvar").click(function() {
        var method = 'AddContaBancaria';
        if ($("#codConta").val() > 0) {
            method = 'UpdateContaBancaria';
        }
        if ($("#nmeBanco").val() == '') {
            swal('Atenção!', 'Informe um nome de Banco.', 'warning');
            return false;
        }

        ExecutaDispatch('ContasBancarias', method, undefined, CarregaGridContaBancaria, "Aguarde, salvando a Conta.", "Conta salva com sucesso!");
    });
});

