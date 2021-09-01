$(function() {
    $( "#CadastroForm" ).dialog({
        autoOpen: true,
        width: "90%",
        position: [0,0],
        title: 'Importação de despesas',
        buttons: [
                {
                    text: "Importar",
                    click: function() {
                        $( "#dialogInformacao" ).html('Aguarde, importando saldo!');
                        $("#btnOK").hide();
                        $( "#dialogInformacao" ).dialog( "open" );
                        $.post('../../Controller/Despesas/DespesasController.php',
                            {method: 'ImportarDespesas',
                             nroAnoReferencia: $("#nroAnoReferencia").val(),
                             nroMesReferencia: $("#nroMesReferencia").val(),
                             nroAnoReferenciaDestino: $("#nroAnoReferenciaDestino").val(),
                             nroMesReferenciaDestino: $("#nroMesReferenciaDestino").val(),
                             tpoDespesa: $("#tpoDespesa").val(),
                             codDespesaSelecao: $("#codDespesaSelecao").val(),
                             indStatus: -1,
                             ordenacao: 'DTA_DESPESA',
                             orientaOrdenacao: 'ASC'}, function(data){
                            data = eval('('+data+')');
                            if (data==1){
                                $( "#dialogInformacao" ).html('Saldo Importado com sucesso!');
                                $("#btnOK").show();
                                setTimeout(function(){
                                    $( "#dialogInformacao" ).jqxWindow("close");
                                    CarregaGridTurma();
                                },"2000");                                
                                //window.setTimeout(function() { $( "#dialogInformacao" ).dialog( "close" ); }, 1500);
                            }else{
                                $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
                                $("#btnOK").show();
                            }
                        });
                    }
                }
        ],
        close: function(ev, ui) { window.location='../MenuPrincipal.php'; }
    });

    $("#btnPesquisar").click(function(){
        $.post('../../Controller/Despesas/DespesasController.php',
            {method: 'ListarDespesas',
             nroAnoReferencia: $("#nroAnoReferencia").val(),
             nroMesReferencia: $("#nroMesReferencia").val(),
             tpoDespesa: $("#tpoDespesa").val(),
             indStatus: $("#indStatus").val(),
             ordenacao: 'DTA_DESPESA',
             orientaOrdenacao: 'ASC'}, function(data){
            data = eval('('+data+')');
            if (data!=null){
                carregaTabela(data);
            }else{
                $( "#dialogInformacao" ).html('Erro ao importar Saldo!');
                $("#btnOK").show();
            }
        });
    });
});

$(document).ready(function(){
    $(document).on('contextmenu', function (e) {
        return false;
    });
    MontaComboFixo('comboIndStatus', 'indStatus', '0');
    MontaComboFixo('comboTpoDespesa', 'tpoDespesa', '0');
    data = new Date();
    ano = data.getFullYear();
    mes = data.getMonth();
    mes++;
    if (mes<10){
        mes = '0'+mes;
    }
    MontaComboFixo('comboNroAnoReferencia', 'nroAnoReferencia', ano);
    MontaComboFixo('comboNroMesReferencia', 'nroMesReferencia', mes);
    CarregaGridDespesa();    
});