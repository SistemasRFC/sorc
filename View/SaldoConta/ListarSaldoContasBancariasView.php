<html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <!--link href="../../Resources/css/style.css" rel="stylesheet" type="text/css"-->
    <script language="JavaScript" type="text/JavaScript"></script>
    <script src="../../Resources/JavaScript.js"></script>
    <link href="../../Resources/css/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <script src="../../Resources/js/jquery-1.9.0.js"></script>
    <script src="../../Resources/js/jquery-ui-1.10.0.custom.js"></script>
    <script src="../../Resources/js/svJavaScript.js"></script>
<script>
$(function() {
    $( "#dtaReceita" ).datepicker({
            dateFormat: 'dd/mm/yy',
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            nextText: 'Próximo',
            prevText: 'Anterior'});
    $( "#Listagem" ).dialog({
            autoOpen: true,
            width: 1000,
            height: 700,
            title: 'Relatório de Saldo de Contas',
            buttons: [
                    {
                            text: "Nova Receita",
                            click: function() {
                                $("#codigo").val(0);
                                $("#dscReceita").val('');
                                $("#dtaReceita").val('');
                                $("#vlrReceita").val('');
                                $("#codConta").val(0);
                                $("#tpoReceita").val(0);
                            }
                    },
                    {
                        text: "Salvar",
                        click: function() {
                            if ($('#codigo').val()==0){
                                $('#method').val('AddReceita');
                            }else{
                                $('#method').val('UpdateReceita');
                            }
                            $.post('../../Controller/Receitas/ReceitasController.php',
                                {method: $("#method").val(),
                                codigo: $("#codigo").val(),
                                dscReceita: $("#dscReceita").val(),
                                dtaReceita: $("#dtaReceita").val(),
                                vlrReceita: $("#vlrReceita").val(),
                                codConta: $("#codConta").val(),
                                tpoReceita: $("#tpoReceita").val()}, function(data){
                                data = eval('('+data+')');
                                if (data==1){
                                    $( "#dialogInformacao" ).html('Receita salva com sucesso!');
                                    $( "#dialogInformacao" ).dialog( "open" );
                                }else{
                                    $( "#dialogInformacao" ).html('Erro ao salvar Receita!');
                                    $( "#dialogInformacao" ).dialog( "open" );
                                }
                            });
                        }
                    }

            ],
            close: function(ev, ui) { window.location='../MenuPrincipal.php'; }
    });
});

</script>

    </head>
    <body>
        <form name="ListagemReceitas" method="post" action="../../Controller/Receitas/ReceitasController.php">
            <div id="Listagem">
                <?include_once("TabelaSaldoContasBancarias.php");?>
            </div>
        </form>
    </body>
</html>