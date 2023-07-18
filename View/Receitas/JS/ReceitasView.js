
$(function() {
    $("#CadastroForm").jqxWindow({ 
        title: 'Cadastro de Receitas',
        height: 300,
        width: 700,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: theme,
        isModal: true,
        autoOpen: false
    });    
    $( "#btnPesquisa" ).click(function( event ) {
        CarregaGridReceita();
    });    
    $("#btnExcel").click(function () {
        alert('xls');
        $("#ListagemForm").jqxGrid('exportdata', 'xls', 'jqxGrid');           
    });    
    $( "#btnNovo" ).click(function( event ) {
        CadReceita('AddReceita', '0', '', '', '-1', '', '', '-1', '', 'N', '');        
    });      
    contextMenu = $("#jqxMenu").jqxMenu({ width: '120px', autoOpenPopup: false, mode: 'popup', theme: theme });;
    $("#jqxMenu").on('itemclick', function (event) {
        var args = event.args;
        var rowindex = $('#'+nomeGrid).jqxGrid('getselectedrowindex');
        if ($.trim($(args).text()) == "Importar") {
            ImportarReceita($("#codReceita").val(),
                            $("#dtaReceita").val());
        }else if($.trim($(args).text()) == "Editar"){
            CadReceita('UpdateReceita',
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).COD_RECEITA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).DSC_RECEITA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).VLR_RECEITA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).COD_CONTA,
                       $('#'+nomeGrid).jqxGrid('getrowdatabyid', rowindex).DTA_RECEITA);
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
    MontaComboFixo('comboCodConta', 'codConta', '-1');
    CarregaGridReceita();    
});