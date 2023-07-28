<script src="js/CadImportarDespesaView.js?<?php echo time(); ?>"></script>
<div class="modal fade bd-example-modal-lg" id="importarDespesa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="importarDespesaTitle">Importação</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="text-white" aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <input type="hidden" id="hdDtaDespesa"> -->
                <!-- <input type="hidden" id="codDespesasImportacao" /> -->
                <div class="row">
                    <div class="col-3">
                        <label class="mb-0">Mês para importar</label>
                        <div id="tdmesRefImportacao"></div>
                    </div>
                    <div class="col-3">
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

<!-- <form name="CadastroForm" method="post">
    <input type="hidden" id="hdDtaDespesa">
    <input type="hidden" id="codDespesasImportacao">
    <table>
        <tr>
            <td>
                Descrição
            </td>
            <td><label id="lblDespesa" name="lblDespesa"></label></td>
        </tr>
        <tr>
            <td>
                Ano para importar
            </td>
            <td>            
                <div id="comboNroAnoReferenciaImportacao"></div>
                <select name="nroAnoReferenciaImportacao" id="nroAnoReferenciaImportacao" style="display:none">
                <?php
                // $result_receitas = unserialize(urldecode($_POST['ListaAnos']));
                // $nroAnoReferencia = unserialize(urldecode($_POST['nroAnoReferencia']));
                // for($i=0;$i<count($result_receitas);$i++){
                //     if ($nroAnoReferencia==$result_receitas[$i]['NRO_ANO_REFERENCIA']){
                //         echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                //     }else{
                //         echo "<option value=\"".$result_receitas[$i]['NRO_ANO_REFERENCIA']."\">".$result_receitas[$i]['NRO_ANO_REFERENCIA']."</option>";
                //     }
                // }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td>
                Ano para importar
            </td>
            <td>
                <div id="comboNroMesReferenciaImportacao"></div>
                <select name="nroMesReferenciaImportacao" id="nroMesReferenciaImportacao" style="display:none">
                <?php
                // $result_receitas = unserialize(urldecode($_POST['ListaMeses']));
                // $nroMesReferencia = unserialize(urldecode($_POST['nroMesReferencia']));
                // for($i=0;$i<count($result_receitas);$i++){
                //     if ($nroMesReferencia==$result_receitas[$i]['NRO_MES_REFERENCIA']){
                //         echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\" selected=\"selected\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                //     }else{
                //         echo "<option value=\"".$result_receitas[$i]['NRO_MES_REFERENCIA']."\">".$result_receitas[$i]['DSC_MES_REFERENCIA']."</option>";
                //     }
                // }
                ?>
                </select>
            </td>
        </tr>        
        <tr>
            <td>
                <input type="button" id="btnImportar" value="Importar">
            </td>
        </tr>
    </table>
</form> -->