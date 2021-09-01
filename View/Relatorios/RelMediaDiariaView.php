<? include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <script language="JavaScript" src="js/FuncoesMediaDiaria.js"></script>
    <script language="JavaScript" src="js/RelMediaDiariaView.js"></script>
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

                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table>
                    <tr>
                        <td>
                            <input type="button" id="btnGrafico" value="Gráfico">
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
                            <div id="divResumo" style="display:block;border: 0px solid #a4bed4;overflow:scroll;width:100%;height:1200px;">
                                <div id='host' style="margin: 0 auto; width: 100%; height: 100%;">
                                     <div id='jqxChart' style="width: 100%; height: 100%; position: relative; left: 0px; top: 0px;">
                                     </div>
                                 </div>
                            </div>  
                        </td>                        
                    </tr>
                </table>
                
            </td>
        </tr>
        </table>        
                      
    </body>
</html>