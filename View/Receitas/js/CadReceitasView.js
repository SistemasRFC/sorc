$(function() {
    $( "#btnDeletar" ).click(() => {
        deletarReceita($("#codReceita").val()); 
    });
    $( "#btnSalvar" ).click(() => {
        salvarReceita();
        // if ($("#indReceitaPaga").is(":checked")){
        //     if ($("#dtaPagamento").val()==''){
        //         alert('Selecione uma data de pagamento!');
        //         exit;
        //     }
        //     var check = 'S';
        // }else{
        //     var check = 'N';
        // }
        // if ($("#codConta").val()=='-1'){
        //     alert('Selecione uma Conta de pagamento!');
        //     return;
        // }
        // if ($("#codTipoReceita").val()=='-1'){
        //     alert('Selecione um tipo de Receita!');
        //     return;
        // }
        // $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando!");
        // $( "#dialogInformacao" ).jqxWindow("open");   

        // $.post('../../Controller/Receitas/ReceitasController.php',
        //     {method: $("#method").val(),
        //     codReceita: $("#codReceita").val(),
        //     dscReceita: $("#dscReceita").val(),
        //     dtaReceita: $("#dtaReceita").val(),
        //     vlrReceita: $("#vlrReceita").val(),
        //     codConta: $("#comboCodConta").val()
        // }, function(data){
        //     data = eval('('+data+')');
        //     if (data[0]){
        //         CarregaGridReceita();
        //         $( "#dialogInformacao" ).jqxWindow('setContent', 'Receita salva com sucesso!');
        //         $( "#CadastroForm" ).jqxWindow( "close" );
        //     }else{
        //         $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Receita!');                
        //     }
        // });
    });
    
});

function salvarReceita() {
    var method = 'AddReceita';
    if($("#codReceita").val() > 0) {
        method = 'UpdateReceita';
    }
    if ($("#codConta").val()=='-1') {
        $("#codConta").val('0');
    }

    ExecutaDispatch('Receitas', method, undefined, CarregaGridReceita, 'Aguarde! Salvando Receita.', 'Receita salva com sucesso!');
}