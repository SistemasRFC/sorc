$(function(){
    $( "#btnGrafico" ).click(function( event ) {
        CarregaRegistros(); 
    }); 
});
function MontaComboAno(){
    var source =
    {
        datatype: "json",
        type: "POST",
        datafields: [
            { name: 'NRO_ANO_REFERENCIA', type: 'string'}
        ],
        cache: false,
        url: '../../Controller/Relatorios/RelResumoAnualController.php',
        data:{
              method: 'ListarAnos'
        }
    };        
    var dataAdapter = new $.jqx.dataAdapter(source,{
        loadComplete: function (records){         
            $("#comboNroAnoReferencia").jqxDropDownList(
            {
                source: records,
                theme: theme,
                width: 200,
                height: 25,
                selectedIndex: 0,
                displayMember: 'NRO_ANO_REFERENCIA',
                valueMember: 'NRO_ANO_REFERENCIA'
            });  
        },
        async:true
                     
    });  
    dataAdapter.dataBind();    
}

function MontaComboMes(){
    var source =
    {
        datatype: "json",
        type: "POST",
        datafields: [
            { name: 'NRO_MES_REFERENCIA', type: 'string'},
            { name: 'DSC_MES_REFERENCIA', type: 'string'}
        ],
        cache: false,
        url: '../../Controller/Relatorios/RelPorcentagemGastosReceitasController.php',
        data:{
              method: 'ListarMeses'
        }
    };        
    var dataAdapter = new $.jqx.dataAdapter(source,{
        loadComplete: function (records){         
            $("#comboNroMesReferencia").jqxDropDownList(
            {
                source: records,
                theme: theme,
                width: 200,
                height: 25,
                selectedIndex: 0,
                displayMember: 'DSC_MES_REFERENCIA',
                valueMember: 'NRO_MES_REFERENCIA'
            });  
        },
        async:true
                     
    });  
    dataAdapter.dataBind();    
}

function CarregaRegistros(){
    $.post('../../Controller/Relatorios/RelDespesasPagamentoController.php',
        {method: 'CarregaRegistros',
         nroAnoReferencia: $("#comboNroAnoReferencia").val(),
         nroMesReferencia: $("#comboNroMesReferencia").val()
     }, function(data){
        data = eval('('+data+')');
        if (data[0]){
            MontaTabelaDespesas(data[1], data[2]);
        }else{
            $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
            $("#btnOK").show();
        }
    });    
}

function MontaTabelaDespesas(objResult, vlrTotal){
    cor = "#C0C0C0";
    tabela = '<table style="border: 1px solid #000;" width=100%>';
    tabela += '<tr bgcolor="'+cor+'">';
    tabela += '<td>Data de Pagamento</td>';
    tabela += '<td>Descrição</td>';
    tabela += '<td>Valor</td>';
    tabela += '</tr>';
    for (i=0;i<objResult.length;i++){
        if (cor=="#C0C0C0"){
            cor = "white";
        }else{
            cor="#C0C0C0";
        }
        tabela += '<tr bgcolor="'+cor+'">';
        tabela += '<td>'+objResult[i].DTA_PAGAMENTO+'</td>';
        tabela += '<td>'+objResult[i].DSC_DESPESA+'</td>';
        tabela += '<td style="text-align: right">'+objResult[i].VLR_DESPESA+'</td>';        
        tabela += '</tr>';        
    }
    cor="#C0C0C0";
    tabela += '<tr bgcolor="'+cor+'">';
    tabela += '<td colspan="2">Valor Total</td>';
    tabela += '<td style="text-align: right">'+vlrTotal+'</td>';        
    tabela += '</tr>';            
    tabela += '</table>';
    $("#divResumo").html(tabela);
}

$(document).ready(function(){
    MontaComboAno(); 
    MontaComboMes();
});
