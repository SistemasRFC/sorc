<html>

<head>
    <title>SORC - Permissões</title>
    <?php include_once '../../Shared/Imports.php'; ?>

    <script src="js/PermissaoView.js?rdm=<?php echo time(); ?>"></script>
</head>
<style>
    #checkboxes {
        padding: 0.375rem;
        line-height: 1.5;
        border: 1px solid #d1d3e2;
        border-radius: 0.2rem;
    }
</style>

<body id="page-top">
    <div>
        <content>
            <navegacao-component></navegacao-component>
            <header-component></header-component>

            <div id="wrapper">
                <div id="content-wrapper" class="d-flex flex-column">
                    <div id="content">

                        <div class="container-fluid">
                            <div class="d-flex align-items-center mb-3">
                                <h1 class="h3">Restrito</h1>
                            </div>

                            <div class="row">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card mb-4">
                                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                            <h5 class="m-0 text-white">Permissões</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="row mb-2">
                                                <div class="col-xl-4 col-lg-6">
                                                    <label for="codPerfilW" class="mb-0">Perfil</label>
                                                    <div id="tdcodPerfilW"></div>
                                                </div>
                                                <div class="custom-control custom-checkbox mt-4">
                                                    <input type="checkbox" name="chkTodos" id="chkTodos" class="custom-control-input persist" onClick="marcarTodos()" />
                                                    <label class="custom-control-label" for="chkTodos">Marcar Todos</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12">
                                                    <div id="checkboxes">
                                                        Selecione um perfil acima.
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer d-flex align-items-center">
                                            <button class="btn btn-success btn-block" id="btnSalvar">
                                                Salvar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </content>
    </div>
</body>
