$(function() {
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });    
    $( "#CadUsuarios" ).jqxWindow({
        autoOpen: false,
        height: 450,
        width: 650,
        theme: theme,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Cadastro de Usu&aacute;rios',
        isModal: true
    });      
    $( "#dialogInformacao" ).jqxWindow({
        autoOpen: false,
        height: 150,
        width: 450,
        theme: 'energyblue',
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        title: 'Mensagem',
        isModal: true
    });      
    $("#nroCpf").mask('999.999.999-99');
    $("#btnNovo").click(function(){    
        LimparCampos();
        $("#CadUsuarios").jqxWindow("open");
    });
    
    $("#btnReiniciarSenha").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");        
        $('#method').val('ReiniciarSenha');
        $.post('../../Controller/Seguranca/UsuarioController.php',
              {method: $("#method").val(),
               codUsuario: $("#codUsuario").val()}, function(data){
            data = eval('('+data+')');
            if (data[0]){          
                CarregaGridUsuario();
                $( "#dialogInformacao" ).jqxWindow('setContent',"<h4 style='text-align:center;'>Usu&aacute;rio salvo com sucesso!\n\r A Senha para Acessar &eacute; 123459.</h4>");
                setTimeout(function(){
                    $("#CadUsuarios").jqxWindow("close");                   
                },"2000");                     
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent','Erro ao salvar Usu&aacute;rio!'+data);
                $( "#dialogInformacao" ).jqxWindow( "open" );
            }
        });
    });    
    $("#nroCpf").blur(function(){
       if ((!valCpf($("#nroCpf").val()))&&($("#nroCpf").val()!='')){
            $( "#dialogInformacao" ).jqxWindow('setContent', "<h4 style='text-align:center;'>CPF Inv&aacute;lido!</h4>");
            $( "#dialogInformacao" ).jqxWindow("open");    
            $("#nroCpf").focus();
        }
    });
    $("#btnSalvar").click(function(){
	
        $( "#dialogInformacao" ).jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, salvando registro!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($('#codUsuario').val()==0){
            $('#method').val('AddUsuario');
        }else{
            $('#method').val('UpdateUsuario');
        }
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        }           
        var checkBoxes = '';     
        $.post('../../Controller/Seguranca/UsuarioController.php',
              {method: $("#method").val(),
               nmeUsuario: $("#nmeUsuario").val(),
               codUsuario: $("#codUsuario").val(),
               nmeLogin: $("#nmeLogin").val(),
               codPerfil: $("#codPerfil").val(),
               indAtivo: ativo,
               txtEmail: $("#txtEmail").val()}, function(data){

            data = eval('('+data+')'); 
            if (data[0]){
                CarregaGridUsuario();
                if (data[1]!=$("#codUsuario").val()){
                    $( "#dialogInformacao" ).jqxWindow('setContent',"<h4 style='text-align:center;'>Usu&aacute;rio salvo com sucesso!\n\r A Senha para Acessar &eacute; 123459.</h4>");
                }else{                   
                    $( "#dialogInformacao" ).jqxWindow('setContent',"<h4 style='text-align:center;'>Usu&aacute;rio salvo com sucesso!</h4>");
                    setTimeout(function(){
                        $( "#dialogInformacao" ).jqxWindow("close");
                        $( "#CadUsuarios" ).jqxWindow("close");
                    },"2000");                     
                }
                $( "#dialogInformacao" ).jqxWindow( "open" );
                $("#codUsuario").val(data[1]);
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent','Erro ao salvar Usu&aacute;rio!'+data);
                $( "#dialogInformacao" ).jqxWindow( "open" );
            }
        });
    });
});
function CarregaComboPerfil(){
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando Combo!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");    
    $.post('../../Controller/Seguranca/PerfilController.php',
           {
               method: 'ListarPerfilAtivo'
           },
           function(listaPefil){
                listaPefil = eval ('('+listaPefil+')');
                if (listaPefil[0]==true){
                    MontaComboPerfil(listaPefil[1]);
                    $( "#dialogInformacao" ).jqxWindow('close');
                }else{                    
                    $( "#dialogInformacao" ).jqxWindow('setContent', 'N&atilde;o foi poss&iacute;vel executar a consulta!<br>'+listaPefil[1]);
                    $( "#dialogInformacao" ).jqxWindow('open');
                }                
           }
    );
}
function MontaComboPerfil(listaPefil){    
    var source =
    {
        localdata: listaPefil,
        datatype: "json",
        datafields:
        [
            { name: 'COD_PERFIL_W', type: 'string' },
            { name: 'DSC_PERFIL_W', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);    
    $("#codPerfil").jqxDropDownList(
    {
        source: dataAdapter,
        theme: theme,
        width: 200,
        height: 25,
        selectedIndex: 0,
        displayMember: 'DSC_PERFIL_W',
        valueMember: 'COD_PERFIL_W'
    });                
}
function valCpf(c){ 
    var Soma; 
    var Resto; 
    Soma = 0; 
    var strCPF;
    strCPF = c.replace(".","");
    strCPF = strCPF.replace(".","");
    cpf = strCPF.replace("-","");
    var numeros, digitos, soma, i, resultado, digitos_iguais;
    digitos_iguais = 1;
    if (cpf.length < 11)
          return false;
    for (i = 0; i < cpf.length - 1; i++)
          if (cpf.charAt(i) != cpf.charAt(i + 1))
                {
                digitos_iguais = 0;
                break;
                }
    if (!digitos_iguais)
          {
          numeros = cpf.substring(0,9);
          digitos = cpf.substring(9);
          soma = 0;
          for (i = 10; i > 1; i--)
                soma += numeros.charAt(10 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(0))
                return false;
          numeros = cpf.substring(0,10);
          soma = 0;
          for (i = 11; i > 1; i--)
                soma += numeros.charAt(11 - i) * i;
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(1))
                return false;
          return true;
          }
    else
        return false;
  }

function CarregaGridUsuario(){
    $("#tdGrid").html("");
    $("#tdGrid").html('<div id="listaUsuarios"></div>');    
    $('#listaUsuarios').html("<img src='../../Resources/images/carregando.gif' width='200' height='30'>");
    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Aguarde, carregando grid!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></h4>");
    $("#dialogInformacao" ).jqxWindow("open");      
    $.post('../../Controller/Seguranca/UsuarioController.php',
           {
               method: 'ListarUsuario'
           },
           function(listaUsuario){
                listaUsuario = eval ('('+listaUsuario+')');
                if (listaUsuario[0]){
                    MontaTabelaUsuario(listaUsuario[1]);
                }else{
                    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Erro ao listar Usu&aacute;rios! <br> "+listaUsuario[1]+"</h4>");                    
                }
           }
    );
}
function MontaTabelaUsuario(listaUsuario){
    var nomeGrid = 'listaUsuarios';    
    var source =
    {
        localdata: listaUsuario,
        datatype: "json",
        updaterow: function (rowid, rowdata, commit) {
            commit(true);
        },
        datafields:
        [
            { name: 'COD_USUARIO', type: 'string' },
            { name: 'NME_USUARIO', type: 'string' },
            { name: 'NME_USUARIO_COMPLETO', type: 'string' },
            { name: 'TXT_EMAIL', type: 'string' },
            { name: 'COD_PERFIL_W', type: 'string' },
            { name: 'DSC_PERFIL_W', type: 'string' },
            { name: 'NRO_CPF', type: 'string' },
            { name: 'IND_ATIVO', type: 'string' },
            { name: 'ATIVO', type: 'boolean' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 1000,
        source: dataAdapter,
        theme: theme,
        sortable: true,
        filterable: true,
        pageable: true,
        columnsresize: true,
        selectionmode: 'singlerow',
        columns: [
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_USUARIO', width: 80},
          { text: 'Login', datafield: 'NME_USUARIO', columntype: 'textbox', width: 180},
          { text: 'Nome', datafield: 'NME_USUARIO_COMPLETO', columntype: 'textbox', width: 180},
          { text: 'Email', datafield: 'TXT_EMAIL', columntype: 'textbox', width: 180},
          { text: 'Pefil', datafield: 'COD_PERFIL_W', columntype: 'textbox', width: 180},
          { text: 'Perfil', datafield: 'DSC_PERFIL_W', columntype: 'textbox', width: 180},
          { text: 'CPF', datafield: 'NRO_CPF', columntype: 'textbox', width: 180},
          { text: 'Ativo', datafield: 'ATIVO', columntype: 'checkbox', width: 67 }
        ]
    });
    // events
    $('#'+nomeGrid).jqxGrid('hidecolumn', 'COD_PERFIL_W');
    $('#'+nomeGrid).jqxGrid('hidecolumn', 'NRO_CPF');
    
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {

        var args = event.args;
        var rows = $('#listaUsuarios').jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid;        
        $("#codUsuario").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_USUARIO);
        $("#nmeLogin").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).NME_USUARIO);
        $("#nmeUsuario").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).NME_USUARIO_COMPLETO);
        $("#txtEmail").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).TXT_EMAIL);
        $("#codPerfil").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).COD_PERFIL_W);
        $("#nroCpf").val($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).NRO_CPF);                 
        if ($('#listaUsuarios').jqxGrid('getrowdatabyid', rowID).IND_ATIVO=='S'){            
            $("#indAtivo").jqxCheckBox('check');
        }else{            
            $("#indAtivo").jqxCheckBox('uncheck');
        }
        $("#method").val("UpdateMenu");
        $("#CadUsuarios").jqxWindow("open");
    });    
    $("#dialogInformacao" ).jqxWindow("close");  
}

function LimparCampos(){
    $("#codUsuario").val('');
    $("#nmeLogin").val('');
    $("#nmeUsuario").val('');
    $("#txtEmail").val('');
    $("#codPerfil").val('0');
    $("#nroCpf").val('');
}

function CarregaClientes(){
    $.post('../../Controller/Loja/LojaController.php',
           {
               method: 'ListarLojaAtiva'
           },
           function(listaCliente){
                listaCliente = eval ('('+listaCliente+')');
                if (listaCliente[0]){
                    MontaComboLojas(listaCliente[1]);
                }else{
                    $("#dialogInformacao").jqxWindow('setContent', "<h4 style='text-align:center;'>Erro ao listar Imobili&aacute;rias! <br> "+listaCliente[1]+"</h4>");                    
                }
           }
    );
}
function Monta(listaCliente){
    
}
$(document).ready(function(){
    CarregaComboPerfil();
    CarregaGridUsuario();    
    CriarCombo('codCliente', 
               '../../Controller/ClienteFinal/ClienteFinalController.php', 
               'method;ListarClienteFinalAtivo', 
               'COD_CLIENTE_FINAL|NME_CLIENTE_FINAL', 
               'DSC_CLIENTE_FINAL', 
               'COD_CLIENTE_FINAL');  
});