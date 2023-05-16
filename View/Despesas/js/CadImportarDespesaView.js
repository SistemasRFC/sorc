$(function() {
    $("#btnImportar").click(function(){
        var dtaDespesa = $("#dtaDespesa").val();
        var arrDtaDespesa = dtaDespesa.split('/');
        dtaDespesa = arrDtaDespesa[0]+'/'+$("#nroMesReferenciaImportacao").val()+'/'+$("#nroAnoReferenciaImportacao").val();
        ImportarDespesa($("#codDespesa").val(), dtaDespesa);
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