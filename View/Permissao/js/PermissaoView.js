var ListaMenuPerfil;
$(function() {
    $("#btnSalvar").click(function(){
        if ($("#codPerfilW").val() < 0) {
            swal('Atenção', 'Por Favor, selecione um Perfil para prosseguir.', 'warning');
            return false;
        }
        var checkBoxes = '';
        $(".check").each(function () {
            if ($(this).prop('checked')) {
                checkBoxes += $(this).attr('codMenu') + '=>SP';
            } else {
                checkBoxes += $(this).attr('codMenu') + '=>NP';
            }
        });
        ExecutaDispatch('Permissao', 'AtualizaPermissoes', 'codPerfilW<=>'+$("#codPerfilW").val()+'|listaUpdate<=>'+checkBoxes+'|verificaPermissao<=>N', undefined, 'Aguarde. Atualizando permissões', 'Permissões atualizadas!');     
    });
});

function MontaComboPerfil(ListarPerfisAtivos) {
    CriarSelect('codPerfilW', ListarPerfisAtivos, '-1', false);
    
    $("#codPerfilW").change(function () {
        if($(this).val() == -1) {
            $("#chkTodos").prop("disabled", true);
            $("#checkboxes").html("Selecione um perfil acima.");
            ListaMenuPerfil = undefined;                                 
        } else {
            ExecutaDispatch('permissao', 'ListarMenusPerfil', undefined, MontaListaMenusPerfil);
            $("#chkTodos").prop("disabled", false);        
        }
        $("#chkTodos").prop("checked", false);
    });
}

function marcarTodos() {
    if($("#chkTodos").is(":checked")) {
        $(".check").each(function () {
            $(this).prop('checked', true);
        });
    } else {
        $(".check").each(function () {
            $(this).prop('checked', false);
        });
    }
}

function MontaListaMenusPerfil(resultado) {
    ListaMenuPerfil = resultado[1];
    count=3;
    tabela = ''; 
    for(var i in ListaMenuPerfil){
        if (count==3){
            tabela += "<tr>";
            count=0;
        }       
        if (ListaMenuPerfil[i].DSC_MENU_PAI!=null){
            dscMenu = "<strong>"+ListaMenuPerfil[i].DSC_MENU_PAI+"</strong> >>> "+ListaMenuPerfil[i].DSC_MENU_W;
        }else{
            dscMenu = ListaMenuPerfil[i].DSC_MENU_W;
        }
        tabela += "<td width='400px'>";
        tabela += " <div class='custom-control custom-checkbox mt-2'>";
        tabela += "  <input type='checkbox' id='chk"+ListaMenuPerfil[i].COD_MENU_W+"' codMenu='"+ListaMenuPerfil[i].COD_MENU_W+"' class='custom-control-input check' />";
        tabela += "  <label class='custom-control-label' for='chk"+ListaMenuPerfil[i].COD_MENU_W+"'>"+dscMenu+"</label>";
        tabela += " </div>";
        tabela += "</td>";
        count++;
        if (count==3){
              tabela += "</tr>";
        }
    }  

    $("#checkboxes").html(tabela);
    for(var i in ListaMenuPerfil){        
        if (ListaMenuPerfil[i].PERFIL == null){            
            $("#chk"+ListaMenuPerfil[i].COD_MENU_W).prop("checked", false);
        }else{            
            $("#chk"+ListaMenuPerfil[i].COD_MENU_W).prop("checked", true);
        }
    }
}

$(document).ready(() => {
    ExecutaDispatch('Perfil', 'ListarPerfilAtivo', undefined, MontaComboPerfil);
    $("#chkTodos").prop("disabled", true);

});
