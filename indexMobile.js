$(function() {
    $(".login").keyup(function(event){
        if (event.keyCode==13){
            $("#btnLogin").click();
        }
    }); 
    $("#btnLogin").click(function(){     
        var parametros = retornaParametros();
        ExecutaDispatch('Login', 'Logar', parametros, posLogin, "Aguarde, efetuando login!");
    });

});

function posLogin(dados) {
    if (dados[2]['redirecionaInicio']) {
        window.location.href = 'Mobile/Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N';
    } else {
        window.location.href = 'Mobile/Dispatch.php?controller=Login&method=ChamaAlterarSenhaView';
    }
    // $(location).attr('href', 'Mobile/Dispatch.php?controller=' + logar[1][0]['DSC_PAGINA'] + '&method=' + logar[1][0]['NME_METHOD']+'&verificaPermissao=N');
}

$(document).ready(function(){
    $("#nmeUsuario").focus();
});