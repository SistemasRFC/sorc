<html>
<head>
    <title>SORC - Receitas</title>
    <?php include_once('../../imports.php'); ?>
    <script src="<?=ALIAS;?>Mobile/View/Receita/js/ReceitaView.js?random=<?php echo time(); ?>"></script>
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
                        <button id="btnNovaReceita" class="btn btn-outline-secondary text-white border-white">
                            <i class="far fa-list-alt text-white"></i>
                            <b>Nova Receita</b>
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-12 text-center">
                        <h4 class="text-dark">
                            Receitas
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
                <div class="row">
                    <div class="col-12 p-0 text-center">
                        <div id="listaReceitas"></div>
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