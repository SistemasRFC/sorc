var arrCliente;
$(function(){
    $("#btnNovo").click(function(){
        LimparCampos();
        $("#cadastroClienteTitle").html("Novo Cliente");
        $("#cadastroCliente").modal("open");
    });
});

function CarregaGridCliente() {
    $("#cadastroCliente").modal("hide");
    ExecutaDispatch('ClienteFinal', 'ListarClienteFinal', undefined, MontaTabelaCliente);
}

function MontaTabelaCliente(listaCliente) {
    var objeto = listaCliente[1];
    arrCliente = listaCliente[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaClientes' width='100%' >";
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
            tabela += "     <td>" + (objeto[i].COD_CLIENTE_FINAL != null ? objeto[i].COD_CLIENTE_FINAL : '') + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_CLIENTE_FINAL != null ? objeto[i].DSC_CLIENTE_FINAL : '') + "</td>";
            tabela += "     <td align='center'>" + ativo + "</td>";
            tabela += "     <td align='center'><button class='btn btn-primary btn-sm' title='Editar' onclick='javascript:ChamaCadastroCliente(" + objeto[i].COD_CLIENTE_FINAL + ");'><i class='fas fa-pen'></i></button></td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaCliente").html(tabela);

    MontaDataTable('tableListaClientes', true, 1);
}

function ChamaCadastroCliente(codCliente) {
    let Cliente = arrCliente.filter(elm => elm.COD_CLIENTE_FINAL == codCliente);
    PreencheCamposForm(Cliente[0], 'indAtivo;B');
    $("#cadastroClienteTitle").html("Cliente "+codCliente);
    $("#cadastroCliente").modal("show");

}

$(document).ready(function() {
    CarregaGridCliente();
});

