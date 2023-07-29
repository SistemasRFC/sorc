<html>
<head>
    <title>SORC - Despesas</title>
    <?php include_once('../../Shared/Imports.php'); ?>

    <script src="js/DespesasView.js?rdm=<?php echo time(); ?>"></script>
</head>

<body id="page-top">
    <content>
        <navegacao-component></navegacao-component>
        <header-component></header-component>

        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <input type="hidden" id="codDespesa" name="codDespesa" value="0" class="persist">
                    <input type="hidden" id="codDespesasImportacao" />
                    <div class="container-fluid">
                        <!-- <div class="d-sm-flex align-items-center justify-content-between">
                            <h3 class="my-2 text-gray-800">Movimentações</h3>
                        </div> -->

                        <div class="row">
                            <div class="col-xl-12 col-md-12 mx-0 px-0">
                                <div class="card mt-2">
                                    <div class="card-body">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-1 pr-0">
                                                <label class="mb-0">Ano: </label>
                                                <div id="tdanoFiltro"></div>
                                            </div>
                                            <div class="col-11 px-0">
                                                <div class="row m-0">
                                                    <div class="col-2 pr-0">
                                                        <label class="mb-0">Mês: </label>
                                                        <div id="tdmesFiltro"></div>
                                                    </div>
                                                    <div class="col-2 pr-0">
                                                        <label class="mb-0">Tipo de despesa: </label>
                                                        <div id="tdtpoDespesaFiltro"></div>
                                                    </div>
                                                    <div class="col-2 pr-0">
                                                        <label class="mb-0">Status: </label>
                                                        <div id="tdstatusFiltro"></div>
                                                    </div>
                                                    <div class="col-4 pr-0">
                                                        <label class="mb-0">Conta: </label>
                                                        <div id="tdcontaFiltro"></div>
                                                    </div>
                                                    <div class="col-2 pr-0">
                                                        <label class="mb-0">Responsável: </label>
                                                        <div id="tdresponsavelFiltro"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xl-12 col-md-12 mx-0 px-0">
                                <div class="card mt-2">
                                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="m-0 text-white">Despesas</h5>
                                        <div>
                                            <div class="text-white"><b>Valor Total: </b><br><span id='vlrTotal'>R$ 0,00</span></div>
                                        </div> 
                                        <div>
                                            <div class="text-white"><b>Valor Selecionado: </b><br><span id='vlrSelecionado'>R$ 0,00</span></div>
                                        </div> 
                                        <div>
                                            <button id="btnImportar" class="btn btn-outline-secondary text-white border-white" data-toggle="modal" data-target="#importarDespesa">
                                                <i class="fas fa-file-export text-white"></i>
                                                Importar 
                                            </button>
                                            <button id="btnGrafico" class="btn btn-outline-secondary text-white border-white" data-toggle="modal" data-target="#viewGrafico">
                                                <i class="fas fa-chart-column text-white"></i>
                                                Gráfico
                                            </button>
                                            <button id="btnNovo" class="btn btn-outline-secondary text-white border-white" data-toggle="modal" data-target="#cadastroDespesa">
                                                <i class="fas fa-plus text-white"></i>
                                                Nova Despesa
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <!-- <div class="row mb-1">
                                            <div class="col-3"><b>Valor Total: </b><span id='vlrTotal'>R$ 0,00</span></div>
                                            <div class="col-3"><b>Valor Selecionado: </b><span id='vlrSelecionado'>R$ 0,00</span></div>
                                        </div> -->
                                        <div id="listaDespesas"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>
    </content>
</body>

<?php include_once("CadDespesasView.php");?>
<?php include_once("CadImportarDespesaView.php");?>
<?php include_once("ModalGraficoView.php");?>
</html>
