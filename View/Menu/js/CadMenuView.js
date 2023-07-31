var method;
$(function() {
    // $("#btnDeletar").click(function() {
    //     DeleteMenu(); 
    // }); 
    $("#btnSalvar").click(function() {
        method = 'AddMenu';
        if ($("#codMenuW").val() > 0) {
            method = 'UpdateMenu';
        }
        if ($("#dscMenuW").val() == '') {
            swal('Atenção!', 'Informe uma descrição para esse menu.', 'warning');
            return false;
        }
        // if ($("#imagem").val() != "") {
        //     // var formData = new FormData($('form')[0]);
        //     ExecutaDispatch('Menu', 'uploadArquivo', undefined, preencherCaminhoArquivo, "Aguarde, fazendo upload do arquivo.");
        // } else {
            salvarMenu();
        // }
    });

    $("#btnController").click(function () {
        ListarControllers(undefined);
    });

    $("#btnMetodo").click(function () {
        ListarMetodos($("#nmeController").val());
    });
});

function preencherCaminhoArquivo(resp) {
    $("#dscCaminhoImagem").val(resp.msg);
    salvarMenu();
}

function salvarMenu() {
    ExecutaDispatch('Menu', method, undefined, CarregaGridMenu, "Aguarde, salvando o menu.", "Menu salvo com sucesso!");
}

function MontaComboMenuPai(ListarMenus) {
    CriarSelect('codMenuPaiW', ListarMenus, '-1', false);
}

// function DeleteMenu(){    
//     $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, removendo menu<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
//     $("#dialogInformacao" ).jqxWindow("open");    
//     $.post('../../Controller/Menu/MenuController.php',
//         {method: 'DeleteMenu',
//         codMenu: $("#codMenu").val()}, function(result){                            
//         result = eval('('+result+')');
//         if (result[0]==true){              
//             CarregaGridMenu();
//             $( "#CadMenus" ).jqxWindow("close");
//         }else{                                
//             $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao deletar Menu!'+result[1]);
//         }
//     });
// }


$(document).ready(function () {
    $("#btnMetodo").prop("disabled", true);
    ExecutaDispatch('Menu', 'ListarComboMenus', undefined, MontaComboMenuPai);
});