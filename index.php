<?php
    ob_start();
    session_start();
    session_unset();
?>
<html>
<head>
    <title>SORC</title>
    <meta charset="UTF-8">
    <!-- <link rel="shortcut icon" type="image/x-icon" href="/sorc/favicon.ico"> -->
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
    <script src="index.js?rdm=<?php echo time();?>"></script>
</head>

<body style="background-color: #222">

    <div class="container">

      <div class="card my-5" style="margin-top: 4rem !important;">
          <div class="card-body">
              <div class="row">
                  <div class="col-lg-6" style="padding-top: 7rem">
                      <h1 align="center" class="color-primary">SORC</h1>
                      <h2 align="center" class="color-secondary">Sistema de finanças</h2>
                  </div>
                  <div class="col-lg-6 p-5 bl-1">
                      <div align="center">
                          <h1 class="h4 text-gray-800 mb-4 color-primary">LOGIN</h1>
                      </div>
                      <form class="px-5">
                          <div class="form-group">
                              <label for="nmeUsuario" class="mb-0">Usuário</label>
                              <input type="text" id="nmeUsuario" name="nmeUsuario" class='persist input form-control' placeholder="Login">
                          </div>
                          <div class="form-group">
                              <label for="txtSenhaW" class="mb-0">Senha</label>
                              <input type="password" id="txtSenhaW" name="txtSenhaW" class='persist input form-control' placeholder="Senha">
                          </div>
                          <input type="button" id="btnLogar" value="Entrar" class="btn btn-primary btn-user btn-block">
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </body>
</html>
