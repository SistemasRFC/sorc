$(function() {
    $("#btnSalvarImportacao").click(function(){
        ImportarDespesas();
    });
});

function ImportarDespesas() {
    var params = 'codDespesas<=>'+$("#codDespesasImportacao").val()+'|anosRef<=>'+$("#anoRefImportacao").val()+'|mesRef<=>'+$("#mesRefImportacao").val();
    ExecutaDispatch('Despesas', 'ImportarDespesas', params, CarregaGridDespesa, 'Aguarde, importando despesa(s).', 'Despesa(s) importada(s) com sucesso!');
}

// $(document).ready(function(){
//     data = new Date();
//     ano = data.getFullYear();
//     mes = data.getMonth();
//     mes++;
//     if (mes<10){
//         mes = '0'+mes;
//     }
//     MontaComboFixo('comboNroAnoReferenciaImportacao', 'nroAnoReferenciaImportacao', ano, 100);
//     MontaComboFixo('comboNroMesReferenciaImportacao', 'nroMesReferenciaImportacao', mes, 150);
// });