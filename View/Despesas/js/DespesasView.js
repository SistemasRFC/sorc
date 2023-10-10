var anoAtual = new Date().getFullYear();
var mesAtual = new Date().getMonth()+1;
var arrDespesas;
let codDespesasMarcadas = '';
$(function() {
    $("#btnNovo").click(() => {
        LimparCampos();
        $("#tetoTpoDespesa").html("");
        $("#infoTpoDespesa").html("");
        let date = formataDataAmericano(new Date().toLocaleDateString());
        $("#dtaLancDespesa").val(date);
        $("#qtdParcelas").val('1');
        $("#nroParcelaAtual").val('1');
        $("#divDtaPagamento").hide();
        $("#cadastroDespesaTitle").html('Nova Despesa');
        $("#cadastroDespesa").modal('show');
    });

    $("#btnBaixar").click(function(){
        var condicaoBaixa = codDespesasMarcadas != '' ? 'selecionadas' : 'listadas na tabela'
        swal({
            title: "Atenção",
            text: "Esta ação irá atualizar todas as despesas que estão "+condicaoBaixa+" abaixo como pagas no dia de hoje. Deseja realmente fazer isso?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: "Sim",
            cancelButtonText: "Não",
        },
        function(isConfirm) {
          if (isConfirm) {
              var params = '';
            if(codDespesasMarcadas != ''){
                params = 'listaDespesas<=>'+codDespesasMarcadas;
            } else {
                let listaDespesas = '';
                $(".ckbDespesa").each(function () {
                    listaDespesas += $(this).attr('codDespesa')+'d';
                });
                params = 'listaDespesas<=>'+listaDespesas;
            }
            ExecutaDispatch('Despesas', 'BaixarDespesas', params, CarregaGridDespesa);
          } else {
            swal("Cancelado", "Nada aconteceu :)");
          }
        });
    });

    $( "#btnGrafico" ).click(() => {
        carregaGrafico();
    });

    $("#btnImportar").click(() => {
        $("#importarDespesa").modal('show');
    });
    $("#btnExcel").click(() => {
        $("#dtBtnExcel").click();
    });
    $("#tituloDespesa").click(() => {
        CarregaGridDespesa();
    })
});

function CarregaGridDespesa() {
    $("#cadastroDespesa").modal("hide");
    $("#importarDespesa").modal("hide");
    $("#vlrSelecionado").html('R$ 0,00');
    var params = 'anoFiltro<=>'+$("#anoFiltro").val()+'|mesFiltro<=>'+$("#mesFiltro").val();
    params += '|tpoDespesaFiltro<=>'+$("#tpoDespesaFiltro").val()+'|statusFiltro<=>'+$("#statusFiltro").val();
    params += '|contaFiltro<=>'+$("#contaFiltro").val()+'|responsavelFiltro<=>'+$("#responsavelFiltro").val();
    ExecutaDispatch('Despesas', 'ListarDespesas', params, MontaGridDespesa);
}

function MontaGridDespesa(listaDespesa) {
    var objeto = listaDespesa[1];
    arrDespesas = listaDespesa[1];
    somarValorTotal();
    somarValorCartao();
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered mb-0' id='tableDespesas' width='100%' >";
    tabela += " <thead>";
    tabela += "     <tr>";
    tabela += "         <th class='align-top'>";
    tabela += "             <div class='form-check'>";
    tabela += "                 <input type='checkbox' class='form-check-input mb-2' id='allDespesas' onClick='marcarTodas()'>";
    tabela += "             </div>";
    tabela += "         </th>";
    tabela += "         <th>Descrição</th>";
    tabela += "         <th>Vencimento</th>";
    tabela += "         <th>Valor</th>";
    tabela += "         <th>Parcela</th>";
    tabela += "         <th>Tipo</th>";
    tabela += "         <th>Conta</th>";
    tabela += "         <th>Resp.</th>";
    tabela += "         <th>Status</th>";
    tabela += "         <th>Ações</th>";
    tabela += "     </tr>";
    tabela += " </thead>";
    tabela += " <tbody>";

    if (objeto != null) {
        for (var i in objeto) {
            var status = objeto[i].PAGO? 'Paga em: ' : 'Em aberto';
            var parcela = objeto[i].NRO_PARCELA_ATUAL&&objeto[i].QTD_PARCELAS? objeto[i].NRO_PARCELA_ATUAL+'/'+objeto[i].QTD_PARCELAS : 'unica';
            var isUnico = objeto[i].QTD_PARCELAS==1 ? 'disabled' : '';
            tabela += " <tr>";
            tabela += "     <td>";
            tabela += "         <div class='form-check'>";
            tabela += "             <input type='checkbox' class='form-check-input ckbDespesa' id='ckb"+objeto[i].COD_DESPESA+"' codDespesa='"+objeto[i].COD_DESPESA+"' onClick='eventosCheckbox()'>";
            tabela += "         </div>";
            tabela += "     </td>";
            tabela += "     <td>" + (objeto[i].DSC_DESPESA != null ? objeto[i].DSC_DESPESA : '') + "</td>";
            tabela += "     <td title='Lançada em: \n"+objeto[i].DTA_LANC_DESPESA_FORMATADO+"'>" + (objeto[i].DTA_DESPESA != null ? objeto[i].DTA_DESPESA_FORMATADO : '') + "</td>";
            tabela += "     <td align='end'>" + (objeto[i].VLR_DESPESA != null ? objeto[i].VLR_DESPESA : '') + "</td>";
            tabela += "     <td align='center'>" + parcela + "</td>";
            tabela += "     <td>" + (objeto[i].DSC_TIPO_DESPESA != null ? objeto[i].DSC_TIPO_DESPESA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].CONTA != null ? objeto[i].CONTA : '') + "</td>";
            tabela += "     <td>" + (objeto[i].DONO_DESPESA != null ? objeto[i].DONO_DESPESA : '') + "</td>";
            tabela += "     <td align='center'>" + status + objeto[i].DTA_PAGAMENTO_FORMATADO + "</td>";
            tabela += "     <td class='px-1' align='center'>";
            tabela += "         <div class='btn-group'>";
            tabela += "             <button class='btn btn-outline-primary px-2' title='Editar' onclick='javascript:chamaCadastroDespesa(" + objeto[i].COD_DESPESA + ");'><i class='fas fa-pen'></i></button>";
            tabela += "             <button class='btn btn-outline-secondary px-2' "+isUnico+" title='Quitar parcelas' onclick='javascript:quitarParcelas(" + objeto[i].COD_DESPESA + ");'><i class='fas fa-circle-dollar-to-slot'></i></button>";
            // tabela += "             <button class='btn btn-outline-success px-2' title='Pagar por conta' onclick='javascript:pagarPorConta(" + objeto[i].COD_DESPESA + ");'><i class='fas fa-dollar-sign'></i></button>";
            tabela += "             <button class='btn btn-outline-danger px-2' title='Excluir' onclick='javascript:deletarDespesa(" + objeto[i].COD_DESPESA + ");'><i class='fas fa-trash'></i></button>";
            tabela += "         </div>";
            tabela += "     </td>";
            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";
    $("#listaDespesas").html(tabela);

    MontaDataTable('tableDespesas', false, 1, true, 44);

}

function quitarParcelas(codDespesa) {
    ExecutaDispatch('Despesas', 'QuitarParcelas', 'codDespesa<=>'+codDespesa, CarregaGridDespesa, 'Aguarde, quitando parcelas.', 'Parcelas quitadas com sucesso!');    
}

function somarValorTotal() {
    var vlrTotal = 0;
    for(var i in arrDespesas) {
        vlrTotal = parseFloat(vlrTotal)+ parseFloat((arrDespesas[i].VLR_DESPESA.replace('.','')).replace(',','.'));
    }
    vlrTotal = number_format(vlrTotal,2,',','.');
    $("#vlrTotal").html('R$ '+vlrTotal);
}

function somarValorCartao() {
    var vlrCartao = 0;
    if (arrDespesas!=null){
        var despesasEmCartao = arrDespesas.filter(elm => elm.IND_IS_CARTAO == 'S');
    }
    for(var i in despesasEmCartao) {
        vlrCartao = parseFloat(vlrCartao)+ parseFloat((despesasEmCartao[i].VLR_DESPESA.replace('.','')).replace(',','.'));
    }
    vlrCartao = number_format(vlrCartao,2,',','.');
    $("#vlrCartao").html('<a class="text-white" href="javascript:listarDadosCartao();"><u>R$ '+vlrCartao+'</u></a>');
}

function listarDadosCartao(){
    var params = 'anoFiltro<=>'+$("#anoFiltro").val()+'|mesFiltro<=>'+$("#mesFiltro").val();
    ExecutaDispatch('Despesas', 'ListarDespesasCartao', params, MontaGridDespesa);
}

function marcarTodas() {
    codDespesasMarcadas = '';
    if($("#allDespesas").is(":checked")) {
        $(".ckbDespesa").each(function () {
            $(this).prop('checked', true);
            codDespesasMarcadas += $(this).attr('codDespesa')+'d';
        });
        $("#btnImportar").attr('disabled', false);
        $("#btnImportar").attr('title', 'Importar despesa(s).');
        $("#vlrSelecionado").html($("#vlrTotal").html());
    } else {
        codDespesasMarcadas = '';
        $(".ckbDespesa").each(function () {
            $(this).prop('checked', false);
        });
        $("#btnImportar").attr('disabled', true);
        $("#btnImportar").attr('title', 'Nenhuma despesa selecionada.');
        $("#vlrSelecionado").html('R$ 0,00');
    }
    $("#codDespesasImportacao").val(codDespesasMarcadas.substring(0, codDespesasMarcadas.length-1));
}

function eventosCheckbox() {
    $("#btnImportar").attr('disabled', true);
    $("#btnImportar").attr('title', 'Nenhuma despesa selecionada.');
    codDespesasMarcadas = '';
    var vlrSelecionado = 0;
    $(".ckbDespesa").each(function() {
        if ($(this).is(":checked")) {
            $("#btnImportar").attr('disabled', false);
            $("#btnImportar").attr('title', 'Importar despesa(s).');
            codDespesasMarcadas += $(this).attr('codDespesa')+'d';
            for(var i in arrDespesas) {
                if (arrDespesas[i].COD_DESPESA==$(this).attr('codDespesa')) {
                    // vlrSelecionado += parseFloat(arrDespesas[i].VLR_DESPESA.replace('.',''));
                    vlrSelecionado = parseFloat(vlrSelecionado)+ parseFloat((arrDespesas[i].VLR_DESPESA.replace('.','')).replace(',','.'));
                }
            }
        }
    });
    $("#codDespesasImportacao").val(codDespesasMarcadas.substring(0, codDespesasMarcadas.length-1));
    // vlrSelecionado = vlrSelecionado.toFixed(2).replace(',', '.');
    vlrSelecionado = number_format(vlrSelecionado,2,',','.');
    $("#vlrSelecionado").html('R$ '+vlrSelecionado);
}

function chamaCadastroDespesa(codDespesa) {
    var despesaSelecionada = arrDespesas.filter(elm => elm.COD_DESPESA == codDespesa)[0];
    PreencheCamposForm(despesaSelecionada, 'indDespesaPaga;B');
    $("#tetoTpoDespesa").html("");
    $("#infoTpoDespesa").html("");
    verificarTeto();
    $("#divDtaPagamento").show();
    $("#cadastroDespesaTitle").html('Editar Despesa');
    $("#cadastroDespesa").modal('show');
}

function deletarDespesa(codDespesa){   
    ExecutaDispatch('Despesas', 'DeletarDespesa', 'codDespesa<=>'+codDespesa, CarregaGridDespesa, 'Aguarde, excluindo despesa.', 'Despesa excluida com sucesso!');
}

function montaComboAnoFiltro(arr) {
    CriarSelect('anoRefImportacao', arr, anoAtual, false, '');
    CriarSelect('anoFiltro', arr, anoAtual, false, '');
    $("#anoFiltro").change(function() {
        CarregaGridDespesa();
    });
}

function montaComboMesFiltro(arr) {
    CriarSelect('mesRefImportacao', arr, mesAtual, false, '');
    CriarSelect('mesFiltro', arr, mesAtual, false, '');
    $("#mesFiltro").change(function() {
        CarregaGridDespesa();
    });
}

function montaComboTpoDespesaFiltro(arr) {
    CriarSelect('tpoDespesa', arr, -1, false);
    CriarSelect('tpoDespesaFiltro', arr, -1, false, '');
    $("#tpoDespesaFiltro").change(function() {
        CarregaGridDespesa();
    });
    $("#tpoDespesa").change(function() {
        verificarTeto();
    });
}

function montaComboStatusDespesaFiltro() {
    let arr = [true, [{ID: 'S', DSC: 'Paga'}, {ID: 'N', DSC: 'Em aberto'}]]
    CriarSelect('statusFiltro', arr, -1, false, '');
    $("#statusFiltro").change(function() {
        CarregaGridDespesa();
    });

}

function montaComboContaFiltro(arr) {
    CriarSelect('codConta', arr, -1, false);
    CriarSelect('contaFiltro', arr, -1, false, '');
    $("#contaFiltro").change(function() {
        CarregaGridDespesa();
    });
}

function montaComboResponsavelFiltro(arr) {
    CriarSelect('codUsuarioDespesa', arr, -1, false);
    CriarSelect('responsavelFiltro', arr, -1, false, '');
    $("#responsavelFiltro").change(function() {
        CarregaGridDespesa();
    });
}

$(document).ready(function() {
    $("#btnImportar").attr('disabled', true);
    $("#btnImportar").attr('title', 'Nenhuma despesa selecionada.');
    ExecutaDispatch('Despesas', 'ListarAnosFiltro', undefined, montaComboAnoFiltro);
    ExecutaDispatch('Despesas', 'ListarMesesFiltro', undefined, montaComboMesFiltro);
    ExecutaDispatch('TipoDespesa', 'ListarTiposDespesaFiltro', undefined, montaComboTpoDespesaFiltro);
    montaComboStatusDespesaFiltro();
    ExecutaDispatch('ContasBancarias', 'ListarContasFiltro', undefined, montaComboContaFiltro);
    ExecutaDispatch('Usuario', 'ListarResponsavelFiltro', undefined, montaComboResponsavelFiltro);
    ExecutaDispatch('Despesas', 'ListarDespesas', 'anoFiltro<=>'+anoAtual+'|mesFiltro<=>'+mesAtual, MontaGridDespesa);
});