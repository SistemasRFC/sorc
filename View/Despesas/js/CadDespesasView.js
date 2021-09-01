$(function() {
    $( "#dtaDespesa" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'});
    $( "#dtaPagamento" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
        nextText: 'Próximo',
        prevText: 'Anterior'});
    $( "#btnDeletar" ).click(function( event ) {
        deletarDespesa($("#codDespesa").val()); 
    });
    $( "#btnGrafico" ).click(function( event ) {
        CarregaGrafico(); 
    });
    $( "#btnSalvar" ).click(function( event ) {
        if ($("#indDespesaPaga").is(":checked")){
            if ($("#dtaPagamento").val()==''){
                alert('Selecione uma data de pagamento!');
                exit;
            }
            var check = 'S';
        }else{
            var check = 'N';
        }
        if ($("#codConta").val()=='-1'){
            $("#codConta").val('0');
        }
        if ($("#codTipoDespesa").val()=='-1'){
            alert('Selecione um tipo de despesa!');
            return;
        }
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando!");
        $( "#dialogInformacao" ).jqxWindow("open");   

        $.post('../../Controller/Despesas/DespesasController.php',
            {method: $("#method").val(),
            codDespesa: $("#codDespesa").val(),
            dscDespesa: $("#dscDespesa").val(),
            dtaDespesa: $("#dtaDespesa").val(),
            dtaPagamento: $("#dtaPagamento").val(),
            vlrDespesa: $("#vlrDespesa").val(),
            codConta: $("#comboCodConta").val(),
            codTipoDespesa: $("#comboCodTipoDespesa").val(),
            indDespesaPaga: check,
            qtdParcelas: $("#qtdParcelas").val(),
            nroParcelaAtual: $("#nroParcelaAtual").val()
        }, function(data){
            data = eval('('+data+')');
            if (data[0]){
                CarregaGridDespesa();
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Despesa salva com sucesso!');
                $( "#CadastroForm" ).jqxWindow( "close" );
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    CarregaGridTurma();
                },"2000");                
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar despesa!');                
            }
        });
    });
    
    $("#indDespesaPaga").change(function(){
       if($("#indDespesaPaga").is(":checked")){
           $("#trDtaDespesaPaga").show("slow");
       }else{
           $("#trDtaDespesaPaga").hide("slow");
       }
    });

    $("#codTipoDespesa").change(function(){
        $.post('../../Controller/Despesas/DespesasController.php',
            {method: 'PegaLimiteTipoDespesa',
             codTipoDespesa: $("#codTipoDespesa").val()},function(data){

                data = eval('('+data+')');

                if (data!=null){

                    $("#divValores").html('O mínimo programado era: '+data[0].vlrPiso+'<br>'+
                                          'O que você usou foi: '+data[0].vlrLimite+'<br>'+
                                          'O máximo programado é: '+data[0].vlrTeto);

                }
        });
    });
    
});