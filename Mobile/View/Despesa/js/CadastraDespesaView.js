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
        ExecutaDispatch('Despesas','AddDespesa', parametros, limparCamposTela, 'Aguarde salvando despesa!', 'Despesa salva com sucesso!');        
    });
    $("#btnVoltar").click(function(){
        $(location).attr('href', '../../Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N');
    });
    $("#btnListarDespesas").click(function(){
        $(location).attr('href', './DespesaView.php');
    });
    
});

$(document).ready(function(){
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
});

function montaComboTipoDespesa(dados){
    CriarSelectPuro('Tipo de despesa','codTipoDespesa', dados, '', false, '');    
}

function montaComboContas(dados){
    CriarSelectPuro('Conta utilizada','codConta', dados, '', false, '');    
}

function limparCamposTela(){
    $("#dscDespesa").val("");
    $("#dtaLancDespesa").val("");
    $("#dtaDespesa").val("");
    $("#vlrDespesa").val("");
    $("#qtdParcelas").val("1");
    $("#nroParcelaAtual").val("1");
    $("#codTipoDespesa").val("");
    $("#codConta").val("");
    $("#indDespesaPaga").checked(true);
    $("#dtaPagamento").val("");
    
}