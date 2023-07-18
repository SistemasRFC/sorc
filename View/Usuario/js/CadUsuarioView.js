$(function() {
    $("#btnReiniciarSenha").click(function() {
        ExecutaDispatch('Usuario', 'ReiniciarSenha', undefined, CarregaGridUsuario, 'Reiniciando senha...', 'Senha resetada com sucesso. \n Nova senha: 123459.');
    });

    $("#btnSalvar").click(function() {
        var method = 'AddUsuario';
        if ($('#codUsuario').val() > 0) {
            method = 'UpdateUsuario';
        }
        ExecutaDispatch('Usuario', method, undefined, CarregaGridUsuario, 'Aguarde, salvando usuário', 'Usuário salvo com sucesso.');
    });
});

function MontaComboClienteFinal(dados) {
    CriarSelect('codClienteFinal', dados, '-1', false);
}

function MontaComboPerfil(dados){
    CriarSelect('codPerfilW', dados, '-1', false);
}

$(document).ready(function() {
    ExecutaDispatch('Perfil', 'ListarPerfilAtivo', undefined, MontaComboPerfil);
    ExecutaDispatch('ClienteFinal', 'ListarClienteFinalAtivo', undefined, MontaComboClienteFinal);
});