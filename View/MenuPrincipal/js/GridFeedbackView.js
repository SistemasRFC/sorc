$(function(){    
    $("#btnSalvar").click(function(){
        $( "#dialogInformacao" ).jqxWindow('setContent', "Aguarde, salvando Avaliacao!");
        $( "#dialogInformacao" ).jqxWindow("open");
        if ($("#indAtivo").jqxCheckBox('val')){
            ativo = 'S';
        }else{
            ativo = 'N';
        }        
        if ($("#tpoAtendimentoAtivo").val()){
            tpoAtendimento = 'A';
        }else if ($("#tpoAtendimentoReceptivo").val()){
            tpoAtendimento = 'R';
        }else{
            tpoAtendimento = '';
        }
        $.post('../../Controller/Avaliacao/AvaliacaoController.php',
            {method: $("#method").val(),
            codAvaliacao: $("#codAvaliacao").val(),
            codAvaliacaoAnt: $("#codAvaliacaoAnt").val(),
            dscAvaliacao: $("#dscAvaliacao").val(),
            tpoAtendimento: tpoAtendimento,
            indAtivo: ativo}, function(data){

            data = eval('('+data+')');
            if (data[0]==1){
                $( "#dialogInformacao" ).jqxWindow('setContent', "Registro salvo com sucesso!");
                CarregaGridAvaliacao();
                setTimeout(function(){
                    $( "#dialogInformacao" ).jqxWindow("close");
                    $( "#CadAvaliacao" ).jqxWindow("close");
                },"2000");
            }else{
                $( "#dialogInformacao" ).jqxWindow('setContent', 'Erro ao salvar Menu!'+data[1]);
            }
        });
    });
});
function CarregaGridFeedback(tipo){
    $("#GridFeedback").jqxWindow('open');
    $("#tipo").val(tipo);
    $.post('../../Controller/MenuPrincipal/MenuPrincipalController.php',
        {
            method: 'CarregaGridFeedback',
            tipo: $("#tipo").val()
        },
        function(listaFeedback){
             listaFeedback = eval ('('+listaFeedback+')');
             if (listaFeedback[0]==true){
                 MontaGridFeedback(listaFeedback[1]);
             }else{
                 $( "#dialogInformacao" ).jqxWindow('setContent', "Erro ao buscar atalhos!<br>"+listaFeedback[1]);
                 $( "#dialogInformacao" ).jqxWindow('open');
             }
        }
    );     
}

function MontaGridFeedback(listaFeedback){
    var theme = 'energyblue';
    var nomeGrid = 'listaFeedback';    
    var source =
    {
        localdata: listaFeedback,
        datatype: "json",
        datafields:
        [
            { name: 'COD_AVALIACAO', type: 'string' },
            { name: 'DTA_RESPOSTA', type: 'string' },
            { name: 'TXT_OBSERVACAO_COLABORADOR', type: 'string' }
        ]
    };
    var dataAdapter = new $.jqx.dataAdapter(source);
    $("#"+nomeGrid).jqxGrid(
    {
        width: 500,
        source: dataAdapter,
        theme: theme,
        sortable: true,
        filterable: true,
        pageable: true,
        columnsresize: true,
        selectionmode: 'singlerow',
        columns: [
          { text: 'C&oacute;digo', columntype: 'textbox', datafield: 'COD_AVALIACAO', width: 80},
          { text: 'Data', datafield: 'DTA_RESPOSTA', columntype: 'textbox', width: 280}
        ]
    });
    // events
    
    $("#"+nomeGrid).jqxGrid('localizestrings', localizationobj);
    $('#'+nomeGrid).on('rowdoubleclick', function (event)
    {

        var args = event.args;
        var rows = $("#"+nomeGrid).jqxGrid('getdisplayrows');
        var rowData = rows[args.visibleindex];
        var rowID = rowData.uid; 
        $("#codAvaliacao").val($("#"+nomeGrid).jqxGrid('getrowdatabyid', rowID).COD_AVALIACAO);        
        $("#txtObsComentarioColaborador").val($("#"+nomeGrid).jqxGrid('getrowdatabyid', rowID).TXT_OBSERVACAO_COLABORADOR);              
        $("#btnSalvarFeedback").hide();
        $("#btnVistoFeedback").show();
        $( "#ResponderFeedback" ).jqxWindow("open");
        CarregaInfoAvaliacao();                
    });    
    $("#dialogInformacao" ).jqxWindow("close");  
}