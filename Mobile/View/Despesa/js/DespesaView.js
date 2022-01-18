// $(document).on('keydown', 'input[pattern]', function(e){
//     var input = $(this);
//     var oldVal = input.val();
//     var regex = new RegExp(input.attr('pattern'), 'g');

//     setTimeout(function(){
//         var newVal = input.val();
//         if(!regex.test(newVal)){
//             input.val(oldVal); 
//         }
//     }, 1);
// });
$(function() {
    $("#btnPesquisar").click(function(){
        var parametros = retornaParametros();
        ExecutaDispatch('Despesas','ListarDespesas', parametros, montaListaDespesas);        
    });
    $("#btnVoltar").click(function(){
        $(location).attr('href', '../../Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N');
    })
});

function montaListaDespesas(resp) {
    let listaDespesas = resp[1];
    var html = "";
    html += "<table>";
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
            html += "       <tr>";
            if(item.IND_PAGO == "N") {
                html += "           <td>"+item.DTA_DESPESA.substring(0,5)+"</td>";
            } else {
                html += "           <td style='color: green'>"+item.DTA_PAGAMENTO.substring(0,5)+"</td>";
            }
            html += "           <td>"+item.DSC_DESPESA+"</td>";
            html += "           <td>R$ "+item.VLR_DESPESA+"</td>";
            html += "       </tr>";
        }
    } else {
        html += "       <tr>";
        html += "           <td colspan='3'> NENHUMA DESPESA NESSE PERÍODO</td>";
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