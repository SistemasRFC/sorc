$(function() {
    $("#CadastroForm").jqxWindow({ 
        title: 'Cadastro de Clientes',
        height: 250,
        width: 500,
        animationType: 'fade',
        showAnimationDuration: 500,
        closeAnimationDuration: 500,
        theme: theme,
        isModal: true,
        autoOpen: false
    });    
    $( "#btnNovo" ).click(function( event ) {
        CadTipoDespesa('AddTipoDespesa', '0', '', '', '', true);  
    });    

});
$(document).ready(function(){
    $(document).on('contextmenu', function (e) {
        return false;
    });
    CarregaGridTipoDespesa();    
});