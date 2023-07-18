$(function () {
    $(".persist").keyup((event) => {
        if (event.keyCode == 13) {
            $("#btnLogar").click();
        }
    })
    $("#btnLogar").click(function () {
        if ($("#nmeUsuario").val() == '') {
            swal('Atenção', 'Informe um Login e Senha para acessar o sistema. ', 'warning');
            return false;
        }
        if ($("#txtSenhaW").val() == '') {
            swal('Atenção', 'Informe um Login e Senha para acessar o sistema. ', 'warning');
            return false;
        }
        logar();
    });

});

function logar() {
    ExecutaDispatch('Login', 'Logar', undefined, redirecionaLogin, 'Aguarde', 'Login realizado!');
}

function redirecionaLogin(dados) {
    console.log(">>>>>>> ", dados);
    // if (dados[0]) {
        // if (dados[2].dadosIncorretos) {
            // swal.close();
            // // $("#labelTextoMensagem").html(dados[1].mensagem);
            // setTimeout(function () {
            //     $("#labelTextoMensagem").html('');
            // }, 3000);
        // } else {
            // swal('Sucesso', dados[1]['mensagem'], 'success')
            if (dados[2]['redirecionaInicio']) {
                // window.location.href = 'Dispatch.php?controller=MenuPrincipal/MenuPrincipalController.php&method=CarregaMenu';
                window.location.href = 'Dispatch.php?controller=MenuPrincipal&method=CarregaMenu';
            } else {
                window.location.href = 'Dispatch.php?controller=Login&method=ChamaAlterarSenhaView';
                // window.location.href = 'Dispatch.php?controller=Login&method=ChamaAlterarSenhaView';
            }
        // }
    // }
}





// $(function() {
//     valor = '{x:'+$(window).width/2+', y:'+$(window).heigth/2+'}';
//     $( "#dialogInformacao" ).jqxWindow({
//         autoOpen: false,
//         height: 150,
//         width: 450,
//         theme: theme,
//         animationType: 'fade',
//         showAnimationDuration: 500,
//         closeAnimationDuration: 500,
//         title: 'Mensagem',
//         isModal: true
//     });
//     $("#CadastroForm").jqxWindow({
//         autoOpen: true,
//         height: 150,
//         width: 350,
//         theme: theme,
//         animationType: 'fade',
//         showAnimationDuration: 500,
//         closeAnimationDuration: 500,
//         isModal: false,
//         title: 'Login - Sistema SORC'
//     });
//     $(".login").keyup(function(event){
//         if (event.keyCode==13){
//             $("#btnLogin").click();
//         }
//     }); 
//     $("#btnLogin").jqxButton({ width: '100', theme: theme });
//     $("#btnLogin").click(function(){
//         $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, efetuando Login!");
//         $( "#dialogInformacao" ).jqxWindow("open");        
//         $.post('Controller/Login/LoginController.php',
//                {
//                    method: 'Logar',
//                    nmeLogin: $("#nmeLogin").val(),
//                    txtSenha: $("#txtSenha").val()
//                },
//                function(logar){
//                     logar = eval ('('+logar+')');
//                     if (logar[0]==true){
//                         window.location.href=logar[1][0]['DSC_PAGINA'];
//                     }else{
//                         $( "#dialogInformacao" ).jqxWindow('setContent', "Usu&aacute;rio ou senha inv&aacute;lido!");                        
//                     }
//                }
//         );
//     });

// });
// $(document).ready(function(){
//     $("#nmeLogin").focus();
// });