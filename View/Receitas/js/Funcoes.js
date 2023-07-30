var selectedrowindexes='';
var totalValor = 0;
var contextMenu = '';
var nomeGrid = 'ListagemForm';
// function CadReceita(method, codReceita, dscReceita, vlrReceita, tpoReceita, qtdParcelas, nroParcelaAtual, codConta, dtaReceita, indPago, dtaPago){
//      $( "#CadastroForm" ).jqxWindow( "open" );
//      $("#method").val(method);
//      if (codReceita>0){
//          $("#btnDeletar").show();
//      }else{
//          $("#btnDeletar").hide();
//      }
//      $("#codReceita").val(codReceita);
//      $("#dscReceita").val(dscReceita);
//      $("#dtaReceita").val(dtaReceita);
//      $("#dtaPagamento").val(dtaPago);
//      $("#qtdParcelas").val(qtdParcelas);
//      $("#nroParcelaAtual").val(nroParcelaAtual);     
//      vlrReceita = String(vlrReceita).replace('.',',');     
//      $("#vlrReceita").val(vlrReceita);
//      $("#comboCodConta").val(codConta);
//      $("#comboCodTipoReceita").val(tpoReceita);
//      if (indPago=='S'){
//          $("#indReceitaPaga").attr('checked');
//      }else{
//          $("#indReceitaPaga").removeAttr('checked');
//      }
// }

// function CarregaGridReceita(){
//     $("#tdGrid").html('');
//     $("#tdGrid").html('<div id="ListagemForm"></div>');
//     //$("#tdMenu").html('');
//     //$("#tdMenu").html('<div id="jqxMenu"><ul><li><a href="#">Importar</a></li><li><a href="#">Editar</a></li><li><a href="#">Excluir</a></li></ul></div>');
//     $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
//     $( "#dialogInformacao" ).jqxWindow("open");
//     $.post('../../Controller/Receitas/ReceitasController.php',
//         {method: 'ListarReceitas',
//         nroAnoReferencia: $("#comboNroAnoReferencia").val(),
//         nroMesReferencia: $("#comboNroMesReferencia").val()},function(data){

//             data = eval('('+data+')');
//             if (data[0]){

//                 MontaTabelaReceita(data[1]);
//                 if (data[1]!=null){
//                     totalValor = 0;
//                     for (i=0;i<data[1].length;i++){            
//                         totalValor = parseFloat(totalValor)+parseFloat(data[1][i].VLR_RECEITA);
//                     }        
//                     totalValor = Formata(totalValor,2,'.',',');
//                     $("#vlrTotal").html(totalValor); 
//                     $("#vlrSelecionado").html('0');
//                 }
//                 $( "#dialogInformacao" ).jqxWindow("close");      

//             }else{
//                 $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
//             }
//     });
// }
// function MontaTabelaReceita(listaReceitas){
    
//     var source =
//     {
//         localdata: listaReceitas,
//         datatype: "json",
//         datafields:
//         [
//             { name: 'COD_RECEITA', type: 'int' },
//             { name: 'DTA_RECEITA', type: 'string' },
//             { name: 'VLR_RECEITA', type: 'float' },
//             { name: 'DSC_RECEITA', type: 'string' },
//             { name: 'CONTA', type: 'string' },
//             { name: 'COD_CONTA', type: 'int' }
//         ]
//     };
//     var dataAdapter = new $.jqx.dataAdapter(source);
//     $("#"+nomeGrid).jqxGrid(
//     {
//         width: 1200,
//         source: dataAdapter,
//         theme: theme,
//         sortable: true,
//         filterable: true,
//         pageable: false,
//         columnsresize: true,
//         selectionmode: 'multiplerows',
//         columns: [
//           { text: 'Descri&ccedil;&atilde;o', datafield: 'DSC_RECEITA', columntype: 'textbox', width: 280},
//           { text: 'Data', datafield: 'DTA_RECEITA', columntype: 'datetimeinput', width: 80},
//           { text: 'Valor', columntype: 'numberinput', cellsalign: 'right', datafield: 'VLR_RECEITA', width: 80, cellsformat: "f2"},
//           { text: 'Conta', datafield: 'CONTA', columntype: 'textbox', width: 250}
//         ]
//     });
//     // events
//     $('#'+nomeGrid).on('rowclick', function (event)
//     {
//         var args = event.args;
//         var row = args.rowindex;
//         $("#codReceita").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_RECEITA);
//         $("#dscReceita").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DSC_RECEITA);
//         $("#dtaReceita").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_RECEITA);
//         $("#vlrReceita").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_RECEITA);
//         $("#comboCodConta").val($('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA);        
//         if (event.args.rightclick) {

//             $("#"+nomeGrid).jqxGrid('selectrow', event.args.rowindex);
//             var scrollTop = $(window).scrollTop();
//             var scrollLeft = $(window).scrollLeft();
//             contextMenu.jqxMenu('open', parseInt(event.args.originalEvent.clientX) + 5 + scrollLeft, parseInt(event.args.originalEvent.clientY) + 5 + scrollTop);
//             return false;
//         }        
//     });
//     $('#'+nomeGrid).on('rowselect', function (event) 
//     {
//         selectedrowindexes = $('#'+nomeGrid).jqxGrid('selectedrowindexes');
//         soma = 0;
//         for (i=0;i<selectedrowindexes.length;i++){            
//             soma = parseFloat(soma)+parseFloat($('#'+nomeGrid).jqxGrid('getrowdatabyid', selectedrowindexes[i]).VLR_RECEITA);
//         }    
//         AtualizaValores(soma);
//     });
    
//     $('#'+nomeGrid).on('rowunselect', function (event) 
//     {
//         selectedrowindexes = $('#'+nomeGrid).jqxGrid('selectedrowindexes');
//         soma = 0;
//         for (i=0;i<selectedrowindexes.length;i++){            
//             soma = parseFloat(soma)+parseFloat($('#'+nomeGrid).jqxGrid('getrowdatabyid', selectedrowindexes[i]).VLR_RECEITA);
//         }    
//         AtualizaValores(soma);
//     });
//     $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
//     $('#'+nomeGrid).on('rowdoubleclick', function (event)
//     {
//         var args = event.args;
//         CadReceita('UpdateReceita',
//                    $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_RECEITA,
//                    $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DSC_RECEITA,
//                    $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).VLR_RECEITA,
//                    $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).COD_CONTA,
//                    $('#'+nomeGrid).jqxGrid('getrowdatabyid', args.rowindex).DTA_RECEITA);
//     });
    
//     $("#dialogInformacao" ).jqxWindow("close");  
// }

// function ImportarReceita(codReceita, dtaReceita){
//     $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, Removendo a despesa!");
//     $( "#dialogInformacao" ).jqxWindow("open"); 
//     $.post('../../Controller/Receitas/ReceitasController.php',
//         {method:'ImportarReceita',
//          codReceita: codReceita,
//          dtaReceita: dtaReceita}, function(data){
//             data = eval('('+data+')');
//             if(data[0]){
//                 $( "#dialogInformacao" ).jqxWindow('setContent', 'Receita importada com sucesso!'); 
//             }else{
//                 $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao importada despesa! '+data[1]);                
//             }
//          }
//     );
// }
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

// function deletarReceita(codReceita) {
//     ExecutaDispatch('Receitas', 'DeletarReceita', 'codReceita<=>'+codReceita, CarregaGridReceita, 'Aguarde, excluindo receita.', 'Receita excluida com sucesso!');
// }

// function MontaComboFixo(nmeCombo, nmeSelect, seleciona){
//     $("#"+nmeCombo).jqxDropDownList({ width: '200px', height: '25px'});
//     $("#"+nmeCombo).jqxDropDownList('loadFromSelect', nmeSelect);  
//     $("#"+nmeSelect).val(seleciona);
//     var index = $("#"+nmeSelect)[0].selectedIndex;
//     $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
//     $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);    
    
//     $("#"+nmeCombo).on('select', function (event) {
//         var args = event.args;
//         // select the item in the 'select' tag.
//         var index = args.item.index;
//         $("#"+nmeSelect).val(args.item.value);
        
//     });  
//     $("#"+nmeSelect).on('change', function (event) {
//         updating = true;
//         $("#"+nmeSelect).val(seleciona);
//         var index = $("#"+nmeSelect)[0].selectedIndex;
//         $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
//         $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);
//         updating = false;
//     });    
// }