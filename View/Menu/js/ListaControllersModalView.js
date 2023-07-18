function ListarControllers(dir) {
    if (dir==undefined) {
        ExecutaDispatch('Menu', 'ListarControllers', undefined, MontaListarController);
    } else {
        ExecutaDispatch('Menu', 'ListarControllers', 'pasta<=>'+dir+'|', MontaListarController);
    }
}

function MontaListarController(ListarControllers) {
    objeto = ListarControllers[1];
    var tabela = "";
    tabela += "<table class='table table-striped table-hover table-bordered' id='tableListaController' width='100%'>";
    tabela += "<thead>";
    tabela += "<tr>";
    tabela += "<td>Descrição</td>";
    tabela += "<td>&nbsp;</td>";
    tabela += "</tr></thead>";
    tabela += " <tbody>";
    for (var i in objeto) {
        if (objeto[i].nmeArquivo != "..") {

            tabela += " <tr>";
            if (objeto[i].dscTipo == 'dir') {
                if (objeto[i].nmeArquivo == ".") {
                    tabela += "     <td style='color: blue;' class='tdClick' onClick='javascript:ListarControllers(\"" + objeto[i].nmeArquivo + "\");'>(Subir Nivel)</td>";
                } else if (objeto[i].nmeArquivo != "..") {
                    tabela += "     <td style='color: blue;' class='tdClick' onClick='javascript:ListarControllers(\"" + objeto[i].nmeArquivo + "\");'>" + (objeto[i].nmeArquivo != null ? objeto[i].nmeArquivo : '') + "</td>";
                }
            } else {
                tabela += "     <td>" + (objeto[i].nmeArquivo != null ? objeto[i].nmeArquivo : '') + "</td>";
            }
            if (objeto[i].dscTipo == 'file') {
                tabela += "     <td style='color: blue;' class='tdClick' onClick='javascript:PreencheNomeClasse(\"" + objeto[i].nmeArquivo + "\");'>utilizar</td>"
            } else {
                tabela += "     <td></td>";
            }

            tabela += " </tr>";
        }
    }
    tabela += " </tbody>";
    tabela += "</table>";

    $("#divListarController").html(tabela);
    MontaDataTable('tableListaController', false);
}

function PreencheNomeClasse(NomeClasse) {
    $("#nmeController").val(NomeClasse.replace('Controller.php', ''));
    $("#btnMetodo").prop("disabled", false);
    $("#divListaControllersModalView").modal('hide');
}