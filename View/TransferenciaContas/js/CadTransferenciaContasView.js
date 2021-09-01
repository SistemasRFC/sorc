$(function() {
    $( "#dtaMovimentacao" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'});
    $( "#btnDeletar" ).click(function( event ) {
        deletarTransferenciaConta($("#codTransferencia").val()); 
    });
    $( "#btnSalvar" ).click(function( event ) {        
        if ($("#comboCodContaOrigem").val()=='-1'){
            alert('Selecione uma Conta de origem!');
            return;
        }       
        if ($("#comboCodContaDestino").val()=='-1'){
            alert('Selecione uma Conta de destino!');
            return;
        }
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando!");
        $( "#dialogInformacao" ).jqxWindow("open");   

        $.post('../../Controller/TransferenciaConta/TransferenciaContasController.php',
            {method: $("#method").val(),
            codTransferencia: $("#codTransferencia").val(),
            dtaMovimentacao: $("#dtaMovimentacao").val(),
            vlrMovimentacao: $("#vlrMovimentacao").val(),
            codContaOrigem: $("#comboCodContaOrigem").val(),
            codContaDestino: $("#comboCodContaDestino").val()
        }, function(data){
            data = eval('('+data+')');
            if (data[0]){
                CarregaGridTransferenciaContas();
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Transferencia salva com sucesso!');
                $( "#CadastroForm" ).jqxWindow( "close" );
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar despesa!');                
            }
        });
    });
    
});