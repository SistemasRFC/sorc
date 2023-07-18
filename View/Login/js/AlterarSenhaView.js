$(function() {
    $(".persist").keyup((event) => {
        if (event.keyCode == 13) {
            $("#btnLogin").click();
        }
    })
    $("#btnLogin").click(function(){
        var validacao = verificaCampos();
        if (!validacao[0]){
            swal("Erro", validacao[1], "error");
            return;
        }
        
        ExecutaDispatch('Login', 'AlteraSenha', undefined, redirecionaPagina, 'Aguarde!', 'Senha atualizada!');
    });
});

function redirecionaPagina(resp) {
    if (resp[0]) {
        // window.location.href = 'Dispatch.php?controller='+resp[1]['DSC_PAGINA']+'&method='+resp[1]['NME_METHOD'];
        $(location).attr('href','../../sorc/Dispatch.php?controller='+resp[1]['DSC_PAGINA']+'&method='+resp[1]['NME_METHOD']);
    }
}

function verificaCampos() {
    var retorno = [true, ""];
    if($("#txtSenhaW").val()==""||$("#txtNova").val()==""||$("#txtConfirmacao").val()=="") {
        retorno[0] = false;
        retorno[1] = "Obrigatório o preenchimento de todos os campos!"
    } else if ($("#txtNova").val()!=$("#txtConfirmacao").val()){
        retorno[0] = false;
        retorno[1] = "Nova senha diferente da senha de confirmação!";
    }
    return retorno;
}

$(document).ready(function(){
    $("#txtSenhaW").focus();
});
