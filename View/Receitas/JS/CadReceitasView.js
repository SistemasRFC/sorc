$(function() {
    $( "#dtaReceita" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'});
    $( "#btnDeletar" ).click(function( event ) {
        deletarReceita($("#codReceita").val()); 
    });
    $( "#btnSalvar" ).click(function( event ) {
        if ($("#indReceitaPaga").is(":checked")){
            if ($("#dtaPagamento").val()==''){
                alert('Selecione uma data de pagamento!');
                exit;
            }
            var check = 'S';
        }else{
            var check = 'N';
        }
        if ($("#codConta").val()=='-1'){
            alert('Selecione uma Conta de pagamento!');
            return;
        }
        if ($("#codTipoReceita").val()=='-1'){
            alert('Selecione um tipo de despesa!');
            return;
        }
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando!");
        $( "#dialogInformacao" ).jqxWindow("open");   

        $.post('../../Controller/Receitas/ReceitasController.php',
            {method: $("#method").val(),
            codReceita: $("#codReceita").val(),
            dscReceita: $("#dscReceita").val(),
            dtaReceita: $("#dtaReceita").val(),
            vlrReceita: $("#vlrReceita").val(),
            codConta: $("#comboCodConta").val()
        }, function(data){
            data = eval('('+data+')');
            if (data[0]){
                CarregaGridReceita();
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Receita salva com sucesso!');
                $( "#CadastroForm" ).jqxWindow( "close" );
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar despesa!');                
            }
        });
    });
    
});