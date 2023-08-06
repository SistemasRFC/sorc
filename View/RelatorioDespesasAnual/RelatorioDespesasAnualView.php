<html>
<head>
    <title>SORC - Relatório Resumo Despesas Anual</title>
    <?php include_once('../../Shared/Imports.php'); ?>

    <script src="js/RelatorioDespesasAnualView.js?rdm=<?php echo time(); ?>"></script>
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
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                        <h6 class="m-0 font-weight-bold text-white">Resumo Despesas Anual</h6>
                                        <div id="tdanoFiltro"></div>
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