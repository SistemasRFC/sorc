$(function() {
    $("#indAtivo").jqxCheckBox({ width: 120, height: 25, theme: theme });
    $( "#btnSalvar" ).click(function( event ) {
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando!");
        $( "#dialogInformacao" ).jqxWindow("open");    
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        } 
        $.post('../../Controller/TipoDespesa/TipoDespesaController.php',
            {method: $('#method').val(),
            codTipoDespesa: $("#codTipoDespesa").val(),
            dscTipoDespesa: $("#dscTipoDespesa").val(),
            vlrPiso: $("#vlrPiso").val(),
            vlrTeto: $("#vlrTeto").val(),
            indAtivo: ativo}, function(data){

            data = eval('('+data+')');
            if (data[0]){
                CarregaGridTipoDespesa();
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo!");
                $( "#CadastroForm" ).jqxWindow( "close" );
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar conta!');
            }
        });
    });
});