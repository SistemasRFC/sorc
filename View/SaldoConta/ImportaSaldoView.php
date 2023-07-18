<html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <script language="JavaScript" type="text/JavaScript"></script>
    <script src="../../Resources/JavaScript.js"></script>
    <link href="../../Resources/css/jquery-ui-1.10.0.custom.css" rel="stylesheet">
    <script src="../../Resources/js/jquery-1.9.0.js"></script>
    <script src="../../Resources/js/jquery-ui-1.10.0.custom.js"></script>
    <script src="../../Resources/js/svJavaScript.js"></script>
    <script src="js/ImportaSaldoView.js"></script>
    <link href="../../Resources/css/newStyle.css" rel="stylesheet">
    </head>
    <body>
        <div id="CadastroForm">
        <form name="ImportaDespesasForm" method="post">
            <input type="hidden" name="method" id="method">
        <table width="100%">
            <tr>
                <td>
                    <table>
                        <tr>
                            <td>Ano
                                <select name="nroAnoReferencia" id="nroAnoReferencia">
                                <?$result_receitas = unserialize(urldecode($_POST['ListaAnos']));
                                $nroAnoReferencia = unserialize(urldecode($_POST['nroAnoReferencia']));
                                for($i=0;$i<count($result_receitas);$i++){
                                    if ($nroAnoReferencia==$result_receitas[$i]['NRO_ANO_REFERENCIA']){
                                        echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                                    }else{
                                        echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                                    }
                                }
                                ?>
                                </select>
                            </td>
                            <td>Mês
                                <select name="nroMesReferencia" id="nroMesReferencia">
                                <?$result_receitas = unserialize(urldecode($_POST['ListaMeses']));
                                $nroMesReferencia = unserialize(urldecode($_POST['nroMesReferencia']));
                                for($i=0;$i<count($result_receitas);$i++){
                                    if ($nroMesReferencia==$result_receitas[$i]['NRO_MES_REFERENCIA']){
                                        echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                                    }else{
                                        echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                                    }
                                }
                                ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        </form>
        </div>
        <div id="dialogInformacao">
        </div>
    </body>
</html>