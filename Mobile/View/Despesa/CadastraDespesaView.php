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
        <script src="<?=ALIAS;?>Mobile/View/Despesa/js/CadastraDespesaView.js?random=<?php echo time(); ?>"></script>
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
                            <button id="btnListarDespesas" class="btn btn-link btn-user text-right col-6" style="color: black">
                                <i class="fa fa-list-alt title "> Despesas</i>
                            </button>
                        </div>
                        <div class="col-12 text-center pt-1">
                            <label class="h4 text-gray-800 ml-1 text-persian-light">
                                Cadastro de Despesa
                            </label>
                        </div>
                    </div>
                    <div class="row p-1">
                        <div class="col-12">
                            <form class="user">
                                <div class="form-group">
                                    <label for="dscDespesa" class="mb-0 title">Descrição da Despesa</label>
                                    <input type="text" id="dscDespesa" name="dscDespesa" autocomplete="off" class='login input persist form-control form-control-user'>

                                    <label for="dtaLancDespesa" class="mb-0 title">Data lançamento</label>
                                    <input type="date" 
                                           id="dtaLancDespesa" 
                                           autocomplete="off" 
                                           name="dtaLancDespesa" 
                                           class='login persist input form-control form-control-user'>

                                    <label for="dtaDespesa" class="mb-0 title">Data Vencimento</label>
                                    <input type="date" id="dtaDespesa" autocomplete="off" name="dtaDespesa" class='login persist input form-control form-control-user'>

                                    <label for="vlrDespesa" class="mb-0 title">Valor</label>
                                    <input  autocomplete="off" 
                                            type="number" 
                                            min="0.00" 
                                            max="10000.00" 
                                            step="0.01" 
                                            data-number-stepfactor="100"
                                            data-number-to-fixed="2" 
                                            id="vlrDespesa" name="vlrDespesa" 
                                            pattern="^\d*(\.\d{0,2})?$"
                                            class="persist form-control currency form-control-user">

                                    <label for="qtdParcelas" class="mb-0 title">Qtd Parcelas</label>
                                    <input  autocomplete="off" 
                                            type="number" 
                                            min="1" 
                                            max="10000" 
                                            step="1" 
                                            pattern="^\d*(\.\d{0,0})?$"
                                            id="qtdParcelas" 
                                            name="qtdParcelas" 
                                            value="1"
                                            class='login persist input form-control form-control-user'>

                                    <label for="nroParcelaAtual" class="mb-0 title">Parcela Atual</label>
                                    <input  autocomplete="off" 
                                            type="number" 
                                            min="1" 
                                            max="10000" 
                                            step="1" 
                                            pattern="^\d*(\.\d{0,0})?$"
                                            id="nroParcelaAtual" 
                                            name="nroParcelaAtual" 
                                            value="1"
                                            class='login persist input form-control form-control-user'>
                                    <div id="tdcodTipoDespesa"></div>
                                    <div id="tdcodConta"></div>
                                </div>

                                <div class="form-group">
                                    <input type="checkbox" 
                                        id="indDespesaPaga" 
                                        name="indDespesaPaga" 
                                        checked
                                        style="transform: scale(1.5); padding: 15px;"
                                        class="persist ml-1"><span class="title ml-1"> Despesa Paga?</span>
                                </div>
                                <div id="divdtaPagamento">
                                    <label for="dtaPagamento" class="mb-0 title">Data Pagamento</label>
                                    <input type="date" id="dtaPagamento" autocomplete="off" name="dtaPagamento" class='login persist input form-control form-control-user'>
                                </div> 
                                <hr>
                                <input type="button" id="btnSalvar" value="Salvar" class="btn btn-success btn-user btn-block">
                            </form>
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