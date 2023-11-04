$(function() {
    $("#btnPesquisar").click(function(){
        var parametros = retornaParametros();
        ExecutaDispatch('Receitas','ListarReceitas', parametros, montaListaReceitas);        
    });
    $("#btnVoltar").click(function(){
        $(location).attr('href', '../../Dispatch.php?controller=MenuPrincipal&method=ChamaView&verificaPermissao=N');
    });
    $("#btnNovaReceita").click(function(){
        $(location).attr('href', './CadastraReceitaView.php');
    });
    
});

function montaListaReceitas(resp) {
    let listaReceitas = resp[1];
    let totalReceitas = resp[2].VLR_TOTAL;
    var html = "";
    html += "<table class='table table-striped'>";
    html += "   <thead>";
    html += "       <tr>";
    html += "           <th>Desc.</th>";
    html += "           <th>Valor</th>";
    html += "       </tr>";
    html += "   </thead>";
    html += "   <tbody>";
    if(listaReceitas!=null) {
        for(i in listaReceitas) {
            let item = listaReceitas[i];
            html += "       <tr onclick='javascript:chamaCadastraReceita(" + item.COD_RECEITA + ");'>";
            html += "           <td>"+item.DSC_RECEITA+"</td>";
            html += "           <td>R$ "+item.VLR_RECEITA+"</td>";
            html += "       </tr>";
        }
        html += "       <tr>";
        html += "           <td class='text-right'><b>TOTAL:</b></td>";
        html += "           <td>R$ "+totalReceitas+"</td>";
        html += "       </tr>";
    } else {
        html += "       <tr>";
        html += "           <td colspan='3'>NENHUMA RECEITA NESSE PERÍODO</td>";
        html += "       </tr>";
    }
    html += "   </tbody>";
    html += "</table>";


    $("#listaReceitas").html(html);
}

function chamaCadastraReceita(codReceita) {
    window.location.href = 'CadastraReceitaView.php?codReceita=' + codReceita;
}

function CarregaComboMeses(meses) {
    CriarSelectPuro('Mês', 'nroMesReferencia', meses, new Date().getMonth()+1);
}

function CarregaComboAnos(anos) {
    CriarSelectPuro('Ano', 'nroAnoReferencia', anos,  new Date().getFullYear());
}

$(document).ready(function(){
    ExecutaDispatch('Receitas', 'ListarMesesFiltro', 'verificaPermissao;N|', CarregaComboMeses);
    ExecutaDispatch('Receitas', 'ListarAnosFiltro', 'verificaPermissao;N|', CarregaComboAnos);
});