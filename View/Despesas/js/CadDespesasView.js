$(function() {
    $( "#btnDeletar" ).click(() => {
        deletarDespesa($("#codDespesa").val()); 
    });
    $( "#btnSalvar" ).click(() => {
        var method = 'AddDespesa';
        if($("#codDespesa").val() > 0) {
            method = 'UpdateDespesa';
        }
        if ($("#indDespesaPaga").is(":checked")) {
            if ($("#dtaPagamento").val()=='') {
                swal('Atenção!', 'Selecione uma data de pagamento!', 'warning');
                return;
            }
        }
        if ($("#codConta").val()=='-1') {
            $("#codConta").val('0');
        }
        if ($("#codTipoDespesa").val()=='-1') {
            swal('Atenção!', 'Selecione um tipo de despesa!', 'warning');
            return;
        }

        ExecutaDispatch('Despesas', method, undefined, CarregaGridDespesa, 'Aguarde! Salvando despesa.', 'Despesa salva com sucesso!');
    });
    
    $("#indDespesaPaga").change(function(){
       if($("#indDespesaPaga").is(":checked")){
           $("#divDtaPagamento").show("slow");
       }else{
           $("#divDtaPagamento").hide("slow");
       }
    });

    $("#tpoDespesa").change(function(){
        $.post('../../Controller/Despesas/DespesasController.php',
            {method: 'PegaLimiteTipoDespesa',
             codTipoDespesa: $("#codTipoDespesa").val()},function(data){

                data = eval('('+data+')');

                if (data!=null){

                    $("#divValores").html('O mínimo programado era: '+data[0].vlrPiso+'<br>'+
                                          'O que você usou foi: '+data[0].vlrLimite+'<br>'+
                                          'O máximo programado é: '+data[0].vlrTeto);

                }
        });
    });
    
});