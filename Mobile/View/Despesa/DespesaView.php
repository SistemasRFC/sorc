<?php
    session_start();
    include_once '../../constantes.php';
?>
<html>
    <head>
        <title>SORC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=IBM850; ISO-8859-1">
        <!-- jquery -->
        <script src="<?=ALIAS;?>Resources/constantes.js?random=<?php echo time(); ?>"></script>
        <script src="<?=ALIAS;?>Resources/bootstrap-admin/vendor/jquery/jquery.min.js"></script>
        <script src="<?=ALIAS;?>Resources/bootstrap-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- JS -->
        <script src="<?=ALIAS;?>Resources/bootstrap-admin/js/sb-admin-2.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="<?=ALIAS;?>Resources/bootstrap-admin/css/sb-admin-2.min.css"></link>
        <!-- bootstrap -->
        <script src="<?=ALIAS;?>Resources/bootstrap-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?=ALIAS;?>Resources/bootstrap-admin/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome-free -->
        <link href="<?=ALIAS;?>Resources/bootstrap-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- css -->
        <link href="<?=ALIAS;?>Resources/bootstrap-admin/css/style.css" rel="stylesheet" type="text/css">

        <!-- Antiga Index -->
        <script src="<?=ALIAS;?>Mobile/View/MenuPrincipal/js/FuncoesGerais.js?random=<?php echo time(); ?>"></script>
        <script src="<?=ALIAS;?>Resources/swal/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="<?=ALIAS;?>Resources/swal/dist/sweetalert.css"> 
        <script src="<?=ALIAS;?>Mobile/View/Despesa/js/DespesaView.js?random=<?php echo time(); ?>"></script>
    </head>
    
    
    <body>
        <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N" class="persist">
        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-12 pt-2 pb-2" style="background-color: #ddd;">
                            <button id="btnVoltar" class="btn btn-link btn-user text-left col-5" style="color: black">
                                <i class="fa fa-arrow-alt-circle-left title"> Voltar</i>
                            </button>
                            <button id="btnNovaDespesa" class="btn btn-link btn-user text-right col-6" style="color: black">
                                <i class="fa fa-plus-circle title"> Nova</i>
                            </button>
                        </div>
                        <div class="col-12 text-center pt-1">
                            <label class="h4 text-gray-800 ml-1 text-persian-light">
                                Despesas
                            </label>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-12">
                            <form class="filtroPesquisa">
                                <div class="form-group">
                                    <div id="tdnroMesReferencia"></div>
                                    <div id="tdnroAnoReferencia"></div>
                                </div>
                                <hr>
                                <input type="button" id="btnPesquisar" value="Pesquisar" class="btn btn-primary btn-user btn-block">
                                <hr>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-9 col-md-9 col-lg-9 p-4">
                            <div id="listaDespesas"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
<style>
    .title{
        font-size: 18px;
    }
</style>