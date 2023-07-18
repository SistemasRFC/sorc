<html>
    <head>
        <title>SORC - Alterar Senha</title>
        <meta charset="UTF-8">
        <!-- JS -->
        <script src="/sorc/Resources/bootstrap-admin/vendor/jquery/jquery.min.js"></script>
        <script src="/sorc/Resources/bootstrap-admin/vendor/jquery-easing/jquery.easing.min.js"></script>
        <script src="/sorc/Resources/bootstrap-admin/js/sb-admin-2.min.js"></script>
        <script src="/sorc/Resources/swal/sweetalert.min.js"></script>
        <script src="/sorc/Resources/swal/dist/sweetalert.min.js"></script>
        <script src="/sorc/Resources/jquery/jquery-3.6.0.min.js"></script>
        <script src="/sorc/Shared/FuncoesGerais.js"></script>
        <!-- CSS -->
        <link rel="stylesheet" href="/sorc/Resources/bootstrap-admin/css/sb-admin-2.css">
        </link>
        <link href="/sorc/Resources/bootstrap-admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" type="text/css" href="/sorc/Resources/swal/dist/sweetalert.css">
        <link href="/sorc/Resources/bootstrap-admin/css/theme-material.css" rel="stylesheet" type="text/css">
        <link href="/sorc/Resources/bootstrap-admin/css/style.css" rel="stylesheet" type="text/css">
        <script src="js/AlterarSenhaView.js?rdm=<?php echo time();?>"></script>
    </head>
    <body>
        <div class="card card-login">
            <div class="card-header bg-primary" align="center">            
                <h1 class="text-white">SORC</h1> 
                <h5 class="text-white">ALTERAR SENHA</h5>
            </div>
            <div class="card-body">
                <label class="mb-0" for="txtSenhaW">Senha Atual</label>
                <input type="password" id="txtSenhaW" class="form-control mb-1 persist">
                <label class="mb-0" for="txtNova">Nova Senha</label>
                <input type="password" id="txtNova" class="form-control mb-1 persist">
                <label class="mb-0" for="txtConfirmacao">Confirmar Nova Senha</label>
                <input type="password" id="txtConfirmacao" class="form-control persist">
            </div>

            <div class="card-footer" align="center">
                <button class="btn btn-primary btn-block" id="btnLogin">Enviar</button>
            </div>
        </div>
    </body>
</html>

