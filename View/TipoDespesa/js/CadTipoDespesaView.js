$(function() {
    $("#btnSalvar").click(function() {
        var method = 'AddTipoDespesa';
        if ($("#codTipoDespesa").val() > 0) {
            method = 'UpdateTipoDespesa';
        }
        if ($("#dscTipoDespesa").val() == '') {
            swal('Atenção!', 'Informe uma descrição.', 'warning');
            return false;
        }

        ExecutaDispatch('TipoDespesa', method, undefined, CarregaGridTipoDespesa, "Aguarde, salvando o Tipo de Despesa.", "Tipo de Despesa salvo com sucesso!");
    });
});

