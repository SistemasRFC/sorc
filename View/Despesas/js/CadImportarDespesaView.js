$(function() {
    $("#btnImportar").click(function(){
        ImportarDespesa(
            $("#codDespesasImportacao").val(), 
            $("#hdDtaDespesa").val(), 
            $("#nroMesReferenciaImportacao").val(), 
            $("#nroAnoReferenciaImportacao").val()
        );
    });
});

$(document).ready(function(){
    data = new Date();
    ano = data.getFullYear();
    mes = data.getMonth();
    mes++;
    if (mes<10){
        mes = '0'+mes;
    }
    MontaComboFixo('comboNroAnoReferenciaImportacao', 'nroAnoReferenciaImportacao', ano);
    MontaComboFixo('comboNroMesReferenciaImportacao', 'nroMesReferenciaImportacao', mes);
})