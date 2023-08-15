var arrTipoDespesa;
$(function(){
    $("#btnNovo").click(function(){
        LimparCampos();
        $("#cadastroTipoDespesaTitle").html("Novo Tipo de Despesa");
//        $("#cadastroTipoDespesa").modal("open");
    });
    $("#indMostrarAtivo").click(function(){       
        if ($(this).is(":checked")){
            ExecutaDispatch('TipoDespesa', 'ListarTiposDespesasAtivos', undefined, MontaTabelaTipoDespesa);
        }else{
            ExecutaDispatch('TipoDespesa', 'ListarTiposDespesas', undefined, MontaTabelaTipoDespesa);
        }
    })
});

function CarregaGridTipoDespesa() {
    $("#cadastroTipoDespesa").modal("hide");
    ExecutaDispatch('TipoDespesa', 'ListarTiposDespesas', undefined, MontaTabelaTipoDespesa);
}

function MontaTabelaTipoDespesa(listaTipoDespesa) {
    var objeto = listaTipoDespesa[1];
    arrTipoDespesa = listaTipoDespesa[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaTiposDespesa' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th>Código</th>";
    tabela += "         <th>Tipo de Despesa</th>";
    tabela += "         <th>Piso</th>";
    tabela += "         <th>Teto</th>";
    tabela += "         <th>Status</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            var ativo = objeto[i].ATIVO? 'Ativo' : 'Inativo';
            tabela += " <tr>";
            tabela += "     <td>" + (objeto[i].COD_TIPO_DESPESA != null ? objeto[i].COD_TIPO_DESPESA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_TIPO_DESPESA != null ? objeto[i].DSC_TIPO_DESPESA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].VLR_PISO != null ? objeto[i].VLR_PISO : '') + "</td>";
            tabela += "     <td>" + (objeto[i].VLR_TETO != null ? objeto[i].VLR_TETO : '') + "</td>";
            tabela += "     <td align='center'>" + ativo + "</td>";
            tabela += "     <td align='center'><button class='btn btn-primary btn-sm' title='Editar' onclick='javascript:ChamaCadastroTipoDespesa(" + objeto[i].COD_TIPO_DESPESA + ");'><i class='fas fa-pen'></i></button></td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaTipoDespesa").html(tabela);

    MontaDataTable('tableListaTiposDespesa', true, 1);
}

function ChamaCadastroTipoDespesa(codTipoDespesa) {
    let TipoDespesa = arrTipoDespesa.filter(elm => elm.COD_TIPO_DESPESA == codTipoDespesa);
    PreencheCamposForm(TipoDespesa[0], 'indAtivo;B');
    $("#cadastroTipoDespesaTitle").html("Tipo de Despesa "+codTipoDespesa);
    $("#cadastroTipoDespesa").modal("show");

}

$(document).ready(function() {
    CarregaGridTipoDespesa();
});

