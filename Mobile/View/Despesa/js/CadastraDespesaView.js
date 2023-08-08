$(document).on('keydown', 'input[pattern]', function(e){
    var input = $(this);
    var oldVal = input.val();
    var regex = new RegExp(input.attr('pattern'), 'g');

    setTimeout(function(){
        var newVal = input.val();
        if(!regex.test(newVal)){
            input.val(oldVal); 
        }
    }, 1);
});
$(function() {
    $("#btnSalvar").click(function(){
        var parametros = retornaParametros();
        ExecutaDispatch('Despesas','AddDespesa', parametros, limparCamposTela, 'Aguarde, salvando despesa.', 'Despesa salva com sucesso!');        
    });
    $("#btnVoltar").click(function(){
        $(location).attr('href', '../../Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N');
    });
    $("#btnListarDespesas").click(function(){
        $(location).attr('href', './DespesaView.php');
    });
    
});

function limparCamposTela(){
    LimparCampos();
}

$(document).ready(function() {
    $("#divdtaPagamento").hide("fade");
    $("#indDespesaPaga").change(function(){
       if ($(this).is(":checked")){
           $("#divdtaPagamento").show("fade");
       }else{
           $("#divdtaPagamento").hide("fade");
       }
    });
    var parametros = retornaParametros();
    ExecutaDispatch('TipoDespesa','ListarTiposDespesasAtivos', parametros, montaComboTipoDespesa);
    ExecutaDispatch('ContasBancarias','ListarContasBancariasAtivas', parametros, montaComboContas);
    ExecutaDispatch('Usuario','ListarResponsavelFiltro', parametros, montaComboResponsavel);
});

function montaComboTipoDespesa(dados){
    CriarSelectPuro('','tpoDespesa', dados, '-1', false);
    $("#tpoDespesa").change(function() {
        verificarTeto();
    });
}

function montaComboContas(dados){
    CriarSelectPuro('Conta','codConta', dados, '-1', false);    
}

function montaComboResponsavel(dados){
    CriarSelectPuro('Responsável','codUsuarioDespesa', dados, '-1', false);
}

function verificarTeto() {
    if($("#tpoDespesa").val() > 0){
        ExecutaDispatch('TipoDespesa', 'VerificarTeto', 'tpoDespesa;'+$("#tpoDespesa").val()+'|verificaPermissao;N', TratarTetoTipoDespesa);
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