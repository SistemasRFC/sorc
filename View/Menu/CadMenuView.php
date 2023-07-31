<script src="../../View/Menu/js/CadMenuView.js?rdm=<?php echo time(); ?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary text-white">
			<h5 class="modal-title" id="cadastroMenuTitle"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span class="text-white" aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<input type="hidden" id="codMenuW" name="codMenuW" value="0" class="persist">
			<!-- <input type="hidden" id="dscCaminhoImagem" name="dscCaminhoImagem" class="persist"> -->
			<div class="container">
				<div class="row">
					<div class="form-group col-10">
						<label for="dscMenuW" class="mb-0">Descrição</label>
						<input type="text" id="dscMenuW" name="dscMenuW" class='persist input form-control'>
					</div>
				</div>
				<div class="row">
					<div class=" col-12">
						<label for="controller" class="mb-0">Controller</label>
						<div class="input-group">
							<input type="text" id="nmeController" name="nmeController" class='persist input form-control'>
							<div class="input-group-append">
								<button class="btn btn-secondary" id="btnController" data-toggle="modal" data-target="#divListaControllersModalView">
									Listar Controllers
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-12">
						<label for="nmeMethod" class="mb-0">Método</label>
						<div class="input-group">
							<input type="text" id="nmeMethod" name="nmeMethod" class='persist input form-control'>
							<div class="input-group-append">
								<button class="btn btn-secondary" id="btnMetodo" data-toggle="modal" data-target="#divListaMetodosModalView">
									Listar Métodos
								</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-2">
					<div class="col-6">
						<label for="codMenuPaiW" class="mb-0">Menu pai</label>
						<div id="tdcodMenuPaiW"></div>
					</div>
					<div class="col-6">
						<label for="dscCaminhoImagem" class="mb-0">Icone de Atalho</label>
						<input type="text" id="dscCaminhoImagem" name="dscCaminhoImagem" class='persist input form-control'>

						<!-- <form name="menuForm" enctype="multpart/form-data" id="cadastroMenuForm" method="post" action="../../Controller/Menu/MenuController.php">
							<label for="imagem" class="mb-0">Selecione o arquivo:</label>
							<input type="file" name="arquivo" id="imagem" size="45" />
							<br />
							<progress value="0" max="100"></progress>
							<span id="porcentagem">0%</span>
							<br />
						</form> -->
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="indAtalho" id="indAtalho" class="custom-control-input persist" />
							<label class="custom-control-label" for="indAtalho">Atalho</label>
						</div>
					</div>
					<div class="col-4">
						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="indMenuAtivoW" id="indMenuAtivoW" class="custom-control-input persist" />
							<label class="custom-control-label" for="indMenuAtivoW">Ativo</label>
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

<?php include "ListaControllersModalView.php"; ?>
<?php include "ListaMetodosModalView.php"; ?>