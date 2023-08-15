<script src="js/CadContasBancariasView.js?rdm=<?php echo time(); ?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroContaBancaria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary text-white">
				<h5 class="modal-title" id="cadastroContaBancariaTitle"></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="text-white" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<input type="hidden" id="codConta" name="codConta" value="0" class="persist">
				<div class="container">
					<div class="row">
						<div class="col-6">
							<label for="nmeBanco" class="mb-0">Banco</label>
							<input type="text" id="nmeBanco" name="nmeBanco" class='persist input form-control'>
						</div>
					</div>
					<div class="row">
						<div class="col-4">
							<label for="nroAgencia" class="mb-0">Agência</label>
							<input type="text" id="nroAgencia" name="nroAgencia" class='persist input form-control'>
						</div>
						<div class="col-4">
							<label for="nroConta" class="mb-0">Conta</label>
							<input type="text" id="nroConta" name="nroConta" class='persist input form-control'>
						</div>
						<div class="col-3">
							<div class="custom-control custom-checkbox mt-4">
								<input type="checkbox" name="indIsCartao" id="indIsCartao" class="custom-control-input persist" />
								<label class="custom-control-label" for="indIsCartao">Cartão</label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-3">
							<div class="custom-control custom-checkbox mt-4">
								<input type="checkbox" name="indAtiva" id="indAtiva" class="custom-control-input persist" />
								<label class="custom-control-label" for="indAtiva">Ativo</label>
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
</div>