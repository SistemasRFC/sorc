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
                                        <h5 class="m-0 font-weight-bold text-white mr-auto">Gastos por tipos de despesa</h5>
                                        <div class=" mr-1">
                                            <label for="dtaInicio" class='mb-0 text-white'>Data Inicial</label>
                                            <input type="date" id="dtaInicio"/>
                                        </div>
                                        <div class=" mr-1">
                                            <label for="dtaFim" class='mb-0 text-white'>Data Final</label>
                                            <input type="date" id="dtaFim"/>
                                        </div>
                                        <div>
                                            <label for="statusFiltro" class='mb-0 text-white'>Status</label>
                                            <div id="tdstatusFiltro"></div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="grafico"></div>
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