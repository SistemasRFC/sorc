<?php //include_once "Cabecalho.php";?>
<style>
    /* a:link{border: #000000; text-decoration:none; background-color:#FFFFFF; color:#FF0000;}
    a:visited{border: #000000; text-decoration:none; background-color:#FFFFFF; color:#FF0000;}
    a:hover{border: #000000; text-decoration:none; background-color:#a4bed4; color:#FF0000;}
    a:active{border: #000000; text-decoration:none; background-color:#FFFFFF; color:#FF0000;} */
    img{border:#000000;}
</style>
<html>

<head>
    <title>SORC</title>
    <?php include_once('../../Shared/Imports.php'); ?>

    <script src="../../View/MenuPrincipal/js/MenuPrincipalView.js?rdm=<?php echo time(); ?>"></script>

</head>

<body id="page-top">
    <content>
        <navegacao-component></navegacao-component>
        <header-component></header-component>

        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <form name="menuPrincipal" method="post">
                        <input type="hidden" name="horaInicial">
                        <input type="hidden" name="data">
                        <input type="hidden" name="habilita">
                        <div  class="divDefault">
                            <table width="100%">
                                <tr>
                                    <td width="50%">
                                        <table align="center" width="100%" style=" border: 1px solid #a4bed4;" >
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td style="border: 1px solid #a4bed4;text-align:left;padding-left:6;font-size:13px;background-color:#e0e9f5;color:#000000;">Atalhos</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 1px solid #a4bed4;">
                                                                <div id="divAtalhos" style="display:block;border: 0px solid #a4bed4;overflow:scroll;width:100%;height:500px;">

                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="50%">
                                        <table align="center" width="100%" style=" border: 1px solid #a4bed4;" >
                                            <tr>
                                                <td>
                                                    <table width="100%">
                                                        <tr>
                                                            <td style="border: 1px solid #a4bed4;text-align:left;padding-left:6;font-size:13px;background-color:#e0e9f5;color:#000000;">Resumo</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="border: 1px solid #a4bed4;">
                                                                <div id="divResumo" style="display:block;border: 0px solid #a4bed4;overflow:scroll;width:100%;height:500px;">
                                                                    <div id='host' style="margin: 0 auto; width: 599px; height: 400px;">
                                                                        <div id='jqxChart' style="width: 580px; height: 400px; position: relative; left: 0px;
                                                                            top: 0px;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </form>
                    <div id="dialogDespesa">
                      <div id="windowHeader">
                      </div>
                      <div id="windowContent">
                      </div>
                    </div>    
                </div>
            </div>
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

    </content>
</body>

</html>