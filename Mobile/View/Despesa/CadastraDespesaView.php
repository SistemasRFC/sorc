<?php
session_start();
include_once '../../constantes.php';
?>
<html>

<head>
    <title>SORC</title>

    <?php include_once('../../imports.php'); ?>
    <script src="<?= ALIAS; ?>Mobile/View/Despesa/js/CadastraDespesaView.js?random=<?php echo time(); ?>"></script>
</head>

<body>
    <input type="hidden" id="verificaPermissao" name="verificaPermissao" value="N" class="persist">
    <input type="hidden" id="codDespesa" value="<?php echo isset($_GET['codDespesa']) ? $_GET['codDespesa'] : ''; ?>" class="persist">

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
                    <button id="btnListarDespesas" class="btn btn-outline-secondary text-white border-white">
                        <i class="far fa-list-alt text-white"></i>
                        <b>Despesas</b>
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-1">
                <div class="col-12 text-center">
                    <h4 class="text-dark">
                        Cadastro de Despesa
                    </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="dscDespesa" class="mb-0 title">Descrição da Despesa *</label>
                    <input type="text" id="dscDespesa" name="dscDespesa" autocomplete="off" class='persist form-control'>

                    <label for="dtaLancDespesa" class="mb-0 title">Data Lançamento *</label>
                    <input type="date" id="dtaLancDespesa" autocomplete="off" name="dtaLancDespesa" class='persist form-control'>

                    <label for="dtaDespesa" class="mb-0 title">Data Vencimento *</label>
                    <input type="date" id="dtaDespesa" autocomplete="off" name="dtaDespesa" class='persist form-control'>

                    <label for="vlrDespesa" class="mb-0 title">Valor *</label>
                    <input autocomplete="off" type="text" id="vlrDespesa" name="vlrDespesa" class="persist input form-control">

                    <label for="qtdParcelas" class="mb-0 title">Qtd Parcelas *</label>
                    <input autocomplete="off" type="number" min="1" max="10000" step="1" pattern="^\d*(\.\d{0,0})?$" id="qtdParcelas" name="qtdParcelas" value="1" class='persist form-control'>

                    <label for="nroParcelaAtual" class="mb-0 title">Parcela Atual *</label>
                    <input autocomplete="off" type="number" min="1" max="10000" step="1" pattern="^\d*(\.\d{0,0})?$" id="nroParcelaAtual" name="nroParcelaAtual" value="1" class='persist form-control'>

                    <label class="mb-0 title">Tipo de Despesa * <small id="tetoTpoDespesa"></small></label>
                    <div id="tdtpoDespesa"></div>
                    <small id="infoTpoDespesa"></small>

                    <div id="tdcodConta"></div>
                    <div id="tdcodUsuarioDespesa"></div>

                    <div class="custom-control custom-checkbox mt-3 mb-1">
                        <input type="checkbox" name="indDespesaPaga" id="indDespesaPaga" class="custom-control-input persist" />
                        <label class="custom-control-label title" for="indDespesaPaga">Despesa Paga?</label>
                    </div>

                    <div id="divdtaPagamento">
                        <label for="dtaPagamento" class="mb-0 title">Data Pagamento</label>
                        <input type="date" id="dtaPagamento" autocomplete="off" name="dtaPagamento" class='persist form-control'>
                    </div>
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