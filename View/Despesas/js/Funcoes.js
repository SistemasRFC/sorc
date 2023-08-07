var selectedrowindexes='';
var totalValor = 0;
var contextMenu = '';
var nomeGrid = 'ListagemForm';

// function AtualizaValores(soma){
//     soma = String(soma);
//     soma = soma.replace(',','');
//     soma = soma.replace(',','.');   
//     totalValor = String(totalValor);
//     totalValor = totalValor.replace(',',''); 
//     totalValor = totalValor.replace(',','.');             
//     total = totalValor;
//     total = parseFloat(total)-parseFloat(soma);      
//     soma = Formata(soma,2,'.',',');
//     total = Formata(total,2,'.',',');        
//     $("#vlrSelecionado").html(soma);
//     $("#vlrTotal").html(total);
// }

function deletarDespesa(codDespesa){
    ExecutaDispatch('Despesas', 'DeletarDespesa', 'codDespesa<=>'+codDespesa, CarregaGridDespesa, 'Aguarde, excluindo despesa.', 'Despesa excluida com sucesso!');
}

function quitarParcelas(codDespesa) {
    ExecutaDispatch('Despesas', 'QuitarParcelas', 'codDespesa<=>'+codDespesa, CarregaGridDespesa, 'Aguarde, quitando parcelas.', 'Parcelas quitadas com sucesso!');    
}

function pagarPorConta(codDespesa) {
    ExecutaDispatch('Despesas', 'PagarPorConta', 'codDespesa<=>'+codDespesa, CarregaGridDespesa, 'Aguarde, pagando por conta.', 'Pagamento por conta realizado com sucesso!');
}