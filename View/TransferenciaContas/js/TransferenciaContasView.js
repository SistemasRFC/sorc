$(function() {
    $("#CadastroForm").jqxWindow({ 
        title: 'Cadastro de Transferências entre contas',
        height: 450,
        width: 700,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: theme,
        isModal: true,
        autoOpen: false
    });  
    $( "#btnPesquisa" ).click(function( event ) {
        CarregaGridTransferenciaContas();
    });    
    $( "#btnNovo" ).click(function( event ) {
        CadTransferenciaContas('AddTransferenciaContas', '0', '', '', '-1', '', '', '-1', '', 'N', '');        
    });      
    contextMenu = $("#jqxMenu").jqxMenu({ width: '120px', autoOpenPopup: false, mode: 'popup', theme: theme });;
    $("#jqxMenu").on('itemclick', function (event) {
        var args = event.args;
        var rowindex = $('#'+nomeGrid).jqxGrid('getselectedrowindex');
        if ($.trim($(args).text()) == "Importar") {
            ImportarReceita($("#codReceita").val(),
                            $("#dtaReceita").val());
        }else if($.trim($(args).text()) == "Editar"){
            CadTransferenciaContas('UpdateTransferenciaContas',
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).COD_DESPESA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).DSC_DESPESA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).VLR_DESPESA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).TPO_DESPESA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).QTD_PARCELAS,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).NRO_PARCELA_ATUAL,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).COD_CONTA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).DTA_DESPESA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).IND_PAGO,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).DTA_PAGAMENTO);
        }else if($.trim($(args).text()) == "Excluir"){
            deletarReceita($("#codReceita").val());
        }
    });    
});



$(document).ready(function(){
    $(document).on('contextmenu', function (e) {
        return false;
    });
    data = new Date();
    ano = data.getFullYear();
    mes = data.getMonth();
    mes++;
    if (mes<10){
        mes = '0'+mes;
    }
    MontaComboFixo('comboNroAnoReferencia', 'nroAnoReferencia', ano);
    MontaComboFixo('comboNroMesReferencia', 'nroMesReferencia', mes);
    MontaComboFixo('comboCodContaOrigem', 'codContaOrigem', '-1');
    MontaComboFixo('comboCodContaDestino', 'codContaDestino', '-1');
    CarregaGridTransferenciaContas();    
});