<html>
<head>
    <title>SORC - Relatório Porcentagem Despesas x Receita</title>
    <?php include_once('../../Shared/Imports.php'); ?>

    <script src="js/RelatorioPorcentagemDespesasPorReceitaView.js?rdm=<?php echo time(); ?>"></script>
</head>

<body id="page-top">
    <content>
        <navegacao-component></navegacao-component>
        <header-component></header-component>

        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12">
                                <div class="card shadow mb-4 mt-1">
                                    <div class="card-header pb-1 d-flex flex-row align-items-center">
                                        <h5 class="m-0 font-weight-bold text-white mr-auto">Porcentagem de Gastos por Receita</h5>
                                        <div class=" mr-1">
                                            <label for="anoFiltro" class='mb-0 text-white'>Ano</label>
                                            <div id="tdanoFiltro"></div>
                                        </div>
                                        <div class=" mr-1">
                                            <label for="mesFiltro" class='mb-0 text-white'>Mês</label>
                                            <div id="tdmesFiltro"></div>
                                        </div>
                                        <div>
                                            <label for="statusFiltro" class='mb-0 text-white'>Status</label>
                                            <div id="tdstatusFiltro"></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="graficoPorcentagemGastosReceita" width="1100" height="420"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </content>
</body>
</html>



<? // include_once "../../View/MenuPrincipal/Cabecalho.php";?>
<!-- <html>
    <head>
        <title>Controle de Receitas</title>
    <meta http-equiv="Content-Type" content="text/HTML; charset=utf-8">
    <script language="JavaScript" src="js/RelatorioPorcentagemDespesasPorReceitaView.js"></script>
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
                        <td>
                        Status
                        </td>
                        <td>
                            <div id="comboIndStatus"></div>
                            <select name="indStatus" id="indStatus" style="display:none">
                                <option value="-1">Todos</option>
                                <option value="N">Em Aberto</option>
                                <option value="S">Despesa Paga</option>
                            </select>
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
                            <div id="divResumo" style="display:block;border: 0px solid #a4bed4;overflow:scroll;width:100%;height:500px;">
                                <div id='host' style="margin: 0 auto; width: 100%; height: 400px;">
                                     <div id='jqxChart' style="width: 100%; height: 400px; position: relative; left: 0px; top: 0px;">
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
</html> -->