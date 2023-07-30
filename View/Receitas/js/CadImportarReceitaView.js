$(function() {
    $("#btnSalvarImportacao").click(function(){
        ImportarReceitas();
    });
});

function ImportarReceitas() {
    var params = 'codReceitas<=>'+$("#codReceitasImportacao").val()+'|anoRef<=>'+$("#anoRefImportacao").val()+'|mesRef<=>'+$("#mesRefImportacao").val();
    ExecutaDispatch('Receitas', 'ImportarReceitas', params, CarregaGridReceita, 'Aguarde, importando Receita(s).', 'Receita(s) importada(s) com sucesso!');
}
