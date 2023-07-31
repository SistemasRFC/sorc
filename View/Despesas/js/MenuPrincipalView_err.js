// $(function() {
//     // $( "#Menu" ).jqxWindow({
//     //     autoOpen: true,
//     //     theme: theme,
//     //     width: $(window).width()-20,
//     //     height: $(window).height()-20,
//     //     position: 'center',
//     //     title: 'AHC - Menu Principal',
//     //     open: function(event, ui) {
//     //         $(this).parents(".ui-dialog:first").find(".ui-dialog-titlebar-close").remove();
//     //     }
//     // });
    
// });
// function CarregaAtalhos() {
//     $("#divAtalhos").html("<span style='align:center;'>Aguarde, Carregando!<br><img src='../../Resources/images/carregando.gif' width='200' height='30'></span>");
//     ExecutaDispatch('MenuPrincipal', 'CarregaAtalhos', undefined, MontaTabelaAtalhos);
//     // $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php',
//     //     {
//     //         method: 'CarregaAtalhos'
//     //     },
//     //     function(listaAtalhos){
//     //          listaAtalhos = eval ('('+listaAtalhos+')');
//     //          if (listaAtalhos[0]==true){
//     //              MontaTabelaAtalhos(listaAtalhos[1]);
//     //          }else{
//     //              $("#divAtalhos").html("<span style='align:center;'>Erro ao buscar atalhos!<br>"+listaAtalhos[1]);
//     //          }
//     //     }
//     // );
// }

// function MontaTabelaAtalhos(listaAtalhos){
//     listaAtalhos = listaAtalhos[1];
//     grid = '';
//     if (listaAtalhos!=null) {
//         j=0;
//         for(i=0;i<listaAtalhos.length;i++){
//             if (j==0) {
//                 grid = '<div class="row">';
//             }
//             grid += '<div class="col-3">';
//             grid += '   <button class="btn btn-link" onClick="javascript:window.location.href="'+listaAtalhos[i].NME_CONTROLLER+'?method='+listaAtalhos[i].NME_METHOD+'">';
//             grid += '       <i class="'+listaAtalhos[i].DSC_CAMINHO_IMAGEM+'"></i> ';
//             grid += '   </button>';
//             grid += '</div> ';
//             // grid += "<a style='padding-left:45px;' href='"+listaAtalhos[i].NME_CONTROLLER+"?method="+listaAtalhos[i].NME_METHOD+"'><img src='"+listaAtalhos[i].DSC_CAMINHO_IMAGEM+"' title='"+listaAtalhos[i].DSC_MENU_W+"' width='65' height='65'></a>";
//             j++;
//             if (j==4){
//                 grid += "</div>";
//                 j=0;
//             }
//         }
//     }
//     $("#divAtalhos").html(grid);
// }

// function MontaTabelaNoticias(listaNoticias){
//     if (listaNoticias!=null){
//         tabela = '<table width="100%">';
//         for(i=0;i<listaNoticias.length;i++){
//             tabela = tabela + '<tr><td style="font-size:20;font-family: arial, helvetica, serif;height:10%;">'+listaNoticias[i].DTA_NOTICIA+' - '+listaNoticias[i].DSC_TITULO+'</td></tr>';
//             tabela = tabela + '<tr><td>'+listaNoticias[i].TXT_NOTICIA+'</td></tr>';
//             tabela = tabela + '<tr><td style="border-bottom:1px solid #000000;"><br><br></td></tr>';
//         }
//         tabela = tabela + '</table>';
//     }else{
//         tabela = '';
//     }
//     $("#divNoticias").html(tabela);
// }

// function chamaAtalho(controller, method){    
//     window.location.href = controller+'?method='+method;
// }

// // function CarregaGrafico(){
// //     $.post('../../Controller/Despesas/DespesasController.php',
// //         {method: 'ListarSomaTipoDespesas',
// //          nroAnoReferencia: $("#nroAnoReferencia").val(),
// //          nroMesReferencia: $("#nroMesReferencia").val(),
// //          tpoDespesa: $("#tpoDespesa").val(),
// //          indStatus: -1,
// //          ordenacao: 'DTA_DESPESA',
// //          orientaOrdenacao: 'ASC'}, function(data){
// //         data = eval('('+data+')');
// //         if (data[0]){
// //             MontaGrafico(data[1]);
// //         }else{
// //             $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
// //             $("#btnOK").show();
// //         }
// //     });
// // }
// // function MontaGrafico(Data) {
// //     // prepare chart data as an array
// //     total = 0;
// //     for (i=0;i<Data.length;i++){
// //         total = parseFloat(Data[i].VALOR.replace(',', ''))+parseFloat(total);
// //     }
// //     for (i=0;i<Data.length;i++){
// //         Data[i].VALOR = (parseFloat(Data[i].VALOR.replace(',', ''))/parseFloat(total))*100;
// //         Data[i].DSC_TIPO_DESPESA = Data[i].DSC_TIPO_DESPESA+' '+Formata(Data[i].VALOR,2,',','.')+'%';
// //     }
// //     console.log(Data);
// //     var source =
// //     {
// //         localdata: Data,
// //         datatype: "json",
// //         datafields: [
// //             { name: 'DSC_TIPO_DESPESA' },
// //             { name: 'VALOR' }
// //         ]        
// //     };
// //     var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
// //     // prepare jqxChart settings
// //     var settings = {
// //         title: "Resumo Mensal de Gastos",
// //         description: "",
// //         enableAnimations: true,
// //         showLegend: true,
// //         legendLayout: { left: 400, top: 140, width: 300, height: 300, flow: 'vertical' },
// //         padding: { left: -150, top: 5, right: 5, bottom: 5 },
// //         titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
// //         source: dataAdapter,
// //         colorScheme: 'scheme01',
// //         seriesGroups:
// //             [
// //                 {
// //                     type: 'pie',
// //                     showLabels: true,
// //                     series:
// //                         [
// //                             {
// //                                 dataField: 'VALOR',
// //                                 displayText: 'DSC_TIPO_DESPESA',
// //                                 labelRadius: 170,
// //                                 initialAngle: 35,
// //                                 radius: 155,
// //                                 centerOffset: 0,
// //                                 formatSettings: { sufix: ' %', decimalPlaces: 2 }
// //                             }
// //                         ]
// //                 }
// //             ]
// //     };
// //     // setup the chart
// //     $('#jqxChart').jqxChart(settings);
// // };

// $(document).ready(function() {
//     CarregaAtalhos();   
//     CarregaGrafico();
// });
