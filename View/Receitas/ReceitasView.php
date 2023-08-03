<html>
<head>
    <title>SORC - Receitas</title>
    <?php include_once('../../Shared/Imports.php'); ?>

    <script src="js/ReceitasView.js?rdm=<?php echo time(); ?>"></script>
</head>

<body id="page-top">
    <content>
        <navegacao-component></navegacao-component>
        <header-component></header-component>

        <div id="wrapper">
            <div id="content-wrapper" class="d-flex flex-column">
                <div id="content">
                    <input type="hidden" id="codReceita" name="codReceita" value="0" class="persist">
                    <input type="hidden" id="codReceitasImportacao" />
                    <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-12 col-md-12 mx-0 px-0">
                            <div class="card mt-2">
                                <div class="card-body">
                                    <div class="row d-flex align-items-center">
                                        <div class="col-2 pr-0">
                                            <label class="mb-0">Ano: </label>
                                            <div id="tdanoFiltro"></div>
                                        </div>
                                        <div class="col-2 pr-0">
                                            <label class="mb-0">Mês: </label>
                                            <div id="tdmesFiltro"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><div class="row">
                            <div class="col-xl-12 col-md-12 mx-0 px-0">
                                <div class="card mt-2">
                                    <div class="card-header d-flex flex-row align-items-center justify-content-between">
                                        <h5 class="m-0 text-white">RECEITAS</h5>
                                        <div>
                                            <div class="text-white"><b>Valor Total: </b><br><span id='vlrTotal'>R$ 0,00</span></div>
                                        </div> 
                                        <div>
                                            <div class="text-white"><b>Valor Selecionado: </b><br><span id='vlrSelecionado'>R$ 0,00</span></div>
                                        </div> 
                                        <div>
                                            <button id="btnImportar" class="btn btn-outline-secondary text-white border-white" data-toggle="modal" data-target="#importarReceita">
                                                <i class="fas fa-file-export text-white"></i>
                                                Importar 
                                            </button>
                                            <button id="btnExcel" class="btn btn-outline-secondary text-white border-white">
                                                <i class="fas fa-file-excel text-white"></i>
                                                Gerar Excel
                                            </button>
                                            <button id="btnNovo" class="btn btn-outline-secondary text-white border-white" data-toggle="modal" data-target="#cadastroReceita">
                                                <i class="fas fa-plus text-white"></i>
                                                Nova Receita
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="listaReceitas"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <a class="scroll-to-top rounded pt-1" href="#page-top">
            <i class="fas fa-angle-up fa-2x"></i>
        </a>
    </content>
</body>

<?php include_once("CadReceitasView.php");?>
<?php include_once("CadImportarReceitaView.php");?>

</html>