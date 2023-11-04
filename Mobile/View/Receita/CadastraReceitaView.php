<?php
session_start();
include_once '../../constantes.php';
?>
<html>

<head>
    <title>SORC</title>

    <?php include_once('../../imports.php'); ?>
    <script src="<?= ALIAS; ?>Mobile/View/Receita/js/CadastraReceitaView.js?random=<?php echo time(); ?>"></script>
</head>

<body>
    <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N" class="persist">
    <input type="hidden" id="codReceita" value="<?php echo isset($_GET['codReceita']) ? $_GET['codReceita'] : ''; ?>" class="persist">

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
                    <button id="btnListarReceitas" class="btn btn-outline-secondary text-white border-white">
                        <i class="far fa-list-alt text-white"></i>
                        <b>Receitas</b>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-12 text-center">
                    <h4 class="text-dark">
                        Cadastro de Receita
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="dscReceita" class="mb-0 title">Descrição da Receita *</label>
                    <input type="text" id="dscReceita" name="dscReceita" autocomplete="off" class='persist form-control'>
                </div>
                <div class="col-12">
                    <label for="dtaReceita" class="mb-0 title">Data Vencimento *</label>
                    <input type="date" id="dtaReceita" autocomplete="off" name="dtaReceita" class='persist form-control'>
                </div>
                <div class="col-12">
                    <label for="vlrReceita" class="mb-0 title">Valor *</label>
                    <input autocomplete="off" type="text" id="vlrReceita" name="vlrReceita" class="persist input form-control">
                </div>
                <div class="col-12">
                    <div id="tdcodConta"></div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="btn-block">
                <input type="button" id="btnSalvar" value="Salvar" class="btn btn-success btn-user btn-block">
            </div>
        </div>
    </div>
</body>

</html>
<style>
    .title {
        font-size: 18px;
    }
</style>