<?php
    session_start();
    
    session_unset();
    include_once 'Mobile/constantes.php';
?>
<html>
    <head>
        <title>SORC</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=IBM850; ISO-8859-1">
        <!-- jquery -->
        <script src="../..<?=ALIAS;?>Resources/constantes.js?random=<?php echo time(); ?>"></script>
        <script src="Resources/bootstrap-admin/vendor/jquery/jquery.min.js"></script>
        <script src="Resources/bootstrap-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
        <!-- JS -->
        <script src="Resources/bootstrap-admin/js/sb-admin-2.min.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="Resources/bootstrap-admin/css/sb-admin-2.min.css"></link>
        <!-- bootstrap -->
        <script src="Resources/bootstrap-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="Resources/bootstrap-admin/vendor/bootstrap/js/bootstrap.min.js"></script>
        <!-- fontawesome-free -->
        <link href="Resources/bootstrap-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
        <!-- css -->
        <link href="Resources/bootstrap-admin/css/style.css" rel="stylesheet" type="text/css">

        <!-- Antiga Index -->
        <script src="Mobile/View/MenuPrincipal/js/FuncoesGerais.js?random=<?php echo time(); ?>"></script>
        <script src="Resources/swal/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="Resources/swal/dist/sweetalert.css"> 

        <script src="indexMobile.js"></script>
    </head>
    <body>
        <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N" class="persist">
        <div class="container">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-5" style="padding-top: 6rem">
                            <h1 class="text-center text-persian-dark">SORC</h1>
                            <h2 class="text-center text-persian-light">Sistema SORC</h2>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-5 p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-800 mb-4">LOGIN</h1>
                            </div>
                            <form class="user">
                                <div class="form-group">
                                    <label for="nmeUsuario" class="mb-0">Usuário</label>
                                    <input type="text" id="nmeUsuario" name="nmeUsuario" autocomplete="off" class='login input persist form-control form-control-user' placeholder="Login">
                                </div>
                                <div class="form-group">
                                    <label for="txtSenha" class="mb-0">Senha</label>
                                    <input type="password" id="txtSenha" name="txtSenha" class='login persist input form-control form-control-user' placeholder="Senha">
                                </div>
                                <input type="button" id="btnLogin" value="Entrar" class="btn btn-primary btn-user btn-block">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="RecuperarSenha.php">Esqueci a senha</a>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>
<style>
    .input{
        font-size: 60px;
    }
</style>