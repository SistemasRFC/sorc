<script src="js/CadImportarReceitaView.js?<?php echo time(); ?>"></script>
<div class="modal fade bd-example-modal-lg" id="importarReceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="importarReceitaTitle">Importação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <label class="mb-0">Mês para importar</label>
                        <div id="tdmesRefImportacao"></div>
                    </div>
                    <div class="col-6">
                        <label class="mb-0">Ano para importar</label>
                        <div id="tdanoRefImportacao"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-block">
                    <button type="button" class="btn btn-success" id="btnSalvarImportacao">Importar</button>
                </div>
            </div>
        </div>
    </div>
</div>