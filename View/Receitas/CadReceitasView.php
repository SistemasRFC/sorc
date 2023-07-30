<script src="js/CadReceitasView.js?<?php echo time();?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroReceita" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="cadastroReceitaTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-8">
                        <label for="dscReceita" class="mb-0">Descrição</label>
                        <input type="text" id="dscReceita" name="dscReceita" class='persist input form-control'>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label for="dtaReceita" class="mb-0">Data</label>
                        <input type="date" id="dtaReceita" name="dtaReceita" class='persist input form-control'>
                    </div>
                    <div class="col-4">
                        <label for="vlrReceita" class="mb-0">Valor</label>
                        <input type="text" id="vlrReceita" name="vlrReceita" class='persist input form-control'>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="mb-0">Conta</label>
                        <div id="tdcodConta"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="btn-group btn-block">
                    <button type="button" class="btn btn-danger" id="btnDeletar">Deletar</button>
                    <button type="button" class="btn btn-success" id="btnSalvar">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>