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
    var html = "";
    html += "<table class='table table-striped'>";
    html += "   <thead>";
    html += "       <tr>";
    html += "           <th>Pago em</th>";
    html += "           <th>Descrição</th>";
    html += "           <th>Valor</th>";
    html += "       </tr>";
    html += "   </thead>";
    html += "   <tbody>";
    if(listaDespesas!=null) {
        for(i in listaDespesas){
            let item = listaDespesas[i]
            if(item.IND_PAGO == "N") {
                html += "       <tr style='background-color: #F6CECE'>";
                html += "           <td>"+item.DTA_DESPESA.substring(0,5)+"</td>";
            } else {
                html += "       <tr>";
                html += "           <td style='color: green'>"+item.DTA_PAGAMENTO.substring(0,5)+"</td>";
            }
            html += "           <td>"+item.DSC_DESPESA+"</td>";
            html += "           <td>R$ "+item.VLR_DESPESA+"</td>";
            html += "       </tr>";
        }
    } else {
        html += "       <tr>";
        html += "           <td colspan='3'>NENHUMA DESPESA NESSE PERÍODO</td>";
        html += "       </tr>";
    }
    html += "   </tbody>";
    html += "</table>";


    $("#listaDespesas").html(html);
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