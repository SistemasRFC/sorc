var anoAtual = new Date().getFullYear();
var mesAtual = new Date().getMonth()+1;
var arrReceitas;
$(function() {   
    $("#btnNovo").click(() => {
        LimparCampos();
        $("#cadastroReceitaTitle").html('Nova Receita');
        // CadReceita('AddReceita', '0', '', '', '-1', '', '', '-1', '', 'N', '');        
    });      
    // $( "#btnImportar" ).click(() => {
    //     $("#importarReceita").modal('show');
    // });
    $("#btnExcel").click(() => {
        $("#dtBtnExcel").click();
    });
});

function CarregaGridReceita() {
    $("#cadastroReceita").modal("hide");
    $("#importarReceita").modal("hide");
    $("#vlrSelecionado").html('R$ 0,00');
    var params = 'anoFiltro<=>'+$("#anoFiltro").val()+'|mesFiltro<=>'+$("#mesFiltro").val();
    ExecutaDispatch('Receitas', 'ListarReceitas', params, MontaGridReceita);
}

function MontaGridReceita(listaReceita) {
    var objeto = listaReceita[1];
    arrReceitas = listaReceita[1];
    somarValorTotal();
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered mb-0' id='tableReceitas' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th class='align-top'>";
    tabela += "             <div class='form-check'>";
    tabela += "                 <input type='checkbox' class='form-check-input mb-2' id='allReceitas' onClick='marcarTodas()'>";
    tabela += "             </div>";
    tabela += "         </th>";
    tabela += "         <th>Descrição</th>";
    tabela += "         <th width='10%'>Data</th>";
    tabela += "         <th width='12%'>Valor</th>";
    tabela += "         <th>Conta</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            tabela += " <tr>";
            tabela += "     <td align='center'>";
            tabela += "         <div class='form-check'>";
            tabela += "             <input type='checkbox' class='form-check-input ckbReceita' id='ckb"+objeto[i].COD_RECEITA+"' codReceita='"+objeto[i].COD_RECEITA+"' onClick='eventosCheckbox()'>";
            tabela += "         </div>";
            tabela += "     </td>";
            tabela += "     <td>" + (objeto[i].DSC_RECEITA != null ? objeto[i].DSC_RECEITA : '') + "</td>";
            tabela += "     <td align='center'>" + (objeto[i].DTA_RECEITA_FORMATADA != null ? objeto[i].DTA_RECEITA_FORMATADA : '') + "</td>";
            tabela += "     <td align='end'>" + (objeto[i].VLR_RECEITA != null ? objeto[i].VLR_RECEITA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].CONTA != null ? objeto[i].CONTA : '') + "</td>";
            tabela += "     <td class='px-1' align='center'>";
            tabela += "         <div class='btn-group'>";
            tabela += "             <button class='btn btn-outline-primary px-2' title='Editar' onclick='javascript:chamaCadastroReceita(" + objeto[i].COD_RECEITA + ");'><i class='fas fa-pen'></i></button>";
            // tabela += "             <button class='btn btn-outline-secondary px-2' title='Quitar parcelas' onclick='javascript:quitarParcelas(" + objeto[i].COD_RECEITA + ");'><i class='fas fa-circle-dollar-to-slot'></i></button>";
            // tabela += "             <button class='btn btn-outline-success px-2' title='Pagar por conta' onclick='javascript:pagarPorConta(" + objeto[i].COD_RECEITA + ");'><i class='fas fa-dollar-sign'></i></button>";
            tabela += "             <button class='btn btn-outline-danger px-2' title='Excluir' onclick='javascript:deletarReceita(" + objeto[i].COD_RECEITA + ");'><i class='fas fa-trash'></i></button>";
            tabela += "         </div>";
            tabela += "     </td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaReceitas").html(tabela);

    MontaDataTable('tableReceitas', false, 1, true, 44);
}

function somarValorTotal() {
    var vlrTotal = 0;
    for(var i in arrReceitas) {
        vlrTotal = parseFloat(vlrTotal)+ parseFloat(arrReceitas[i].VLR_RECEITA.replace('.',''));
    }
    vlrTotal = vlrTotal.toFixed(2).replace('.', ',');
    $("#vlrTotal").html('R$ '+vlrTotal);
}

function marcarTodas() {
    var codReceitasMarcadas = '';
    if($("#allReceitas").is(":checked")) {
        $(".ckbReceita").each(function () {
            $(this).prop('checked', true);
            codReceitasMarcadas += $(this).attr('codReceita')+'r';
        });
        $("#btnImportar").attr('disabled', false);
        $("#btnImportar").attr('title', 'Importar Receita(s).');
    } else {
        codReceitasMarcadas = '';
        $(".ckbReceita").each(function () {
            $(this).prop('checked', false);
        });
        $("#btnImportar").attr('disabled', true);
        $("#btnImportar").attr('title', 'Nenhuma receita selecionada.');
    }
    $("#codReceitasImportacao").val(codReceitasMarcadas.substring(0, codReceitasMarcadas.length-1));
}

function eventosCheckbox() {
    $("#btnImportar").attr('disabled', true);
    $("#btnImportar").attr('title', 'Nenhuma receita selecionada.');
    var codReceitasMarcadas = '';
    var vlrSelecionado = 0;
    $(".ckbReceita").each(function() {
        if ($(this).is(":checked")) {
            $("#btnImportar").attr('disabled', false);
            $("#btnImportar").attr('title', 'Importar Receita(s).');
            codReceitasMarcadas += $(this).attr('codReceita')+'r';
            for(var i in arrReceitas) {
                if (arrReceitas[i].COD_RECEITA==$(this).attr('codReceita')) {
                    vlrSelecionado += parseFloat(arrReceitas[i].VLR_RECEITA.replace('.',''));
                }
            }
        }
    });
    $("#codReceitasImportacao").val(codReceitasMarcadas.substring(0, codReceitasMarcadas.length-1));
    vlrSelecionado = vlrSelecionado.toFixed(2).replace('.', ',');
    $("#vlrSelecionado").html('R$ '+vlrSelecionado);
}

function chamaCadastroReceita(codReceita) {
    var ReceitaSelecionada = arrReceitas.filter(elm => elm.COD_RECEITA == codReceita)[0];
    PreencheCamposForm(ReceitaSelecionada);
    $("#cadastroReceitaTitle").html('Editar Receita');
    $("#cadastroReceita").modal('show');
}

function deletarReceita(codReceita) {
    ExecutaDispatch('Receitas', 'DeletarReceita', 'codReceita<=>'+codReceita, CarregaGridReceita, 'Aguarde, excluindo receita.', 'Receita excluida com sucesso!');
}

function montaComboAnoFiltro(arr) {
    CriarSelect('anoRefImportacao', arr, anoAtual, false, '');
    CriarSelect('anoFiltro', arr, anoAtual, false, '');
    $("#anoFiltro").change(function() {
        CarregaGridReceita();
    });
}

function montaComboMesFiltro(arr) {
    CriarSelect('mesRefImportacao', arr, anoAtual, false, '');
    CriarSelect('mesFiltro', arr, mesAtual, false, '');
    $("#mesFiltro").change(function() {
        CarregaGridReceita();
    });
}

function montaComboConta(arr) {
    CriarSelect('codConta', arr, -1, false);
}

$(document).ready(function() {
    $("#btnImportar").attr('disabled', true);
    $("#btnImportar").attr('title', 'Nenhuma Receita selecionada.');
    ExecutaDispatch('Receitas', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('Receitas', 'ListarMesesFiltro', undefined, montaComboMesFiltro);
    ExecutaDispatch('ContasBancarias', 'ListarContasFiltro', undefined, montaComboConta);
    ExecutaDispatch('Receitas', 'ListarReceitas', 'anoFiltro<=>'+anoAtual+'|mesFiltro<=>'+mesAtual, MontaGridReceita);
});


// $(document).ready(function(){
//     $(document).on('contextmenu', function (e) {
//         return false;
//     });
//     data = new Date();
//     ano = data.getFullYear();
//     mes = data.getMonth();
//     mes++;
//     if (mes<10){
//         mes = '0'+mes;
//     }
//     MontaComboFixo('comboNroAnoReferencia', 'nroAnoReferencia', ano);
//     MontaComboFixo('comboNroMesReferencia', 'nroMesReferencia', mes);
//     MontaComboFixo('comboCodConta', 'codConta', '-1');
//     CarregaGridReceita();    
// });