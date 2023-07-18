var arrPerfil;
$(function(){
    $("#btnNovo").click(function(){
        LimparCampos();
        $("#cadastroPerfilTitle").html("Novo Perfil");
        $("#cadastroPerfil").modal("open");
    });
});

function CarregaGridPerfil() {
    $("#cadastroPerfil").modal("hide");
    ExecutaDispatch('Perfil', 'ListarPerfil', undefined, MontaTabelaPerfil);
}

function MontaTabelaPerfil(listaPerfil) {
    var objeto = listaPerfil[1];
    arrPerfil = listaPerfil[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaPerfis' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th>Código</th>";
    tabela += "         <th>Descrição</th>";
    tabela += "         <th>Status</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            var ativo = objeto[i].ATIVO? 'Ativo' : 'Inativo';
            tabela += " <tr>";
            tabela += "     <td>" + (objeto[i].COD_PERFIL_W != null ? objeto[i].COD_PERFIL_W : '') + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_PERFIL_W != null ? objeto[i].DSC_PERFIL_W : '') + "</td>";
            tabela += "     <td align='center'>" + ativo + "</td>";
            tabela += "     <td align='center'><button class='btn btn-primary btn-sm' title='Editar' onclick='javascript:ChamaCadastroPerfil(" + objeto[i].COD_PERFIL_W + ");'><i class='fas fa-pen'></i></button></td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaPerfil").html(tabela);

    MontaDataTable('tableListaPerfis', true, 1);
}

function ChamaCadastroPerfil(codPerfil) {
    let perfil = arrPerfil.filter(elm => elm.COD_PERFIL_W == codPerfil);
    PreencheCamposForm(perfil[0], 'indAtivo;B');
    $("#cadastroPerfilTitle").html("Perfil "+codPerfil);
    $("#cadastroPerfil").modal("show");

}

$(document).ready(function() {
    CarregaGridPerfil();
});

