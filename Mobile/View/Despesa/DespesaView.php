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

        <div class="card o-hidden border-0 shadow-lg mx-2 my-3">
            <div class="card-header px-1 py-2">
                <div class="row d-flex align-items-center">
                    <div class="col-6 p-0">
                        <button id="btnVoltar" class="btn btn-outline-secondary text-white border-white">
                            <i class="far fa-arrow-alt-circle-left text-white"></i>
                            <b>Voltar</b>
                        </button>
                    </div>
                    <div class="col-6 p-0">
                        <button id="btnNovaDespesa" class="btn btn-outline-secondary text-white border-white">
                            <i class="far fa-list-alt text-white"></i>
                            <b>Nova Despesa</b>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-12 text-center">
                        <h4 class="text-dark">
                            Despesas
                        </h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <div id="tdnroMesReferencia"></div>
                            <div id="tdnroAnoReferencia"></div>
                        </div>
                        <hr>
                        <input type="button" id="btnPesquisar" value="Pesquisar" class="btn btn-primary btn-block">
                    </div>
                </div>
                <div class="row pt-4 text-center">
                    <div class="col-4">
                        <small class="mr-auto" style="color: red;">atrasada</small>
                    </div>
                    <div class="col-4">
                        <small class="mr-auto">no prazo</small>
                    </div>
                    <div class="col-4">
                        <small class="ml-auto" style="color: green;">paga</small>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 p-0 text-center">
                        <div id="listaDespesas"></div>
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