$(function() {
    $( "#dialogInformacao" ).dialog({
        autoOpen: false,
        width: 450,
        show: 'explode',
        hide: 'explode',
        title: 'Informação',
        modal: true,
        buttons: [
                {
                    text: "Ok",
                    click: function() {
                        $( this ).dialog( "close" );
                    }
                }
        ],
        close: function(ev, ui) { $("#CadastroForm").dialog("close");}
    });
    $( "#CadastroForm" ).dialog({
        autoOpen: true,
        width: 600,
        title: 'Importação de saldo',
        buttons: [
                {
                    text: "Importar",
                    click: function() {
                        $( "#dialogInformacao" ).html('Aguarde, importando saldo!');
                        $("#btnOK").hide();
                        $( "#dialogInformacao" ).dialog( "open" );
                        $.post('../../Controller/ContasBancarias/ContasBancariasController.php',
                            {method: 'ImportarSaldo',
                             nroAnoReferencia: $("#nroAnoReferencia").val(),
                             nroMesReferencia: $("#nroMesReferencia").val()}, function(data){
                            data = eval('('+data+')');
                            if (data==1){
                                $( "#dialogInformacao" ).html('Saldo Importado com sucesso!');
                                $("#btnOK").show();
                                window.setTimeout(function() { $( "#dialogInformacao" ).dialog( "close" ); }, 1500);
                            }else{
                                $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
                                $("#btnOK").show();
                            }
                        });
                    }
                }
        ],
        close: function(ev, ui) { window.location='../MenuPrincipal.php'; }
    });
});