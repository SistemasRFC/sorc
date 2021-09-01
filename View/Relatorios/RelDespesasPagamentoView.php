<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <script language="JavaScript" src="js/RelDespesasPagamentoView.js"></script>
    </head>
    <body> 
        <table width="100%">
        <tr>
            <td>
                <table>
                    <tr>
                        <td>Ano</td>
                        <td>
                            <div id="comboNroAnoReferencia"></div>
                        </td>
                        <td>Mês</td>
                        <td>
                            <div id="comboNroMesReferencia"></div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <input type="button" id="btnGrafico" value="Carregar Despesas">
                        </td>                        
                    </tr>
                </table>
                
            </td>
        </tr>
        <tr>
            <td>
                <table width="100%">
                    <tr>
                        <td>
                            <div id="divResumo" style="display:block;border: 0px solid #a4bed4;overflow:scroll;width:50%;height:420px;">
                                
                            </div>  
                        </td>                        
                    </tr>
                </table>
                
            </td>
        </tr>
        </table>        
                      
    </body>
</html>