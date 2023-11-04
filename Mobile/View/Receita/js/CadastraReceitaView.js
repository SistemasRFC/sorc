// $(document).on('keydown', 'input[pattern]', function(e){
//     var input = $(this);
//     var oldVal = input.val();
//     var regex = new RegExp(input.attr('pattern'), 'g');

//     setTimeout(function(){
//         var newVal = input.val();
//         if(!regex.test(newVal)){
//             input.val(oldVal); 
//         }
//     }, 1);
// });
$(function() {
    $("#btnSalvar").click(function(){
        var method = 'AddReceita';
        if($("#codReceita").val() > 0) {
            method = 'UpdateReceita';
        }
        var validacao = validarCampos();
        if(validacao[0]) {
            var parametros = retornaParametros();
            ExecutaDispatch('Receitas', method, parametros, limparCamposTela, 'Aguarde, salvando Receita.', 'Receita salva com sucesso!');        
        } else {
            swal('Atenção!', ''+validacao[1], 'warning');
        }
    });
    $("#btnVoltar").click(function(){
        $(location).attr('href', '../../Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N');
    });
    $("#btnListarReceitas").click(function(){
        $(location).attr('href', './ReceitaView.php');
    });
    
});

function validarCampos() {
    var retorno = [true, ''];
    retorno[1] = 'Os campos abaixo devem ser preenchidos: \n';
    if ($("#dscReceita").val()=='') {
        retorno[0] = false;
        retorno[1] += '- Descrição \n';
    }
    if ($("#dtaReceita").val()=='') {
        retorno[0] = false;
        retorno[1] += '- Data de Vencimento \n';
    }
    if ($("#vlrReceita").val()=='') {
        retorno[0] = false;
        retorno[1] += '- Valor \n';
    }
    if ($("#codConta").val()=='-1') {
        retorno[0] = false;
        retorno[1] += '- Conta \n';
    }

    return retorno;
}

function limparCamposTela(){
    LimparCampos();
}

function PreencherDados(dados) {
    preencheCamposForm(dados[1][0]);
}

function montaComboContas(dados){
    CriarSelectPuro('Conta *','codConta', dados, '-1', false);    
}

$(document).ready(function() {
    ExecutaDispatch('ContasBancarias','ListarContasBancariasAtivas', 'verificaPermissao;N', montaComboContas);
    if ($("#codReceita").val() > 0) {
        ExecutaDispatch('Receitas', 'RetornaReceitaPorCodigo', 'codReceita;' + $("#codReceita").val()+'|verificaPermissao;N', PreencherDados);
    }
});