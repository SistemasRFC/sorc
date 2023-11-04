$(function() {
    $( "#btnDeletar" ).click(() => {
        deletarReceita($("#codReceita").val()); 
    });
    $( "#btnSalvar" ).click(() => {
        salvarReceita();
    });
    
});

function salvarReceita() {
    var method = 'AddReceita';
    if($("#codReceita").val() > 0) {
        method = 'UpdateReceita';
    }
    if ($("#codConta").val()=='-1') {
        $("#codConta").val('0');
    }

    ExecutaDispatch('Receitas', method, undefined, CarregaGridReceita, 'Aguarde! Salvando Receita.', 'Receita salva com sucesso!');
}