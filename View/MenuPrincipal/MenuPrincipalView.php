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
                <div class="container-fluid">
                    <div class="row mt-2">
                        <div class="col-xl-12 col-md-12 mb-4">
                            <div class="card border-left-secondary">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class=" font-weight-bold text-secondary mb-1">ATALHOS</div>
                                            <div id="divAtalhos"></div>
                                        </div>
                                        <!-- <div class="col-auto">
                                            <i class="fas fa-project-diagram fa-3x text-gray-400"></i>
                                        </div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-white">RECEITA x DESPESA</h6>
                                </div>
                                <div class="card-body">
                                    <!-- <div> -->
                                        <canvas id="graficoResumo" width="1100" height="350"></canvas>
                                    <!-- </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="scroll-to-top rounded pt-1" href="#page-top">
            <i class="fas fa-angle-up fa-2x"></i>
        </a>

    </content>
</body>

</html>