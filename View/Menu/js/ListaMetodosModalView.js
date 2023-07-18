function ListarMetodos(controller) {
    ExecutaDispatch('Menu', 'ListarMetodos', 'classe<=>' + controller, MontaListarMetodos);
}

function MontaListarMetodos(ListarMetodos) {
    objeto = ListarMetodos[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaMetodos' width='100%'>";
    tabela += "<thead>";
    tabela += "<tr>";
    tabela += "<td>Descrição</td>";
    tabela += "</tr></thead>";
    tabela += " <tbody>";
    for (var i in objeto) {
        tabela += " <tr style='color: blue;'>";
        tabela += "     <td class='tdClick' onClick='javascript:PreencheNomeClasseMetodo(\"" + objeto[i] + "\");'>" + objeto[i] + "</td>";
        tabela += " </tr>";
    }
    tabela += " </tbody>";
    tabela += "</table>";

    $("#divListarMetodos").html(tabela);

    MontaDataTable('tableListaMetodos', false);
}

function PreencheNomeClasseMetodo(NomeClasseMetodo) {
    $("#nmeMethod").val(NomeClasseMetodo.replace('Method.php', ''));
    $("#divListaMetodosModalView").modal('hide');
}