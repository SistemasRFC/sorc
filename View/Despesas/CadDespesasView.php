<script src="js/CadDespesasView.js?<?php echo time();?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroDespesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document" style="min-width: 900px;">
		<div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="cadastroDespesaTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <div class="col-8">
                        <label for="dscDespesa" class="mb-0">Descrição *</label>
                        <input type="text" id="dscDespesa" name="dscDespesa" class='persist input form-control'>
                    </div>
                    <div class="col-4">
                        <label for="dtaLancDespesa" class="mb-0">Data de Lançamento *</label>
                        <input type="date" id="dtaLancDespesa" name="dtaLancDespesa" class='persist input form-control'>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-3">
                        <label for="dtaDespesa" class="mb-0">Data de Vencimento *</label>
                        <input type="date" id="dtaDespesa" name="dtaDespesa" class='persist input form-control'>
                    </div>
                    <div class="col-3">
                        <label for="vlrDespesa" class="mb-0">Valor *</label>
                        <input type="text" id="vlrDespesa" name="vlrDespesa" class='persist input form-control'>
                    </div>
                    <div class="col-2">
                        <label for="qtdParcelas" class="mb-0">Qtd. Parcelas *</label>
                        <input type="text" id="qtdParcelas" name="qtdParcelas" class='persist input form-control'>
                    </div>
                    <div class="col-3">
                        <label for="nroParcelaAtual" class="mb-0">Nro. Parcela Atual *</label>
                        <input type="text" id="nroParcelaAtual" name="nroParcelaAtual" class='persist input form-control'>
                    </div>
                </div>
                <div class="row mb-2 d-flex align-items-center">
                    <div class="col-4">
                        <label class="mb-0">Tipo de Despesa * <small id="tetoTpoDespesa"></small></label>
                        <div id="tdtpoDespesa"></div>
                    </div>
                    <div class="col-6 mt-1">
                        <small id="infoTpoDespesa"></small>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="mb-0">Conta *</label>
                        <div id="tdcodConta"></div>
                    </div>
                    <div class="col-4">
                        <label class="mb-0">Responsável *</label>
                        <div id="tdcodUsuarioDespesa"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="custom-control custom-checkbox mt-4">
                            <input type="checkbox" name="indDespesaPaga" id="indDespesaPaga" class="custom-control-input persist" />
                            <label class="custom-control-label" for="indDespesaPaga">Despesa Paga?</label>
                        </div>
                    </div>
                    <div class="col-4" id="divDtaPagamento">
                        <label for="dtaPagamento" class="mb-0">Data de Pagamento</label>
                        <input type="date" id="dtaPagamento" name="dtaPagamento" class='persist input form-control'>
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