$(function() {
    $(".login").keyup(function(event){
        if (event.keyCode==13){
            $("#btnLogin").click();
        }
    }); 
    $("#btnLogin").click(function(){     
        var parametros = retornaParametros();
        ExecutaDispatch('Login','Logar', parametros, posLogin, "Aguarde, efetuando login!");
    });

});

function posLogin(logar){
    $(location).attr('href', 'Mobile/Dispatch.php?controller=' + logar[1][0]['DSC_PAGINA'] + '&method=' + logar[1][0]['NME_METHOD']+'&verificaPermissao=N');
}

$(document).ready(function(){
    $("#nmeLogin").focus();
});