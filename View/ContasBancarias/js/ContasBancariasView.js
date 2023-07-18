var arrContaBancaria;
$(function(){
    $("#btnNovo").click(function(){
        LimparCampos();
        $("#cadastroContaBancariaTitle").html("Nova Conta");
        $("#cadastroContaBancaria").modal("open");
    });
});

function CarregaGridContaBancaria() {
    $("#cadastroContaBancaria").modal("hide");
    ExecutaDispatch('ContasBancarias', 'ListarContasBancarias', undefined, MontaTabelaContaBancaria);
}

function MontaTabelaContaBancaria(listaContaBancaria) {
    var objeto = listaContaBancaria[1];
    arrContaBancaria = listaContaBancaria[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaContasBancarias' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th>Código</th>";
    tabela += "         <th>Banco</th>";
    tabela += "         <th>Agência</th>";
    tabela += "         <th>Conta</th>";
    tabela += "         <th>Status</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            var ativo = objeto[i].ATIVO? 'Ativo' : 'Inativo';
            tabela += " <tr>";
            tabela += "     <td>" + (objeto[i].COD_CONTA != null ? objeto[i].COD_CONTA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].NME_BANCO != null ? objeto[i].NME_BANCO : '') + "</td>";
            tabela += "     <td>" + (objeto[i].NRO_AGENCIA != null ? objeto[i].NRO_AGENCIA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].NRO_CONTA != null ? objeto[i].NRO_CONTA : '') + "</td>";
            tabela += "     <td align='center'>" + ativo + "</td>";
            tabela += "     <td align='center'><button class='btn btn-primary btn-sm' title='Editar' onclick='javascript:ChamaCadastroContaBancaria(" + objeto[i].COD_CONTA + ");'><i class='fas fa-pen'></i></button></td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaContaBancaria").html(tabela);

    MontaDataTable('tableListaContasBancarias', true, 0);
}

function ChamaCadastroContaBancaria(codContaBancaria) {
    let ContaBancaria = arrContaBancaria.filter(elm => elm.COD_CONTA == codContaBancaria);
    PreencheCamposForm(ContaBancaria[0], 'indAtivo;B');
    $("#cadastroContaBancariaTitle").html("Conta Bancária "+codContaBancaria);
    $("#cadastroContaBancaria").modal("show");

}

$(document).ready(function() {
    CarregaGridContaBancaria();
});

