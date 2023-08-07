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
        if ($("#tpoDespesa").val()=='-1') {
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
});

function verificarTeto() {
    if($("#tpoDespesa").val() > 0){
        ExecutaDispatch('TipoDespesa', 'VerificarTeto', 'tpoDespesa<=>'+$("#tpoDespesa").val(), TratarTetoTipoDespesa);
    } else {
        $("#tetoTpoDespesa").html("");
        $("#infoTpoDespesa").html("");
    }
}

function TratarTetoTipoDespesa(dados) {
    if(dados[1] != null) {
        var valores = dados[1][0];
        var vlrTeto = valores.VLR_TETO;
        var vlrGasto = valores.VLR_GASTO;
        var vlrDisponivel = parseFloat(vlrTeto)-parseFloat(vlrGasto);
        $("#tetoTpoDespesa").html('Teto: R$'+number_format(vlrTeto, 2, ',', '.'));
        if(vlrDisponivel < 0) {
            $("#infoTpoDespesa").removeClass("text-success");
            $("#infoTpoDespesa").removeClass("text-black");
            $("#infoTpoDespesa").addClass("text-danger");
            $("#infoTpoDespesa").html("Você já excedeu o valor para esse tipo de despesa!!");
        } else if(vlrDisponivel >= 0 && vlrDisponivel < 1) {
            $("#infoTpoDespesa").removeClass("text-danger");
            $("#infoTpoDespesa").removeClass("text-success");
            $("#infoTpoDespesa").addClass("text-black");
            $("#infoTpoDespesa").html("Você já gastou o que podia com esse tipo de despesa.");
        } else {
            vlrDisponivel = number_format(vlrDisponivel, 2, ',', '.');
            $("#infoTpoDespesa").removeClass("text-danger");
            $("#infoTpoDespesa").removeClass("text-black");
            $("#infoTpoDespesa").addClass("text-success");
            $("#infoTpoDespesa").html("Você ainda pode gastar R$"+vlrDisponivel+" com esse tipo de despesa.");
        }
    } else {
        $("#tetoTpoDespesa").html("");
        $("#infoTpoDespesa").html("");
    }
}