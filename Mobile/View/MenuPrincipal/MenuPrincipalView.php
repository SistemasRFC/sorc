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
        <!-- <script src="<?=ALIAS;?>Resources/constantes.js?random=<?php echo time(); ?>"></script> -->
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

    </head>
    <body>
        <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N" class="persist">
        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-header bg-white p-0">
                    <h3 class="text-center mt-3">SORC</h3>
                </div>
                <div class="card-body">
                    <div class="col-12 my-2">
                        <input type="button" 
                                id="btnListarDespesas" 
                                value="Consulta Despesas" 
                                class="btn btn-primary btn-user btn-block"
                                onClick="javascript:window.location.href='../Despesa/DespesaView.php'">
                    </div>
                    <div class="col-12 my-2">
                        <input type="button" 
                                id="btnCadastroReceita" 
                                value="Cadastro Receita" 
                                class="btn btn-success btn-user btn-block"
                                onClick="javascript:window.location.href='../Receita/CadastraReceitaView.php'">
                    </div>
                    <div class="col-12 my-2">
                        <input type="button" 
                                id="btnCadastroDespesa" 
                                value="Cadastro Despesa" 
                                class="btn btn-danger btn-user btn-block"
                                onClick="javascript:window.location.href='../Despesa/CadastraDespesaView.php'">
                    </div>
                </div>
            </div>

            <div class="card o-hidden border-0 shadow-lg my-4">
                <div class="card-header bg-white p-0">
                    <h4 class="text-center my-1">Gastos</h4>
                </div>
                <div class="card-body">
                    <div id="listaGastos" class="p-1" style="border: 1px solid white;"></div>
                </div>
            </div>

        </div>
    </body>
</html>