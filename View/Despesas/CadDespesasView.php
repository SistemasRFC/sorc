<script src="js/CadDespesasView.js?<?php echo time();?>"></script>
<div class="modal fade bd-example-modal-lg" id="cadastroDespesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="cadastroDespesaTitle"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <form name="CadastroForm" method="post"> -->
                    <!-- <input type="hidden" id="method" name="method"> -->
                <input type="hidden" id="codDespesa" name="codDespesa" value="0" class="persist">
                <div class="row mb-2">
                    <div class="col-8">
                        <label for="dscDespesa" class="mb-0">Descrição</label>
                        <input type="text" id="dscDespesa" name="dscDespesa" class='persist input form-control'>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <label for="dtaLancDespesa" class="mb-0">Data Lançamento</label>
                        <input type="date" id="dtaLancDespesa" name="dtaLancDespesa" class='persist input form-control'>
                    </div>
                    <div class="col-4">
                        <label for="dtaDespesa" class="mb-0">Data Vencimento</label>
                        <input type="date" id="dtaDespesa" name="dtaDespesa" class='persist input form-control'>
                    </div>
                    <div class="col-4">
                        <label class="mb-0">Tipo de Despesa</label>
                        <div id="tdtpoDespesa"></div>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-4">
                        <label for="vlrDespesa" class="mb-0">Valor</label>
                        <input type="text" id="vlrDespesa" name="vlrDespesa" class='persist input form-control'>
                    </div>
                    <div class="col-2">
                        <label for="qtdParcelas" class="mb-0">Qtd. Parcelas</label>
                        <input type="text" id="qtdParcelas" name="qtdParcelas" class='persist input form-control'>
                    </div>
                    <div class="col-3">
                        <label for="nroParcelaAtual" class="mb-0">Nro. Parcela Atual</label>
                        <input type="text" id="nroParcelaAtual" name="nroParcelaAtual" class='persist input form-control'>
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        <label class="mb-0">Conta</label>
                        <div id="tdcodConta"></div>
                    </div>
                    <div class="col-4">
                        <label class="mb-0">Responsável</label>
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


            <!-- <table>
                <tr>
                    <td>
                    Descrição
                    </td>
                    <td><input type="text" id="dscDespesa" name="dscDespesa"></td>
                </tr>
                <tr>
                    <td>
                    Data lançamento
                    </td>
                    <td><input type="text" id="dtaLancDespesa" name="dtaLancDespesa"></td>
                </tr>
                <tr>
                    <td>
                    Data Vencimento
                    </td>
                    <td><input type="text" id="dtaDespesa" name="dtaDespesa"></td>
                </tr>
                <tr>
                    <td>
                    Valor
                    </td>
                    <td><input type="text" id="vlrDespesa" name="vlrDespesa"></td>
                </tr>
                <tr>
                    <td>
                    Qtd Parcelas
                    </td>
                    <td><input type="text" id="qtdParcelas" name="qtdParcelas"></td>
                </tr>
                <tr>
                    <td>
                    Parcela Atual
                    </td>
                    <td><input type="text" id="nroParcelaAtual" name="nroParcelaAtual"></td>
                </tr>
                <tr>
                    <td>
                    Tipo de Conta
                    </td>
                    <td><div id="comboCodTipoDespesa"></div>
                        <select name="codTipoDespesa" id="codTipoDespesa" style="display:none;">
                                <?php
                                // $rs_tpoDespesa = unserialize(urldecode($_POST['ListaTipoDespesa']));

                                // $total = count($rs_tpoDespesa[1]);
                                // $i=0;
                                // echo "<option value=\"-1\">Selecione</option>";
                                // while($i<$total ) {
                                //     echo "<option value=\"".$rs_tpoDespesa[1][$i]['COD_TIPO_DESPESA']."\">".$rs_tpoDespesa[1][$i]['DSC_TIPO_DESPESA']."</option>";
                                //     $i++;
                                // }
                                ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                    Conta
                    </td>
                    <td><div id="comboCodConta"></div>
                        <select name="codConta" id="codConta" style="display:none;">
                        <?php
                        // $rs_conta = unserialize(urldecode($_POST['ListaContasBancarias']));
                        // $total = count($rs_conta[1]);
                        // $i=0;
                        // echo "<option value=\"-1\">Selecione</option>";
                        // while($i<$total ) {
                        //     echo "<option value=\"".$rs_conta[1][$i]['COD_CONTA']."\">".$rs_conta[1][$i]['CONTA']."</option>";
                        //     $i++;
                        // }
                        ?>
                        </select>
                    </td>
                </tr>        
                <tr>
                    <td colspan="2">
                        <div id="divValores">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" id="indDespesaPaga" name="indDespesaPaga" checked>Despesa Paga?
                    </td>
                </tr>
                <tr>
                    <td>
                        <div id="trDtaDespesaPaga" style="display:block">
                            <table>                
                                <tr>
                                    <td>
                                        Data do Pagamento
                                    </td>
                                    <td>
                                        <input type="text" id="dtaPagamento" name="dtaPagamento">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="button" id="btnSalvar" value="Salvar">
                    </td>
                    <td>
                        <input type="button" id="btnDeletar" value="Deletar">
                    </td>
                </tr>
            </table> -->
            <!-- </form> -->