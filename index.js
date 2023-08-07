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
    if (dados[2]['redirecionaInicio']) {
        window.location.href = 'Dispatch.php?controller=MenuPrincipal&method=CarregaMenu';
    } else {
        window.location.href = 'Dispatch.php?controller=Login&method=ChamaAlterarSenhaView';
    }
}