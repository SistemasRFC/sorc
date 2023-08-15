$(function() {
    $("#btnPesquisar").click(function(){
        var parametros = retornaParametros();
        ExecutaDispatch('Despesas','ListarDespesas', parametros, montaListaDespesas);        
    });
    $("#btnVoltar").click(function(){
        $(location).attr('href', '../../Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N');
    });
    $("#btnNovaDespesa").click(function(){
        $(location).attr('href', './CadastraDespesaView.php');
    });
    
});

function montaListaDespesas(resp) {
    let listaDespesas = resp[1];
    let totalDespesas = resp[2].VLR_TOTAL;
    var html = "";
    html += "<table class='table table-striped'>";
    html += "   <thead>";
    html += "       <tr>";
    html += "           <th>Data</th>";
    html += "           <th>Desc.</th>";
    html += "           <th>Valor</th>";
    html += "       </tr>";
    html += "   </thead>";
    html += "   <tbody>";
    if(listaDespesas!=null) {
        for(i in listaDespesas){
            let item = listaDespesas[i];
            let arrdata = item.DTA_DESPESA.split('-');
            const date = new Date(arrdata[0], arrdata[1]-1, arrdata[2]);
            if(item.IND_PAGO == "N") {
                if(date < new Date()) {
                    html += "       <tr onclick='javascript:chamaCadastraDespesa(" + item.COD_DESPESA + ");'>";
                    html += "           <td style='color: red'>"+item.DTA_DESPESA_FORMATADO.substring(0,5)+"</td>";
                } else {
                    html += "       <tr onclick='javascript:chamaCadastraDespesa(" + item.COD_DESPESA + ");'>";
                    html += "           <td>"+item.DTA_DESPESA_FORMATADO.substring(0,5)+"</td>";
                }
            } else {
                html += "       <tr onclick='javascript:chamaCadastraDespesa(" + item.COD_DESPESA + ");'>";
                html += "           <td style='color: green'>"+item.DTA_PAGAMENTO_FORMATADO.substring(0,5)+"</td>";
            }
            html += "           <td>"+item.DSC_DESPESA+"</td>";
            html += "           <td>R$ "+item.VLR_DESPESA+"</td>";
            html += "       </tr>";
        }
        html += "       <tr>";
        html += "           <td colspan='2' class='text-right'><b>TOTAL:</b></td>";
        html += "           <td>R$ "+totalDespesas+"</td>";
        html += "       </tr>";
    } else {
        html += "       <tr>";
        html += "           <td colspan='3'>NENHUMA DESPESA NESSE PERÍODO</td>";
        html += "       </tr>";
    }
    html += "   </tbody>";
    html += "</table>";


    $("#listaDespesas").html(html);
}

function chamaCadastraDespesa(codDespesa) {
    window.location.href = 'CadastraDespesaView.php?codDespesa=' + codDespesa;
    // var despesaSelecionada = arrDespesas.filter(elm => elm.COD_DESPESA == codDespesa)[0];
    // PreencheCamposForm(despesaSelecionada, 'indDespesaPaga;B');
}

function CarregaComboMeses(meses) {
    CriarSelectPuro('Mês', 'nroMesReferencia', meses, new Date().getMonth()+1);
}

function CarregaComboAnos(anos) {
    CriarSelectPuro('Ano', 'nroAnoReferencia', anos,  new Date().getFullYear());
}

$(document).ready(function(){
    ExecutaDispatch('Despesas', 'ListarMeses', 'verificaPermissao;N|', CarregaComboMeses);
    ExecutaDispatch('Despesas', 'ListarAnos', 'verificaPermissao;N|', CarregaComboAnos);
});