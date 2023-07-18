<script src="js/CadClienteFinalView.js?rdm=<?php echo time(); ?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary text-white">
			<h5 class="modal-title" id="cadastroClienteTitle"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span class="text-white" aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<input type="hidden" id="codClienteFinal" name="codClienteFinal" value="0" class="persist">
            <div class="container">
				<div class="row">
					<div class="col-6">
						<label for="dscClienteFinal" class="mb-0">Descrição</label>
						<input type="text" id="dscClienteFinal" name="dscClienteFinal" class='persist input form-control'>
					</div>
					<div class="col-2">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" name="indAtivo" id="indAtivo" class="custom-control-input persist" />
                            <label class="custom-control-label" for="indAtivo">Ativo</label>
                        </div>
					</div>
				</div>
            </div>
        </div>
		<div class="modal-footer">
			<button type="button" class="btn btn-success btn-block" id="btnSalvar">Salvar</button>
		</div>
    </div>
</div>