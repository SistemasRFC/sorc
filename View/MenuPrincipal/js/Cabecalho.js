$(document).ready(function(){
    $("input[type='button']").jqxButton({theme: theme}); 
    
    VerificaSessao();
    atualizaCliente();
    criaComboCliente();
});
function VerificaSessao(){
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php', {
        async: false,
        method: 'VerificaSessao'}, function(result){
        result = eval('('+result+')');
        if (!result){            
            window.location.href='../../index.php';
        }else{
            CarregaMenu();
        }
    });
}
function CarregaMenu(){
    $('#CriaMenu').html('<img src="../../Resources/images/carregando.gif" width="200" height="30">');
    var DadosMenu = '';
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php', {
        async: false,
        method: 'CarregaMenuNew'}, function(menu){
        menu = eval('('+menu+')');
        DadosMenu = menu;
        if (DadosMenu[0]){
            var source =
            {
                datatype: "json",
                datafields: [
                    { name: 'id', map: 'COD_MENU_W' },
                    { name: 'idPai', map: 'COD_MENU_PAI_W' },
                    { name: 'dscMenu', map: 'DSC_MENU_W' },
                    { name: 'subMenuWidth', map: 'VLR_TAMANHO_SUBMENU' }
                ],
                id: 'id',
                localdata: DadosMenu[1]
            };
            var dataAdapter = new $.jqx.dataAdapter(source);
            dataAdapter.dataBind();
            var records = dataAdapter.getRecordsHierarchy('id', 'idPai', 'items', [
                {name: 'dscMenu', map: 'label'},
                {name: 'id', map: 'id'}
            ]);
            $('#CriaMenu').jqxMenu({ source: records, height: 30, theme: theme });
            $("#CriaMenu").on('itemclick', function (event) {
                for(i=0;i<DadosMenu[1].length;i++){
                    if (event.args.id==DadosMenu[1][i].COD_MENU_W){ 
                        if((DadosMenu[1][i].NME_CONTROLLER!='#') && 
                           (DadosMenu[1][i].NME_CONTROLLER!='null') &&
                           (DadosMenu[1][i].NME_CONTROLLER!=null) &&
                           (DadosMenu[1][i].NME_CONTROLLER!='')){
                            window.location.href=DadosMenu[1][i].NME_PATH+'?method='+DadosMenu[1][i].NME_METHOD;
                        }
                    }
                }
            });
        }
    });
}
function CriarCombo(nmeCombo, url, parametros, dataFields, displayMember, valueMember){ 
    $("#td"+nmeCombo).html('');
    $("#td"+nmeCombo).html('<div id="'+nmeCombo+'"></div>');
    var dados = dataFields.split('|');
    var lista = new Array();
    for (i=0;i<dados.length;i++){
        var data = new Object();
        data.name = dados[i];
        lista.push(data);
    }

    var dados = parametros.split('|');   
    var obj = new Object();
    for (i=0;i<dados.length;i++){
        var campos = dados[i].split(';');
        Object.defineProperty(obj, campos[0], {
                            __proto__: null,
                            enumerable : true,
                            configurable : true,
                            value: campos[1] });
    }
    var source =
    {
        datatype: "json",
        type: "POST",
        datafields: lista,
        cache: false,
        url: url,
        data: obj
    };       
    var dataAdapter = new $.jqx.dataAdapter(source,{
        loadComplete: function (records){         
            $("#"+nmeCombo).jqxDropDownList(
            {
                source: records[1],
                theme: theme,
                width: 200,
                height: 25,
                selectedIndex: 0,
                displayMember: displayMember,
                valueMember: valueMember
            });  
        },
        async:true
                     
    });  
    dataAdapter.dataBind();    
}

function atualizaCliente(){
    if ($("#codPerfilCabecalho").val()==3){
        $("#comboCodClienteFinalSelecao").change(function(){
            $.post('../../Controller/Login/LoginController.php', {
                async: false,
                method: 'AtualizaCliente',
                codCliente: $("#comboCodClienteFinalSelecao").val()
            }).then(function(){
                window.location.href='../../View/MenuPrincipal/MenuPrincipalView.php';
            });            
        });
    }
}

function criaComboCliente(){
    if ($("#codPerfilCabecalho").val()==3){
        $.post('../../Controller/ClienteFinal/ClienteFinalController.php',
            {
                method: 'ListarClienteFinalAtivo'
            }, function(data){

            data = eval('('+data+')');
            if (data[0]){
                var dados = '<div id="comboCodClienteFinalSelecao"></div>';
                dados += '<select name="codClienteFinalSelecao" id="codClienteFinalSelecao" style="display:none">';
                dados += '<option value="-1">Selecione</option>';
                for (var i=0; i<data[1].length; i++){
                    if ($("#codClienteFinalSelecionado").val()==data[1][i]["COD_CLIENTE_FINAL"]){
                        dados += '<option value="'+data[1][i]["COD_CLIENTE_FINAL"]+'" selected>'+data[1][i]["DSC_CLIENTE_FINAL"]+'</option>';
                    }else{
                        dados += '<option value="'+data[1][i]["COD_CLIENTE_FINAL"]+'">'+data[1][i]["DSC_CLIENTE_FINAL"]+'</option>';
                    }
                }
                dados += '</select>';
                $( "#tdcodClienteFinalSelecao" ).html(dados); 
                MontaComboFixoCabecalho("comboCodClienteFinalSelecao", "codClienteFinalSelecao", $("#codClienteFinalSelecionado").val());
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao excluir cliente! '+data[1]);
            }
        }); 
    }
}
function MontaComboFixoCabecalho(nmeCombo, nmeSelect, seleciona){
    $("#"+nmeCombo).jqxDropDownList({ width: '200px', height: '25px'});
    $("#"+nmeCombo).jqxDropDownList('loadFromSelect', nmeSelect);  
    $("#"+nmeSelect).val(seleciona);
    var index = $("#"+nmeSelect)[0].selectedIndex;
    $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
    $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);    
    
    $("#"+nmeCombo).on('select', function (event) {
        var args = event.args;
        // select the item in the 'select' tag.
        var index = args.item.index;
        $("#"+nmeSelect).val(args.item.value);
        
    });  
    atualizaCliente();
//    $("#"+nmeSelect).on('change', function (event) {
//        updating = true;
//        $("#"+nmeSelect).val(seleciona);
//        var index = $("#"+nmeSelect)[0].selectedIndex;
//        $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
//        $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);
//        updating = false;
//    });    
}