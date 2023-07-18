<html>
<head>
    <title>SORC - Perfis</title>
    <?php include_once('../../Shared/Imports.php'); ?>

    <script src="js/PerfilView.js?rdm=<?php echo time(); ?>"></script>
</head>

<body id="page-top">
    <content>
        <navegacao-component></navegacao-component>
        <header-component></header-component>

        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <div class="container-fluid">
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="my-2 text-gray-800">Restrito</h3>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-md-12 mx-0 px-0">
                                <div class="card mt-2">
                                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="m-0 text-white">Perfis</h5> 
                                        <div class="btn-border">
                                            <button id="btnNovo" class="btn btn-link d-lg-inline text-white" data-toggle="modal" data-target="#cadastroPerfil">
                                                <i class="fas fa-plus text-white"></i>
                                                Novo Perfil
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="listaPerfil"></div>
                                    </div>
                                </div>
                            </div>
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

<?php include_once "CadPerfilView.php";?>
</html>
