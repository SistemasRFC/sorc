$(function() {
    $( "#btnPesquisa" ).click(function( event ) {
        CarregaDadosGrafico();
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

function CarregaDadosGrafico(){
    $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde!");
    $( "#dialogInformacao" ).jqxWindow("open");
    $.post('../../Controller/Relatorios/TotalPorTipoController.php',
        {method: 'ListarDespesasPorTipo',
        nroAnoReferencia: $("#comboNroAnoReferencia").val(),
        nroMesReferencia: $("#comboNroMesReferencia").val()},function(data){

            data = eval('('+data+')');
            if (data[0]){
                if (data[1]!=null){
                    MontaGrafico(data[1]);
                }
                $( "#dialogInformacao" ).jqxWindow("close");      

            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', "Erro: "+data[1]);             
            }
    });
}

function MontaGrafico(dados){
// prepare chart data as an array
    var source =
    {
        localdata: dados,
        datatype: "json",
        datafields: [
            { name: 'DSC_TIPO_DESPESA' },
            { name: 'VLR_DESPESA' }
        ]        
    };
    
    var dataAdapter = new $.jqx.dataAdapter(
        source, 
        { 
            async: false, 
            autoBind: true, 
            loadError: function (xhr, status, error) { 
                alert('Error loading "' + source.url + '" : ' + error); 
            } 
        }
    );
    var settings = {
        title: "Total de despesas por tipo",
        description: "",
        enableAnimations: true,
        showLegend: false,
        padding: {left: 10, top: 5, right: 10, bottom: 5},
        titlePadding: {left: 90, top: 0, right: 0, bottom: 10},
        source: dataAdapter,
        xAxis:
                {
                    dataField: 'DSC_TIPO_DESPESA', 
                    description: 'Tipo',
                    showGridLines: true,
                    flip: false
                },
        colorScheme: 'scheme01',
        seriesGroups:
                [
                    {
                        type: 'column',
                        orientation: 'horizontal',
                        columnsGapPercent: 100,
                        formatSettings: {
                            prefix: '',
                            decimalPlaces: 2,
                            decimalSeparator: ',',
                            thousandsSeparator: '.',
                            sufix: ''
                        },
                        showLabels: true,
                        valueAxis:
                                {
                                    flip: true,
                                    unitInterval: 500,
                                    minValue: 0,
                                    maxValue: 100000,
                                    description: 'Valor Gasto',
                                    tickMarksColor: '#888888'
                                },
                        series: [
                            {dataField: 'VLR_DESPESA', displayText: 'Valor', symbolType: 'square'}
                        ]
                    }
                ]
    };
    $('#GraficoForm').jqxChart(settings);    
}

$(document).ready(function(){
    $(document).on('contextmenu', function (e) {
        return false;
    });
    data = new Date();
    ano = data.getFullYear();
    mes = data.getMonth();
    mes++;
    if (mes<10){
        mes = '0'+mes;
    }
    MontaComboFixo('comboNroAnoReferencia', 'nroAnoReferencia', ano);
    MontaComboFixo('comboNroMesReferencia', 'nroMesReferencia', mes);
});

