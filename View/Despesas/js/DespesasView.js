$(function() {
    $("#CadastroForm").jqxWindow({ 
        title: 'Cadastro de Despesas',
        height: 450,
        width: 700,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: theme,
        isModal: true,
        autoOpen: false
    });
    $("#GraficoForm").jqxWindow({ 
        title: 'Gráfico de Despesas',
        height: 450,
        width: 1200,
        maxWidth: 1200,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: theme,
        isModal: true,
        autoOpen: false
    });    
    $( "#btnPesquisa" ).click(function( event ) {
        CarregaGridDespesa();
    });    
    $( "#btnNovo" ).click(function( event ) {
        CadDespesa('AddDespesa', '0', '', '', '-1', '', '', '-1', '', 'N', '');        
    });      
    contextMenu = $("#jqxMenu").jqxMenu({ width: '120px', autoOpenPopup: false, mode: 'popup', theme: theme });;
    $("#jqxMenu").on('itemclick', function (event) {
        var args = event.args;
        var rowindex = $('#'+nomeGrid).jqxGrid('getselectedrowindex');
        if ($.trim($(args).text()) == "Importar") {
            ImportarDespesa($("#codDespesa").val(),
                            $("#dtaDespesa").val());
        }else if($.trim($(args).text()) == "Editar"){
            CadDespesa('UpdateDespesa',
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
            deletarDespesa($("#codDespesa").val());
        }else if($.trim($(args).text()) == "Quitar Parcelas"){
            quitarParcelas($("#codDespesa").val());
        }
    });    
    $("#btnExportar").click(function(){
        $("#ListagemForm").jqxGrid('exportdata', 'xls', 'jqxGrid');
    });
});



$(document).ready(function(){
    $(document).on('contextmenu', function (e) {
        return false;
    });
    MontaComboFixo('comboIndStatus', 'indStatus', '0');
    MontaComboFixo('comboTpoDespesa', 'tpoDespesa', '0');
    data = new Date();
    ano = data.getFullYear();
    mes = data.getMonth();
    mes++;
    if (mes<10){
        mes = '0'+mes;
    }
    MontaComboFixo('comboNroAnoReferencia', 'nroAnoReferencia', ano);
    MontaComboFixo('comboNroMesReferencia', 'nroMesReferencia', mes);
    MontaComboFixo('comboCodConta', 'codConta', '-1');
    MontaComboFixo('comboCodTipoDespesa', 'codTipoDespesa', '-1');
    if ($("#codPerfil").val()==3){
        MontaComboFixo('comboCodCliente', 'codCliente', '-1');
    }
    CarregaGridDespesa();    
});