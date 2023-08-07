var arrUsuarios;
$(function() {
    $("#btnNovo").click(() => {    
        LimparCampos();
        $("#cadastroUsuarioTitle").html("Novo Usuário");
        $("#CadastroUsuario").modal("show");
    });
    
});

function CarregaGridUsuario() {
    $("#cadastroUsuario").modal("hide");
    ExecutaDispatch('Usuario', 'ListarUsuario', undefined, MontaTabelaUsuario);
}

function MontaTabelaUsuario(listaUsuario) {
    var objeto = listaUsuario[1];
    arrUsuarios = listaUsuario[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaUsuarios' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th>Código</th>";
    tabela += "         <th>Nome Completo</th>";
    tabela += "         <th>Login</th>";
    tabela += "         <th>Perfil</th>";
    if($("#codPerfilSessao").val() == 1){
        tabela += "         <th>Cliente Final</th>";
    }
    tabela += "         <th>Status</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            var ativo = objeto[i].ATIVO? 'Ativo' : 'Inativo'; 
            tabela += " <tr>";
            tabela += "     <td>" + (objeto[i].COD_USUARIO != null ? objeto[i].COD_USUARIO : '') + "</td>";
            tabela += "     <td>" + (objeto[i].NME_USUARIO_COMPLETO != null ? objeto[i].NME_USUARIO_COMPLETO : '') + "</td>";
            tabela += "     <td>" + (objeto[i].NME_USUARIO != null ? objeto[i].NME_USUARIO : 'Sem pai') + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_PERFIL_W != null ? objeto[i].DSC_PERFIL_W : '') + "</td>";
            if($("#codPerfilSessao").val() == 1){
                tabela += "     <td>" + (objeto[i].DSC_CLIENTE_FINAL != null ? objeto[i].DSC_CLIENTE_FINAL : '') + "</td>";
            }
            tabela += "     <td align='center'>" + ativo + "</td>";
            tabela += "     <td align='center'><button class='btn btn-primary btn-sm' title='Editar' onclick='javascript:ChamaCadastroUsuario(" + objeto[i].COD_USUARIO + ");'><i class='fas fa-pen'></i></button></td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaUsuarios").html(tabela);

    MontaDataTable('tableListaUsuarios', true, 1); 
}

function ChamaCadastroUsuario(codUsuario) {
    let Usuario = arrUsuarios.filter(elm => elm.COD_USUARIO == codUsuario);
    PreencheCamposForm(Usuario[0], 'indAtivo;B');
    $("#cadastroUsuarioTitle").html("Usuario "+codUsuario);
    $("#cadastroUsuario").modal("show");
}

function ResetarSenha(codUsuario) {
    ExecutaDispatch('Usuario', 'ReiniciarSenha', 'codUsuario<=>'+codUsuario, CarregaGridUsuario, 'Reiniciando senha...', 'Senha resetada com sucesso. \n Nova senha: 123459.');
}

$(document).ready(function(){
    if($("#codPerfilSessao").val() != 1){
        $("#titleMenu").html("Cadastro");
    }
    CarregaGridUsuario();
});