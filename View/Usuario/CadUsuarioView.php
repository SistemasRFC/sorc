<script src="js/CadUsuarioView.js?rdm=<?php echo time(); ?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header bg-primary text-white">
			<h5 class="modal-title" id="cadastroUsuarioTitle"></h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span class="text-white" aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
            <input type="hidden" id="codUsuario" name="codUsuario" class="persist">
            <div class="container">
				<div class="row">
                    <div class="col-8">
                        <label for="nmeUsuarioCompleto" class="mb-0">Nome Completo</label>
                        <input type="text" id="nmeUsuarioCompleto" name="nmeUsuarioCompleto" class='persist input form-control'>
                    </div>
                </div>
				<div class="row">
                    <div class="col-6">
                        <label for="nmeUsuario" class="mb-0">Login</label>
                        <input type="text" id="nmeUsuario" name="nmeUsuario" class='persist input form-control'>
                    </div>
                    <div class="col-6">
                        <label for="codPerfilW" class="mb-0">Perfil</label>
                        <div id="tdcodPerfilW"></div>
                    </div>
                </div>
				<div class="row">
                    <div class="col-4">
                        <label for="codClienteFinal" class="mb-0">Cliente</label>
                        <div id="tdcodClienteFinal"></div>
                    </div>
                    <div class="col-8">
                        <label for="txtEmail" class="mb-0">E-mail</label>
                        <input type="text" id="txtEmail" name="txtEmail" class='persist input form-control'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="indAtivo" id="indAtivo" class="custom-control-input persist" />
                            <label class="custom-control-label" for="indAtivo">Ativo</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<div class="modal-footer">
            <div class="btn-group btn-block">
                <button type="button" class="btn btn-primary" id="btnReiniciarSenha">Reiniciar Senha</button>
                <button type="button" class="btn btn-success" id="btnSalvar">Salvar</button>
            </div>
		</div>
    </div>
</div>