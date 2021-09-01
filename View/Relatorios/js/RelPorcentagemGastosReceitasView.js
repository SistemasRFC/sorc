$(function(){
    $( "#btnGrafico" ).click(function( event ) {
        CarregaGrafico(); 
    }); 
});
function MontaComboFixo(nmeCombo, nmeSelect, seleciona){
    $("#"+nmeCombo).jqxDropDownList({ width: '200px', height: '25px'});
    $("#"+nmeCombo).jqxDropDownList('loadFromSelect', nmeSelect);  
    $("#"+nmeSelect).val(seleciona);
    var index = $("#"+nmeSelect)[0].selectedIndex;
    $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
    $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);    
    
    $("#"+nmeCombo).on('select', function (event) {
        var args = event.args;
        // select the item in the 'select' tag.
        var index = args.item.index;
        $("#"+nmeSelect).val(args.item.value);
        
    });  
    $("#"+nmeSelect).on('change', function (event) {
        updating = true;
        $("#"+nmeSelect).val(seleciona);
        var index = $("#"+nmeSelect)[0].selectedIndex;
        $("#"+nmeCombo).jqxDropDownList('selectIndex', index);
        $("#"+nmeCombo).jqxDropDownList('ensureVisible', index);
        updating = false;
    });    
}

function MontaComboAno(){
    var source =
    {
        datatype: "json",
        type: "POST",
        datafields: [
            { name: 'NRO_ANO_REFERENCIA', type: 'string'}
        ],
        cache: false,
        url: '../../Controller/Relatorios/RelPorcentagemGastosReceitasController.php',
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

function CarregaGrafico(){
    $.post('../../Controller/Relatorios/RelPorcentagemGastosReceitasController.php',
        {method: 'CarregaRegistros',
         nroAnoReferencia: $("#comboNroAnoReferencia").val(),
         nroMesReferencia: $("#comboNroMesReferencia").val(),
         indStatus: $("#comboIndStatus").val()}, function(data){
        data = eval('('+data+')');
        if (data[0]){
            MontaGrafico(data[1]);
        }else{
            $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
            $("#btnOK").show();
        }
    });
}
function MontaGrafico(Data) {
    // prepare chart data as an array
    for (i=0;i<Data.length;i++){
        Data[i].VLR_DESPESA = (parseFloat(Data[i].VLR_DESPESA.replace(',', ''))/parseFloat(Data[i].VLR_RECEITA.replace(',', '')))*100;        
    }
    console.log(Data);    
    var source =
    {
        localdata: Data,
        datatype: "json",
        datafields: [
            { name: 'MES' },
            { name: 'ANO' },
            { name: 'DSC_TIPO_DESPESA' },
            { name: 'VLR_DESPESA' },
            { name: 'VLR_RECEITA' }
        ]        
    };
    var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
    // prepare jqxChart settings
    var settings = {
        title: "Despesas por Tipo",
        description: "",
        enableAnimations: true,
        showLegend: false,
        legendLayout: { left: 400, top: 140, width: 300, height: 300, flow: 'vertical' },
        padding: { left: 5, top: 5, right: 10, bottom: 5 },
        titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
        source: dataAdapter,
        colorScheme: 'scheme01',
        xAxis:
                    {
                        dataField: 'DSC_TIPO_DESPESA',
                        showGridLines: true,
                        flip: false
                    },        
        seriesGroups:
            [
                {
                    type: 'column',
                    valueAxis:
                    {
                        unitInterval: 50,
                        minValue: 0,
                        maxValue: 100,
                        displayValueAxis: true,
                    },
                    showLabels: true,
                    series: [
                            { 
                                dataField: 'VLR_DESPESA',
                                displayText: 'Tipos ',
                                labelRadius: 170,
                                initialAngle: 35,
                                radius: 155,
                                centerOffset: 0,
                                formatSettings: { sufix: ' %', decimalPlaces: 2 } }
                        ]
                }
            ]
    };  
    // setup the chart
    $('#jqxChart').jqxChart(settings);  
};
$(document).ready(function(){
    MontaComboAno();    
    MontaComboMes();
    MontaComboFixo('comboIndStatus', 'indStatus', '0');    
});